<?php

namespace app\controllers;

use app\models\BasketUser;
use app\models\Search;
use app\models\TovarPicture;
use app\models\TovarSearch;
use app\models\Coments;
use Codeception\Step\Comment;
use Yii;
use yii\data\Pagination;
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
use app\models\Like;

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

        //зробити вивід перши три товара за лайками

        //створення запиту
            $model=new Search();
        $tovar =TovarSearch::find()->all();
        $tt = (new Query())
            ->select('tovar.id,tovar.name,tovar.price ,category.name c,tovar_picture.source foto, Count(like.idTovar) like')
            ->from('tovar', 'category', 'tovar_picture')
            ->join(' INNER JOIN', 'category', 'tovar.idcategory=category.id')
            ->join('LEFT JOIN', 'tovar_picture', 'tovar.id=tovar_picture.id_tovar')
            ->join('LEFT JOIN', 'like','like.idTovar=tovar.id')
            ->groupBy('tovar.id');
        if($model->load(Yii::$app->request->post()))
        {
            if (strlen($model->name)>=3)
            $tt->where(['tovar.name'=>$model->name]);
            if((strlen($model->from)>=1 || strlen($model->from)>=1)&& $model->from<$model->to)
            {
                    $tt->andWhere(['between','tovar.price',$model->from,$model->to]);
                //условие на выборку в промежутку
            }
        }
        else {


        }
        return $this->render('index',[
            'tovar'=>$tt,
            'model'=>$model,
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
                $data=User::find()->where(['name'=>$login_model->name])->one();
                if($data->password==$login_model->password) {
                    Yii::$app->user->login($login_model->getUser());
                }
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


        if($basket->load(Yii::$app->request->post()))
        {
            $basket->idTovar=$id;
            if(!Yii::$app->user->isGuest) {
                $basket->idUser = Yii::$app->user->id;
                if($basket->save())
                {
                    $basket=new BasketUser();

                }
            }
        }


        $foto = TovarPicture::find()->
        where(["id_tovar"=>
            $id])->
        all();

        $coment=new Coments();
        if($coment->load(Yii::$app->request->post()))
        {
            if(!Yii::$app->user->isGuest && strlen($coment->coment)>=10) {
                if ($coment->save()) {
                    $coment = new Coments();
                }
            }
        }

        $like=Like::find()->where(['idTovar'=>$id])->count();

        $comentsUser =(new Query())
            ->select('coments.coment c, user.name u')
            ->from(' coments')

            ->where(['coments.idTovar'=>$id])
            ->join(' INNER JOIN','user','coments.idUser=user.id')
            ->groupBy(['coments.id'])
            ;

                $pages=new Pagination(['totalCount'=>$comentsUser->count() ]);
             //   print_r($pages);
                $comentUser=$comentsUser->offset($pages->offset)
                    ->limit($pages->limit)
                    ->all();
        return $this->render('tovarview',[
            'model'=>$model,
            'foto'=>$foto,
            'coment'=>$coment,
            'basket'=>$basket,
            'comentsUser'=>$comentUser,
            'pages'=>$pages,
            'like'=>$like,

        ]);
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
                return $this->render('login');
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


    public function actionLike($idT){
    $like=new Like();
        $l=Like::find()->where(['idUser'=>Yii::$app->user->id])->andWhere(['idTovar'=>$idT])->one();
        if($l) {
                $l->delete();
        }
        else
         {
            $like->idUser=Yii::$app->user->id;
            $like->idTovar=$idT;
            $like->save();
           // print_r($like);
        }
        return $this->redirect(['tovarview',
            'id'=>$idT,
        ]);
    }
}
