<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Modele */

$this->title = Yii::t('app', 'Create Modele');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modele-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
