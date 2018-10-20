<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Avoir */

$this->title = Yii::t('app', 'Ajouter Héritier');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Avoirs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="avoir-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
