<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Valeur */

$this->title = Yii::t('app', 'Ajouter Valeur');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Valeurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="valeur-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
