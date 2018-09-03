<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */

/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">

    <?php
    if ($message == 'Vous n\'avez pas le droit de consulter cette page') {
        $this->title = Yii::t('app', 'Forbidden (#403)');
    }
    ?>

    <!-- start: PAGE CONTENT -->
    <div class="row">
        <div class="col-md-12">
            <div class="page-error animated shake">
                <div class="error-number text-azure">
                    <?= nl2br(Html::encode($message)) ?>
                </div>
                <div class="error-details col-sm-6 col-sm-offset-3">
                    <h3>Oops! <?= Html::encode($this->title) ?></h3>
                    <p>
                        <br>
                        <a href="<?= Url::to(['site/index']) ?>" class="btn btn-dark-grey btn-return">
                            Acceuil
                        </a>
                        <br>
                        <br>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-danger">
        <button data-dismiss="alert" class="close">
            &times;
        </button>
        <?= Html::encode($this->title) ?>
        <br>
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
