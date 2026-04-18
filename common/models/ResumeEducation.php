<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "resume_education".
 *
 * @property int $id
 * @property int $resume_id
 * @property string $institution
 * @property string|null $degree
 * @property string|null $field_of_study
 * @property string|null $start_date
 * @property string|null $end_date
 * @property string|null $description
 *
 * @property Resume $resume
 */
class ResumeEducation extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume_education';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['degree', 'field_of_study', 'start_date', 'end_date', 'description'], 'default', 'value' => null],
            [['resume_id', 'institution'], 'required'],
            [['resume_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['description'], 'string'],
            [['institution', 'degree', 'field_of_study'], 'string', 'max' => 255],
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
            'institution' => 'Institution',
            'degree' => 'Degree',
            'field_of_study' => 'Field Of Study',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'description' => 'Description',
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
