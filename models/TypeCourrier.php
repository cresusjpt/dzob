<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_courrier".
 *
 * @property int $ID_TYPECOURRIER
 * @property string $NOM_TYPE
 *
 * @property Courrier[] $courriers
 */
class TypeCourrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_courrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NOM_TYPE'], 'required'],
            [['ID_TYPECOURRIER'], 'integer'],
            [['NOM_TYPE'], 'string', 'max' => 25],
            [['ID_TYPECOURRIER'], 'unique'],
            [['NOM_TYPE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_TYPECOURRIER' => Yii::t('app', 'Type courrier'),
            'NOM_TYPE' => Yii::t('app', 'Nom Type courrier'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourriers()
    {
        return $this->hasMany(Courrier::className(), ['ID_TYPECOURRIER' => 'ID_TYPECOURRIER']);
    }
}
