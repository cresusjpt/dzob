<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Rdv */

$this->title = Yii::t('app', 'Ajouter rendez-vous');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rendez-vous'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rdv-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
