<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "model_param".
 *
 * @property int $ID_MODELE
 * @property string $MODELE_PARAM
 */
class ModelParam extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'model_param';
    }

    /**
     * {@inheritdoc}
     * @return ModelParamQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModelParamQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['MODELE_PARAM'], 'required'],
            [['ID_MODELE', 'ORDRE'], 'integer'],
            [['MODELE_PARAM'], 'string', 'max' => 255],
            [['ID_MODELE', 'MODELE_PARAM'], 'unique', 'targetAttribute' => ['ID_MODELE', 'MODELE_PARAM']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_MODELE' => Yii::t('app', 'Id  Modele'),
            'MODELE_PARAM' => Yii::t('app', 'Modele  Param'),
            'ORDRE' => Yii::t('app', 'Numero d\'ordre'),
        ];
    }
}
