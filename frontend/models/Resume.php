<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "resume".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $summary
 * @property string|null $language
 * @property int|null $is_paid
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property ResumeExperience[] $resumeExperiences
 */
class Resume extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'resume';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summary', 'created_at', 'updated_at'], 'default', 'value' => null],
            [['language'], 'default', 'value' => 'en'],
            [['is_paid'], 'default', 'value' => 0],
            [['user_id', 'title'], 'required'],
            [['user_id', 'is_paid', 'created_at', 'updated_at'], 'integer'],
            [['summary'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['language'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'summary' => 'Summary',
            'language' => 'Language',
            'is_paid' => 'Is Paid',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[ResumeExperiences]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeExperiences()
    {
        return $this->hasMany(ResumeExperience::class, ['resume_id' => 'id']);
    }

}
