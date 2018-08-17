<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Dzob | Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <!--<div class="logo">
            <img src="/basic/web/login_assets/images/logo.png">
        </div>-->
        <div class="box-login">
            <h3>Connexion</h3>
            <p>
                Veuillez entrer le nom d'utilisateur pour vous connecter.
            </p>
            <?php $form = ActiveForm::begin(['id'=>'form-login']);?>
            <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i> Des erreurs ont survenues, Veuillez verifiez ci-dessous.
            </div>
            <fieldset>
                <?= $form->field($models, 'username',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-utilisateur-login required '
                ],
                    'template'=>'<span class="input-icon">{input}<i class="fa fa-user"></i></span>
                        {error}{hint}'
                ])->textInput(['placeholder'=>'Nom d\'utilisteur'])
                ?>
                <?= $form->field($models, 'password',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group field-utilisateur-login required '
                ],
                    'template'=>'<span class="input-icon">{input}<i class="fa fa-lock"></i><a class="forgot" href="forgot">Mot de passe oublié</a></span>
                        {error}{hint}'
                ])->passwordInput(['placeholder'=>'Mot de passe'])
                ?>
                <?= $form->field($models, 'rememberMe')->checkbox(['label'=>'Garder ma connexion active']) ?>
                <div class="form-group">
                    <?= Html::submitButton('Connexion <i class="fa fa-arrow-circle-right"></i>',['class'=>'btn btn-green pull-right',])?>
                </div>
                <div class="new-account">
                    Pas encore de compte ?
                    <a href="register" class="register">
                        Créer un compte
                    </a>
                </div>
            </fieldset>
            <?php ActiveForm::end();?>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                <?php echo date('Y') ?> &copy; Dzob.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
    </div>
</div>
