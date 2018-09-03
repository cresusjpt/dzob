<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\GrUsager */

$this->title = Yii::t('app', 'Ajouter un groupe d\'utilisateur');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Groupe d\'utilisateurs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gr-usager-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
