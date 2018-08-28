<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "modele".
 *
 * @property int $ID_MODELE
 * @property string $NOM_MODELE
 * @property string $SOURCE_MODELE
 * @property string $CONTENU_MODELE
 * @property int $NB_PARAMETRE
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
            [['NOM_MODELE','CONTENU_MODELE','NB_PARAMETRE'], 'required'],
            [['ID_MODELE','NB_PARAMETRE'], 'integer'],
            [['NOM_MODELE'], 'string', 'max' => 100],
            [['SOURCE_MODELE'], 'string', 'max' => 150],
            [['ID_MODELE','SOURCE_MODELE','NOM_MODELE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MODELE' => Yii::t('app', 'Id  Modele'),
            'NOM_MODELE' => Yii::t('app', 'Nom Modele'),
            'SOURCE_MODELE' => Yii::t('app', 'Source Modele'),
            'NB_PARAMETRE' => Yii::t('app', 'Nombre de parametre'),
            'CONTENU_MODELE' => Yii::t('app', 'Contenu du modele'),
        ];
    }
}
