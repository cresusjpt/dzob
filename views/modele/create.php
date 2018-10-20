<?php

use yii\helpers\Html;
use app\models\ModelParam;


/* @var $this yii\web\View */
/* @var $model app\models\Modele */
/* @var $modelParam app\models\ModelParam */

$this->title = Yii::t('app', 'Créer Modele');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modeles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modele-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelParam' => $modelParam
    ]) ?>

</div>
