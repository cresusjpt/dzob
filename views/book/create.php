<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LivreTraitement */

$this->title = Yii::t('app', 'Ajouter au Livre des Traitements');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Livre Traitements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="livre-traitement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
