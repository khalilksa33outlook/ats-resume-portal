<?php
// use Yii;
use yii\helpers\Html;
$this->title = 'Professional ATS Resume Builder';
?>
<div class="site-index text-center">
    <div class="jumbotron bg-transparent">
        <h1 class="display-4"><?= Yii::t('app', 'Build Your Future') ?></h1>
        <p class="lead"><?= Yii::t('app', 'Create an ATS-friendly resume in English and Arabic.') ?></p>
        <p><?= Html::a(Yii::t('app', 'Create My Resume'), ['resume/create'], ['class' => 'btn btn-lg btn-success']) ?></p>
    </div>
</div>