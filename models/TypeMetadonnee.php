<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_metadonnee".
 *
 * @property int $ID_TYPEMETA
 * @property string $LIBELLE_TYPEMETA
 *
 * @property Metadonnee[] $metadonnees
 */
class TypeMetadonnee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_metadonnee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_TYPEMETA', 'LIBELLE_TYPEMETA'], 'required'],
            [['ID_TYPEMETA'], 'integer'],
            [['LIBELLE_TYPEMETA'], 'string', 'max' => 50],
            [['ID_TYPEMETA'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_TYPEMETA' => Yii::t('app', 'Id  Typemeta'),
            'LIBELLE_TYPEMETA' => Yii::t('app', 'Libelle  Typemeta'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetadonnees()
    {
        return $this->hasMany(Metadonnee::className(), ['ID_TYPEMETA' => 'ID_TYPEMETA']);
    }
}
