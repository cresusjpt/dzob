<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 14/07/2018
 * Time: 10:27
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Dzob | Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="box-login">
            <h3>Mot de passe Oublié?</h3>
            <p>
                Entrer votre adresse mail ci-dessous pour le réinitialiser.
            </p>

            <?php $form = ActiveForm::begin(['id'=>'form-forgot'])?>
            <div class="errorHandler alert alert-danger no-display">
                <i class="fa fa-remove-sign"></i> Des erreurs sont survenues, Veuillez verifiez ci-dessous.
            </div>
            <fieldset>
                <?= $form->field($models, 'EMAIL',['options'=>[
                    'tag'=>'div',
                    'class'=>'form-group required '
                ],
                    'template'=>'<span class="input-icon">{input}<i class="fa fa-envelope"></i></span>
                        {error}{hint}'
                ])->textInput(['placeholder'=>'Email'])
                ?>
                <div class="form-group">
                    <a class="btn btn-light-grey go-back" href="login">
                        <i class="fa fa-chevron-circle-left"></i> Connexion
                    </a>
                    <?= Html::submitButton('Envoyer <i class="fa fa-arrow-circle-right"></i>',['class'=>'btn btn-green pull-right',])?>
                </div>
            </fieldset>

            <!--<form class="form-forgot" id="forgot">
                <fieldset>
                    <div class="form-group">
								<span class="input-icon">
									<input type="email" class="form-control" name="email" placeholder="Email">
									<i class="fa fa-envelope"></i> </span>
                    </div>
                    <div class="form-actions">
                        <a class="btn btn-light-grey go-back" href="login">
                            <i class="fa fa-chevron-circle-left"></i> Connexion
                        </a>
                        <button type="submit" class="btn btn-green pull-right">
                            Envoyer <i class="fa fa-arrow-circle-right"></i>
                        </button>
                    </div>
                </fieldset>
            </form>-->
            <?php ActiveForm::end()?>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                <?=date('Y')?> &copy; Dzob.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
    </div>
</div>
