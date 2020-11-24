<?php

namespace app\controllers;


use Yii;
use app\models\Basketuser;
use app\models\BasketuserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ButStoreUser;
use yii\db\Query;
/**
 * BasketuserController implements the CRUD actions for Basketuser model.
 */
class BasketuserController extends Controller
{
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
     * Lists all Basketuser models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        $searchModel = new BasketuserSearch();
        $id=Yii::$app->user->id;

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
//        $dataProvider=Basketuser::find()
//
//            ->where(['idUser'=>$id])
//            ->sum('amount');
//
//
//        ;
        return $this->render('index', [

            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Basketuser model.
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

    public function actionBue(){
        $idUser=Yii::$app->user->id;
            $basket=BasketuserSearch::find()->
            Where([
                'idUser'=>$idUser,
            ])->all();

               foreach ($basket as $b)
               {
                    $bs=new ButStoreUser();
                    $bs->idTovar=$b->idTovar;
                    $bs->idUser=$b->idUser;
                    $bs->amount=$b->amount;
                    $bs->save();
                    $b->delete();
               }
                return $this->goHome();
    }

    /**
     * Creates a new Basketuser model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Basketuser();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Basketuser model.
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
     * Deletes an existing Basketuser model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Basketuser model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Basketuser the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Basketuser::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
