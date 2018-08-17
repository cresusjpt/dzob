<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "document".
 *
 * @property int $ID_DOC
 * @property string $TITRE_DOC
 * @property string $DESCRIPTION_DOC
 * @property string $DATE_DOC
 * @property string $DATE_EFFECTIVE
 * @property string $CREATEUR
 * @property string $SOURCE
 *
 * @property Constituer[] $constituers
 * @property Dossier[] $dOSSIERs
 * @property Contenir[] $contenirs
 * @property Metadonnee[] $mETAs
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'document';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_DOC', 'TITRE_DOC', 'DESCRIPTION_DOC', 'DATE_DOC', 'CREATEUR', 'SOURCE'], 'required'],
            [['ID_DOC'], 'integer'],
            [['DATE_DOC', 'DATE_EFFECTIVE'], 'safe'],
            [['TITRE_DOC', 'CREATEUR'], 'string', 'max' => 50],
            [['DESCRIPTION_DOC'], 'string', 'max' => 250],
            [['SOURCE'], 'string', 'max' => 150],
            [['ID_DOC'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_DOC' => Yii::t('app', 'Id  Doc'),
            'TITRE_DOC' => Yii::t('app', 'Titre  Doc'),
            'DESCRIPTION_DOC' => Yii::t('app', 'Description  Doc'),
            'DATE_DOC' => Yii::t('app', 'Date  Doc'),
            'DATE_EFFECTIVE' => Yii::t('app', 'Date  Effective'),
            'CREATEUR' => Yii::t('app', 'Createur'),
            'SOURCE' => Yii::t('app', 'Source'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConstituers()
    {
        return $this->hasMany(Constituer::className(), ['ID_DOC' => 'ID_DOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIERs()
    {
        return $this->hasMany(Dossier::className(), ['ID_DOSSIER' => 'ID_DOSSIER'])->viaTable('constituer', ['ID_DOC' => 'ID_DOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContenirs()
    {
        return $this->hasMany(Contenir::className(), ['ID_DOC' => 'ID_DOC']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMETAs()
    {
        return $this->hasMany(Metadonnee::className(), ['ID_META' => 'ID_META'])->viaTable('contenir', ['ID_DOC' => 'ID_DOC']);
    }
}
