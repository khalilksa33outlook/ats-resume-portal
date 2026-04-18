namespace frontend\controllers;

use Yii;
use common\models\Resume; // Ensure you have this model
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

public function behaviors()
{
    return [
        'access' => [
            'class' => AccessControl::class,
            'only' => ['create', 'update', 'download', 'delete'], // Actions to protect
            'rules' => [
                [
                    'actions' => ['create', 'update', 'download', 'delete'],
                    'allow' => true,
                    'roles' => ['@'], // '@' means only authenticated (logged-in) users
                ],
            ],
        ],
        'verbs' => [
            'class' => VerbFilter::class,
            'actions' => [
                'delete' => ['POST'], // Security: Only allow deletion via POST
            ],
        ],
    ];
}

class ResumeController extends Controller
{
    // ... other actions (index, view, create) ...

    /**
     * Handles the PDF download logic
     * @param int $id The ID of the resume
     */
    public function actionDownload($id) 
    {
        $model = $this->findModel($id);

        // Check if the user has paid
        if (!$model->is_paid) {
            Yii::$app->session->setFlash('info', 'Please complete the payment to download your professional resume.');
            return $this->redirect(['payment/checkout', 'resume_id' => $id]);
        }

        // If paid, call your PDF generation logic (e.g., using mPDF)
        return $this->generatePdf($model);
    }

    /**
     * Finds the Resume model based on its primary key value.
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}