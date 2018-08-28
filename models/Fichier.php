<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichier".
 *
 * @property int $ID_FICHIER
 * @property string $REFERENCE
 * @property string $NOM_FICHIER
 * @property string $FORMAT_FICHIER
 * @property string $DATE_EFFECTIVE
 * @property string $CREATEUR
 * @property string $SOURCE
 *
 * @property Courrier $rEFERENCE
 */
class Fichier extends \yii\db\ActiveRecord
{
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'fichier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['REFERENCE', 'NOM_FICHIER','CREATEUR','SOURCE'], 'required'],
            [['ID_FICHIER'], 'integer'],
            [['file'], 'file'],
            [['DATE_EFFECTIVE'], 'safe'],
            [['REFERENCE'], 'string', 'max' => 11],
            [['NOM_FICHIER'], 'string', 'max' => 30],
            [['CREATEUR','SOURCE'], 'string', 'max' => 500],
            [['FORMAT_FICHIER'], 'string', 'max' => 10],
            [['ID_FICHIER'], 'unique'],
            [['REFERENCE'], 'exist', 'skipOnError' => true, 'targetClass' => Courrier::class, 'targetAttribute' => ['REFERENCE' => 'REFERENCE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_FICHIER' => Yii::t('app', 'Fichier'),
            'REFERENCE' => Yii::t('app', 'Reference Courrier'),
            'NOM_FICHIER' => Yii::t('app', 'Nom Fichier'),
            'FORMAT_FICHIER' => Yii::t('app', 'Format Fichier'),
            'DATE_EFFECTIVE' => Yii::t('app', 'Date effective'),
            'CREATEUR' => Yii::t('app', 'Créateur'),
            'SOURCE' => Yii::t('app', 'Source'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERENCE()
    {
        return $this->hasOne(Courrier::class, ['REFERENCE' => 'REFERENCE']);
    }
}
