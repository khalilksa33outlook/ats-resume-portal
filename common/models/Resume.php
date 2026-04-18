<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%resume}}".
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
 * @property ResumeEducation[] $resumeEducations
 * @property ResumeExperience[] $resumeExperiences
 */
class Resume extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['step1'] = ['title', 'summary', 'language']; // Basic Info
        // You can add more steps here as we go
        return $scenarios;
    }
    public static function tableName()
    {
        return '{{%resume}}';
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
            [['title'], 'required'],
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
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Title'),
            'summary' => Yii::t('app', 'Summary'),
            'language' => Yii::t('app', 'Language'),
            'is_paid' => Yii::t('app', 'Is Paid'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[ResumeEducations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getResumeEducations()
    {
        return $this->hasMany(ResumeEducation::class, ['resume_id' => 'id']);
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
