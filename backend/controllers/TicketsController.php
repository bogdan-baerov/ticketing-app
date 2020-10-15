<?php

namespace backend\controllers;

use Yii;
use backend\models\Appusers;
use backend\models\Tickets;
use backend\models\TicketsSearch;
use backend\models\MyTicketsSearch;
use backend\models\ReportTicketsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;

/**
 * TicketsController implements the CRUD actions for Tickets model.
 */
class TicketsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'view', 'report', 'take', 'mine', 'transfer'],
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'report', 'take', 'mine', 'transfer'],
                        'allow' => false,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index', 'view', 'report', 'take', 'mine', 'transfer'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update'],
                        'allow' => false,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists tickets that are not asigned to anyone.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


        /**
     * Transfer ticket from an IT user to another
     * @return mixed
     */
    public function actionTransfer()
    {
        $ticketModel = Tickets::find()->where(['id' => Yii::$app->request->get('id')])->one();

        $users = Appusers::findBySql('SELECT id, username FROM appusers')->all();

        $userList = ArrayHelper::map($users,'id', 'username');

        if ($ticketModel->load(Yii::$app->request->post()) && $ticketModel->save()) {
            return $this->redirect(['view', 'id' => $ticketModel->id]);
        }

        return $this->render('transfer', [
            'ticketModel' => $ticketModel,
            'userList' => $userList
        ]);
    }

        /**
     * Lists the tickets that are asigned to the logged user.
     * @return mixed
     */
    public function actionMine()
    {
        $searchModel = new MyTicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('mine', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


     /**
     * Tickets reports
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new ReportTicketsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('report', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Tickets model.
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
     * Creates a new Tickets model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Tickets();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tickets model.
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
     * Deletes an existing Tickets model.
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
     * Finds the Tickets model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Tickets the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tickets::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * @return mixed
     */
    public function actionTake($id, $id_it_user, $status)
    {
        $ticket = Tickets::findOne($id);
        if (!$ticket) {
            throw new HttpException(404);
        }
        $ticket->id_it_user = (int)$id_it_user;
        $ticket->status = $status;
        if ($ticket->save()) {
            Yii::$app->session->setFlash('success', 'Ai preluat tichetul cu numărul #'.$id);
            return $this->redirect(['index']);
        } else {
            throw new Exception('Eroare la preluarea tichetului');
        }
    }

}
