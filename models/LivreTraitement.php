<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "livre_traitement".
 *
 * @property int $ID_LT
 * @property string $NOM_TRAITEMENT
 *
 * @property Recenser[] $recensers
 * @property Traitement[] $tRAITEMENTs
 */
class LivreTraitement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'livre_traitement';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOM_TRAITEMENT'], 'required'],
            [['ID_LT'], 'integer'],
            [['NOM_TRAITEMENT'], 'string', 'max' => 100],
            [['ID_LT'], 'unique'],
            [['NOM_TRAITEMENT'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_LT' => Yii::t('app', 'Livre des traitements'),
            'NOM_TRAITEMENT' => Yii::t('app', 'Nom Traitement'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRecensers()
    {
        return $this->hasMany(Recenser::className(), ['ID_LT' => 'ID_LT']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTRAITEMENTs()
    {
        return $this->hasMany(Traitement::className(), ['ID_TRAITEMENT' => 'ID_TRAITEMENT'])->viaTable('recenser', ['ID_LT' => 'ID_LT']);
    }
}
