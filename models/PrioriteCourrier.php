<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "priorite_courrier".
 *
 * @property int $ID_PRIORITE
 * @property string $NATURE_COURRIER
 * @property int $CLASSER
 *
 * @property Courrier[] $courriers
 */
class PrioriteCourrier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'priorite_courrier';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_PRIORITE', 'NATURE_COURRIER', 'CLASSER'], 'required'],
            [['ID_PRIORITE'], 'integer'],
            [['NATURE_COURRIER'], 'string', 'max' => 50],
            [['CLASSER'], 'string', 'max' => 1],
            [['ID_PRIORITE'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_PRIORITE' => Yii::t('app', 'Id  Priorite'),
            'NATURE_COURRIER' => Yii::t('app', 'Nature  Courrier'),
            'CLASSER' => Yii::t('app', 'Classer'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourriers()
    {
        return $this->hasMany(Courrier::className(), ['ID_PRIORITE' => 'ID_PRIORITE']);
    }
}
