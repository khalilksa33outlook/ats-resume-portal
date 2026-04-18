<?php

namespace frontend\controllers;

use Yii;
use common\models\Resume;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class ResumeController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'download', 'delete'],
                'rules' => [
                    [
                        'actions' => ['update', 'download', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionCreate()
    {
        $model = new Resume();
        if (!Yii::$app->user->isGuest) {
            $model->user_id = Yii::$app->user->id;
        }
        $model->created_at = time();
        $model->updated_at = time();

        if ($model->load(Yii::$app->request->post())) {
            $model->updated_at = time();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionDownload($id)
    {
        $model = $this->findModel($id);

        if (!$model->is_paid) {
            Yii::$app->session->setFlash('info', 'Please complete the payment to download your professional resume.');
            return $this->redirect(['payment/checkout', 'resume_id' => $id]);
        }

        return $this->generatePdf($model);
    }

    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
