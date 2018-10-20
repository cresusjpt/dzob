<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 13/08/2018
 * Time: 02:46
 */


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;

$this->title = 'Dzob | Inscription';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row">
    <div class="main-login col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="box-login">
            <h3>Inscription</h3>
            <p>
                Entrer les informations suivantes:
            </p>
            <!--on commence ici la recriture du formulaire-->
            <?php $form = ActiveForm::begin(['id' => 'form-register']); ?>
            <fieldset>
                <div class="errorHandler alert alert-danger no-display">
                    <i class="fa fa-remove-sign"></i> Des erreurs ont survenues, Veuillez verifiez ci-dessous.
                </div>
                <?= $form->field($models, 'NOM', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group required '
                ],
                    'template' => '{input}
                        {error}{hint}'
                ])->textInput(['placeholder' => 'Nom complet'])
                ?>
                <?= $form->field($models, 'PRENOM', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group required '
                ],
                    'template' => '{input}
                        {error}{hint}'
                ])->textInput(['placeholder' => 'Prénom'])
                ?>

                <?= $form->field($models, 'DATE_NAISSANCE')->widget(
                    DatePicker::class, [
                    // inline too, not bad
                    'inline' => false,
                    'language' => 'fr',
                    // modify template for custom rendering
                    //'template' => '<div class="well well-sm" style="background-color: #fff;">{input}</div>',
                    'clientOptions' => [
                        'autoclose' => true,
                        'endDate' => date('Y-m-d'),
                        'todayHighlight' => true,
                        'format' => 'yyyy-mm-dd'
                    ]
                ]); ?>

                <?= $form->field($models, 'EMAIL', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group required'
                ],
                    'template' => '{input}
                        {error}{hint}'
                ])->input('email', ['placeholder' => 'Email'])
                ?>
                <?= $form->field($models, 'TELEPHONE', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group required'
                ],
                    'template' => '{input}
                        {error}{hint}'
                ])->textInput(['placeholder' => 'Telephone'])
                ?>
                <?= $form->field($models, 'ADRESSE', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group required '
                ],
                    'template' => '{input}
                        {error}{hint}'
                ])->textInput(['placeholder' => 'Adresse'])
                ?>
                <?= $form->field($models, 'SEXE')->radioList([
                    'M' => 'Masculin',
                    'F' => 'Feminin',
                ])
                ?>
                <p>
                    Entrez les informations de connexion ci-dessous:
                </p>
                <?= $form->field($models, 'USERNAME', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group field-utilisateur-login required '
                ],
                    'template' => '<span class="input-icon">{input}<i class="fa fa-user"></i></span>
                        {error}{hint}'
                ])->textInput(['placeholder' => 'Nom d\'utilisteur'])
                ?>

                <?= $form->field($models, 'PASSWORD', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group field-utilisateur-login required '
                ],
                    'template' => '<span class="input-icon">{input}<i class="fa fa-lock"></i></span>
                        {error}{hint}'
                ])->passwordInput(['placeholder' => 'Mot de passe'])
                ?>
                <?= $form->field($models, 'rawpassword', ['options' => [
                    'tag' => 'div',
                    'class' => 'form-group field-utilisateur-login required '
                ],
                    'template' => '<span class="input-icon">{input}<i class="fa fa-lock"></i></span>
                        {error}{hint}'
                ])->passwordInput(['placeholder' => 'Mot de passe encore'])
                ?>
                <div class="form-actions">
                    Déjà un compte?
                    <a href="<?= \yii\helpers\Url::to('site/login') ?>" class="go-back">
                        Connexion
                    </a>
                    <div class="form-group">
                        <?= Html::submitButton('Inscription <i class="fa fa-arrow-circle-right"></i>', ['class' => 'btn btn-green pull-right']) ?>
                    </div>
                </div>
            </fieldset>
            <?php ActiveForm::end(); ?>
            <!-- start: COPYRIGHT -->
            <div class="copyright">
                <?= date('Y') ?> &copy; Dzob.
            </div>
            <!-- end: COPYRIGHT -->
        </div>
    </div>
</div>
