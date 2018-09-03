<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Droits */

$this->title = Yii::t('app', 'Créer Droits');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Droits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="droits-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
