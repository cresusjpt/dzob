<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Frais */

$this->title = Yii::t('app', 'Créer Frais');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Frais'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="frais-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
