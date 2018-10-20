<?php
/* @var $this yii\web\View */

use app\models\SysParam;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Dossier;
use kartik\select2\Select2;
use yii\helpers\Html;
use kartik\export\ExportMenu;
use yii\grid\GridView;
use yii\helpers\Url;

$this->title = 'Liste des règlements de frais de dossier';
?>
<h4 class="hidden-print">Critère de recherche</h4>
<?php $form = ActiveForm::begin(); ?>
<div class="why">
    <?php try {
        echo \kartik\daterange\DateRangePicker::widget([
            'model' => $model,
            'attribute' => 'DATE_REGLE',
            'class' => 'hidden-print',
            'convertFormat' => true,
            'bsVersion' => 3,
            'pluginOptions' => [
                'class' => 'hidden-print',
                'timePickerIncrement' => 2,
                'locale' => [
                    'format' => 'Y-m-d h:i',
                ]
            ],
        ]);
    } catch (Exception $e) {
    }
    ?>
    <?= $form->field($model, 'ID_DOSSIER')->widget(Select2::class, [
        'data' => ArrayHelper::map(Dossier::find()->all(), 'ID_DOSSIER', 'LIBELLE_DOSSIER'),
        'class' => 'hidden-print',
        'options' => [
            'placeholder' => 'Libelle du dossier ...', 'id' => 'dossier',
            'class' => 'hidden-print',
        ],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);
    ?>
</div>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app', 'Lister'), ['class' => 'btn btn-success hidden-print']) ?>
</div>
<?php $form = ActiveForm::end(); ?>
<?php
$entete = SysParam::findOne('ENTETE_ETAT');
if (!empty($entete)) {
    ?>
    <div class="entete" style="display: none">
        <img height="100%" width="100%" src="<?= Url::to('@web/uploads/ressource/' . $entete->PARAM_VALUE); ?>"
             alt="entete"/>
    </div>

    <?php
}
?>
<h2 style="text-align: center">Liste des règlements</h2>
<div class="btn-group">
    <button class="btn btn-light hidden-print"
            onclick="$('.why').hide();$('.entete').show();window.print();$('.entete').hide();$('.why').show();">
        Imprimer <i class="fa fa-print"></i>
    </button>
</div>
<?php try {
    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'options' => [
            'class' => 'hidden-print',
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'ID_FRAIS',
            'dOSSIER.LIBELLE_DOSSIER',
            'MONTANT',
            'DATE_REGLE:date',
            'difference',
        ],
    ]);
} catch (Exception $e) {
} ?>
<?php \yii\widgets\Pjax::begin(); ?>
<?php try {
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'ID_FRAIS',
            'dOSSIER.LIBELLE_DOSSIER',
            'MONTANT:integer',
            'DATE_REGLE:date',
            'difference:integer',
        ],
    ]);
} catch (Exception $e) {
}
?>
<div class="btn-group pull-right entete" style="display: none">
    <h4>Imprimé le <?= date('d/m/Y à H:i:s') ?></h4>
</div>
<?php \yii\widgets\Pjax::end(); ?>
