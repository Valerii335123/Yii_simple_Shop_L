<?php

namespace app\modules\admin\controllers;

use app\models\TovarPicture;
use app\models\TovarpictureSearch;
use Yii;
use app\models\Tovar;
use app\models\TovarSearch;
use app\models\Category;
use app\models\CategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * TovarController implements the CRUD actions for Tovar model.
 */
class TovarController extends Controller
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
     * Lists all Tovar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TovarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);



        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tovar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        $foto = TovarPicture::find()->
        where(["id_tovar"=>
            $id])->
        all();
        $tovar=$this->findModel($id);
        $cat=$this->findCategory($tovar->idCategory);
        return $this->render('view', [
            'model' => $tovar,
            'foto'=>$foto,
            'category'=>$cat,
        ]);
    }

    public function findCategory($idT)
    {
        $Cat = Category::findOne($idT);
            return $Cat;


    }

    /**
     * Creates a new Tovar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tovar();
        $selectedCategory = $article->category->id;
        $category=ArrayHelper::map(Category::find()->all(),'id','name');

        $model->idCategory=Yii::$app->request->post('idCategory');
        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'category'=>$category,
            'selectedCategory'=>$selectedCategory,
        ]);
    }

    /**
     * Updates an existing Tovar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $selectedCategory = $article->category->id;
        $category=ArrayHelper::map(Category::find()->all(),'id','name');

        $model->idCategory=Yii::$app->request->post('idCategory');
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'category'=>$category,
            'selectedCategory'=>$selectedCategory,
        ]);
    }

    /**
     * Deletes an existing Tovar model.
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
     * Finds the Tovar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tovar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tovar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
