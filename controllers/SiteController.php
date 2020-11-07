<?php

namespace app\controllers;

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
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
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

        $tovar =TovarSearch::find()->all();

        return $this->render('index',[
            'tovar'=>$tovar,
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
