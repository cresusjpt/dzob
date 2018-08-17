<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Metadonnee */

$this->title = Yii::t('app', 'Create Metadonnee');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Metadonnees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metadonnee-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
