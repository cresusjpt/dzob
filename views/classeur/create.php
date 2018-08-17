<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Classeur */

$this->title = Yii::t('app', 'Create Classeur');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Classeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="classeur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
