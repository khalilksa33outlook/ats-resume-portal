// frontend/views/builder/step1.php
echo $form->field($model, 'title')->textInput([
    'placeholder' => Yii::t('app', 'e.g. Senior Project Manager')
])->label(Yii::t('app', 'Resume Title'));