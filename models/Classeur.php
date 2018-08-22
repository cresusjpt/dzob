<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "classeur".
 *
 * @property int $ID_CLASSEUR
 * @property string $NOM_CLASSEUR
 * @property string $DATE_CLASSEUR
 *
 * @property Dossier[] $dossiers
 */
class Classeur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'classeur';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOM_CLASSEUR', 'DATE_CLASSEUR'], 'required'],
            [['ID_CLASSEUR'], 'integer'],
            [['DATE_CLASSEUR'], 'safe'],
            [['NOM_CLASSEUR'], 'string', 'max' => 50],
            [['ID_CLASSEUR'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_CLASSEUR' => Yii::t('app', 'Id Classeur'),
            'NOM_CLASSEUR' => Yii::t('app', 'Nom Classeur'),
            'DATE_CLASSEUR' => Yii::t('app', 'Date Classeur'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDossiers()
    {
        return $this->hasMany(Dossier::className(), ['ID_CLASSEUR' => 'ID_CLASSEUR']);
    }
}
