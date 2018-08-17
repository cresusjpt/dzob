<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fichier".
 *
 * @property int $ID_FICHIER
 * @property string $REFERNCE
 * @property string $NOM_FICHIER
 * @property string $FORMAT_FICHIER
 *
 * @property Courrier $rEFERNCE
 */
class Fichier extends \yii\db\ActiveRecord
{
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
            [['ID_FICHIER', 'REFERNCE', 'NOM_FICHIER'], 'required'],
            [['ID_FICHIER'], 'integer'],
            [['REFERNCE'], 'string', 'max' => 11],
            [['NOM_FICHIER'], 'string', 'max' => 30],
            [['FORMAT_FICHIER'], 'string', 'max' => 10],
            [['ID_FICHIER'], 'unique'],
            [['REFERNCE'], 'exist', 'skipOnError' => true, 'targetClass' => Courrier::className(), 'targetAttribute' => ['REFERNCE' => 'REFERNCE']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_FICHIER' => Yii::t('app', 'Id  Fichier'),
            'REFERNCE' => Yii::t('app', 'Refernce'),
            'NOM_FICHIER' => Yii::t('app', 'Nom  Fichier'),
            'FORMAT_FICHIER' => Yii::t('app', 'Format  Fichier'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getREFERNCE()
    {
        return $this->hasOne(Courrier::className(), ['REFERNCE' => 'REFERNCE']);
    }
}
