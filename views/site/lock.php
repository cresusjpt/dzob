<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 20/08/2018
 * Time: 19:11
 */

use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<!-- start: BODY -->
<div class="main-ls animated flipInX">
    <div class="logo">
        <img alt="" src="<?= Url::to('@web/T_assets/images/avatar-1-xl.jpg'); ?>"/>
    </div>
    <div class="box-ls">
        <div class="user-info">
            <h1><i class="fa fa-lock"></i> <?= $model->PRENOM ?> <?= $model->NOM?></h1>
            <span><em>Entrer votre mot de passe pour déverouiller.</em></span>
            <?php $form = ActiveForm::begin(); ?>
            <?= $form->field($model,'USERNAME',['template'=>'{input}'])->input('hidden')?>
            <div class="input-group">
                <?= $form->field($model, 'rawpassword',[
                        'template'=>'{hint}{input}',
                 ])->passwordInput(['placeholder' => 'Mot de passe']) ?>
                <span class="input-group-btn">
                    <div class="form-group">
                        <?= Html::submitButton('<i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-green pull-right']) ?>
                    </div>
                </span>
            </div>
            <div class="relogin">
                <a href="<?= Url::to(['site/login']) ?>">
                    Ce n'est pas vous?</a>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <div class="copyright">
        <?php echo date('Y') ?> &copy; Dzob.
    </div>
</div>
<!-- end: BODY -->
