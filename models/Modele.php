<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modele".
 *
 * @property int $ID_MODELE
 * @property string $NOM_MODELE
 * @property string $SOURCE_MODELE
 */
class Modele extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'modele';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_MODELE', 'NOM_MODELE', 'SOURCE_MODELE'], 'required'],
            [['ID_MODELE'], 'integer'],
            [['NOM_MODELE'], 'string', 'max' => 100],
            [['SOURCE_MODELE'], 'string', 'max' => 150],
            [['ID_MODELE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MODELE' => Yii::t('app', 'Id  Modele'),
            'NOM_MODELE' => Yii::t('app', 'Nom  Modele'),
            'SOURCE_MODELE' => Yii::t('app', 'Source  Modele'),
        ];
    }
}
