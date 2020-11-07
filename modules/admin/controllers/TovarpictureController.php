<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\TovarPicture;
use app\models\TovarpictureSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * TovarpictureController implements the CRUD actions for TovarPicture model.
 */
class TovarpictureController extends Controller
{
    public $layout = 'admin';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TovarPicture models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TovarpictureSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TovarPicture model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TovarPicture model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_Tovar)
    {
        $model = new TovarPicture();


        if ($model->load(Yii::$app->request->post()) )
         {
           $model->id_tovar =$id_Tovar;
         $file=UploadedFile::getInstance($model, 'source');


              $model->source=$model->uploadFile($file);

        if($model->save())
          {
              return $this->redirect(['tovar/view', 'id' => $id_Tovar]);
          }

        }

        return $this->render('create', [
            'model' => $model,
            'id_Tovar'=>$id_Tovar,
        ]);


    }

    /**
     * Updates an existing TovarPicture model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TovarPicture model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id,$idtovar)
    {
        $this->deleteFile($id);
        $this->findModel($id)->delete();


        return $this->redirect(['tovar/view', 'id' => $idtovar]);
    }

        public function deleteFile($id)
        {
            $img=TovarPicture::findOne($id)->source;
            $source= Yii::getAlias('@web') . 'uploads/'. $img;

            unlink($source);
        }
    /**
     * Finds the TovarPicture model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TovarPicture the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TovarPicture::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
