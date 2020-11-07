<?php

namespace app\modules\admin\controllers;

use yii\web\Controller;
use Yii;
/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
  public $layout = 'admin';



  public function checkAdmin()
  {
      if( Yii::$app->user->id==1)
          return true;
      else return false;


  }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        //перевірка на адміна працює потрібно для кожної сторіки перевірку не зручно і довго
            if($this->checkAdmin())
        return $this->render('index');
            //стрічка нижче не працює 
            else return  Yii::$app->response->redirect('site/login');
            // можливо використати goBack();

    }
}
