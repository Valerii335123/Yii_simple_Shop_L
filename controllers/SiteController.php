<?php

namespace app\controllers;

use app\models\BasketUser;
use app\models\TovarPicture;
use app\models\TovarSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\user;
use app\models\Login;
use app\models\Tovar;
use yii\db\Query;


class SiteController extends Controller
{


    /**
     * {@inheritdoc}
     */
    public $layout = 'main';
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'about'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['about'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {


        //створення запиту
        $tovar =TovarSearch::find()->all();
            $tt =(new Query())
                ->select('tovar.id,tovar.name,tovar.description,tovar.price,tovar.amount, ,category.name c' )
                ->from('tovar','category')
                ->join(' INNER JOIN','category','tovar.idcategory=category.id')
                ;

        return $this->render('index',[
            'tovar'=>$tt,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
   public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $login_model = new Login();

        if( Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');

            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login',['model'=>$login_model]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionTovarview($id)
    {
        $model= Tovar::findOne($id);
        $basket=new BasketUser();
        $foto = TovarPicture::find()->
        where(["id_tovar"=>
            $id])->
        all();
        return $this->render('tovarview',[
            'model'=>$model,
            'foto'=>$foto,
            'basket'=>$basket,
        ]);
    }
        public function actionAddtobasket($id_tovar)
        {
            $mode=new BasketUser();
            $mode->idTovar=$id_tovar;
            $mode->idUser=Yii::$app->user->id;
            $mode->amount=1;
            if($mode->save()){

                $model= Tovar::findOne($id_tovar);
                $basket=new BasketUser();
                $foto = TovarPicture::find()->
                where(["id_tovar"=>
                    $id_tovar])->
                all();
                return $this->render('tovarview',[
                    'model'=>$model,
                    'foto'=>$foto,
                    'basket'=>$basket,
                ]);
            }
        }
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegistration()
    {
        $model=new LoginForm();
        $user=new User();
        if(!$model->load(Yii::$app->request->post()))

        return $this->render('registration', [
            'model' => $model,
        ]);

        else
        {
            //пошук в бд по значеннях
            $query=User::find()->Where(['name'=>$model->name]);

            $user->name=$model->name;
            $user->password=$model->password;
            //перевірка кількості записів в бд та зберігаю
            if($query->count()==0 && $user->save() )
            {
                return $this->render('index');
            }
            else
            {
                $is=True;
                $model->name="";
                $model->password="";
                $model->Confirmpassword='';

                return $this->render('registration',[
                    'model'=>$model,'isHave'=>$is,
                ]);
            }
        }
    }
}
