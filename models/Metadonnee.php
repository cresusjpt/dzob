<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "metadonnee".
 *
 * @property int $ID_META
 * @property int $ID_TYPEMETA
 * @property string $META_LIBELLE
 * @property string $META_CONTENU
 *
 * @property Contenir[] $contenirs
 * @property Document[] $dOCs
 * @property TypeMetadonnee $tYPEMETA
 */
class Metadonnee extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'metadonnee';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_TYPEMETA', 'META_LIBELLE'], 'required'],
            [['ID_META', 'ID_TYPEMETA'], 'integer'],
            [['META_LIBELLE'], 'string', 'max' => 50],
            [['META_CONTENU'], 'string', 'max' => 100],
            [['ID_META'], 'unique'],
            [['META_LIBELLE'], 'unique'],
            [['ID_TYPEMETA'], 'exist', 'skipOnError' => true, 'targetClass' => TypeMetadonnee::className(), 'targetAttribute' => ['ID_TYPEMETA' => 'ID_TYPEMETA']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_META' => Yii::t('app', 'Metadonnée'),
            'ID_TYPEMETA' => Yii::t('app', 'Type Metadonnees'),
            'META_LIBELLE' => Yii::t('app', 'Libelle metadonée'),
            'META_CONTENU' => Yii::t('app', 'Contenu metadonnée'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContenirs()
    {
        return $this->hasMany(Contenir::className(), ['ID_META' => 'ID_META']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOCs()
    {
        return $this->hasMany(Document::className(), ['ID_DOC' => 'ID_DOC'])->viaTable('contenir', ['ID_META' => 'ID_META']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTYPEMETA()
    {
        return $this->hasOne(TypeMetadonnee::className(), ['ID_TYPEMETA' => 'ID_TYPEMETA']);
    }
}
