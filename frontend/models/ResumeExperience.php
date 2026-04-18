<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume_experience".
 *
 * @property int $id
 * @property int $resume_id
 * @property string|null $company
 * @property string|null $job_title
 * @property string|null $description
 * @property string|null $start_date
 * @property string|null $end_date
 *
 * @property Resume $resume
 */
class ResumeExperience extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_experience';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company', 'job_title', 'description', 'start_date', 'end_date'], 'default', 'value' => null],
            [['resume_id'], 'required'],
            [['resume_id'], 'integer'],
            [['description'], 'string'],
            [['start_date', 'end_date'], 'safe'],
            [['company', 'job_title'], 'string', 'max' => 255],
            [['resume_id'], 'exist', 'skipOnError' => true, 'targetClass' => Resume::class, 'targetAttribute' => ['resume_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resume_id' => 'Resume ID',
            'company' => 'Company',
            'job_title' => 'Job Title',
            'description' => 'Description',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    /**
     * Gets query for [[Resume]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResume()
    {
        return $this->hasOne(Resume::class, ['id' => 'resume_id']);
    }

}
