namespace frontend\controllers;

use Yii;
use common\models\Resume;
use common\models\ResumeExperience;
use yii\web\Controller;
use yii\filters\AccessControl;

class BuilderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [['allow' => true, 'roles' => ['@']]], // Logged in only
            ],
        ];
    }

    public function actionCreate($step = 1, $id = null)
    {
        // If editing an existing resume, find it; otherwise, start new
        $model = $id ? Resume::findOne($id) : new Resume();

        if ($step == 1) {
            // STEP 1: Basic Info & Summary
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['create', 'step' => 2, 'id' => $model->id]);
            }
            return $this->render('step1', ['model' => $model]);
        } 
        
        if ($step == 2) {
            // STEP 2: Work Experience
            $experience = new ResumeExperience(['resume_id' => $model->id]);
            if ($experience->load(Yii::$app->request->post()) && $experience->save()) {
                // If they want to add more, stay here; otherwise, go to Step 3
                return $this->redirect(['create', 'step' => 3, 'id' => $model->id]);
            }
            return $this->render('step2', ['model' => $model, 'experience' => $experience]);
        }
        
        // ... more steps for Education and Skills
    }
}