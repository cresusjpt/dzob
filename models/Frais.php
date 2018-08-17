<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "frais".
 *
 * @property int $ID_FRAIS
 * @property int $ID_DOSSIER
 * @property double $MONTANT
 * @property string $DATE_REGLE
 * @property string $NATURE_FRAIS
 *
 * @property Dossier $dOSSIER
 */
class Frais extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'frais';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_FRAIS', 'ID_DOSSIER', 'MONTANT', 'NATURE_FRAIS'], 'required'],
            [['ID_FRAIS', 'ID_DOSSIER'], 'integer'],
            [['MONTANT'], 'number'],
            [['DATE_REGLE'], 'safe'],
            [['NATURE_FRAIS'], 'string', 'max' => 30],
            [['ID_FRAIS'], 'unique'],
            [['ID_DOSSIER'], 'exist', 'skipOnError' => true, 'targetClass' => Dossier::className(), 'targetAttribute' => ['ID_DOSSIER' => 'ID_DOSSIER']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_FRAIS' => Yii::t('app', 'Id  Frais'),
            'ID_DOSSIER' => Yii::t('app', 'Id  Dossier'),
            'MONTANT' => Yii::t('app', 'Montant'),
            'DATE_REGLE' => Yii::t('app', 'Date  Regle'),
            'NATURE_FRAIS' => Yii::t('app', 'Nature  Frais'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIER()
    {
        return $this->hasOne(Dossier::className(), ['ID_DOSSIER' => 'ID_DOSSIER']);
    }
}
