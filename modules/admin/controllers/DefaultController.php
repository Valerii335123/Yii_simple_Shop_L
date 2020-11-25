<?php

namespace app\modules\admin\controllers;

use app\models\User;
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


  public function actionDeleteuser($id) {
      $m=User::find()->where(['id'=>$id])->one();
      $m->delete();
     // print_r($m);
      return $this->render('index');
  }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model=User::find()->all();

        //перевірка на адміна працює потрібно для кожної сторіки перевірку не зручно і довго
            if($this->checkAdmin())
        return $this->render('index',[
            'model'=>$model,
        ]);
            //стрічка нижче не працює 
            else return  Yii::$app->response->redirect('site/login');
            // можливо використати goBack();

    }
}
