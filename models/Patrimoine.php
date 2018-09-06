<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "patrimoine".
 *
 * @property int $ID_PATRIMOINE
 * @property string $REFERENCE_PATRIMOINE
 * @property string $NOM_PATRIMOINE
 */
class Patrimoine extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'patrimoine';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['REFERENCE_PATRIMOINE', 'NOM_PATRIMOINE'], 'required'],
            [['REFERENCE_PATRIMOINE'], 'string', 'max' => 50],
            [['NOM_PATRIMOINE'], 'unique'],
            [['NOM_PATRIMOINE'], 'string', 'max' => 300],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_PATRIMOINE' => Yii::t('app', 'Id  Patrimoine'),
            'REFERENCE_PATRIMOINE' => Yii::t('app', 'Reference  Patrimoine'),
            'NOM_PATRIMOINE' => Yii::t('app', 'Nom  Patrimoine'),
        ];
    }
}
