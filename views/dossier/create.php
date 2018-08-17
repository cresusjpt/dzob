<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Dossier */

$this->title = Yii::t('app', 'Create Dossier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Dossiers'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dossier-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
