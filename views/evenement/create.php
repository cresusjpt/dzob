<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Evenement */

$this->title = Yii::t('app', 'Créer Evenement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Evenements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="evenement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
