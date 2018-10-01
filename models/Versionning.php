<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "versionning".
 *
 * @property int $ID_VERSION
 * @property string $DATE_DMVERSION
 * @property string $DM_PAR
 * @property string $DESCRIPTION
 *
 * @property Modifier[] $modifiers
 * @property Dossier[] $dOSSIERs
 */
class Versionning extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'versionning';
    }

    /**
     * {@inheritdoc}
     * @return VersionningQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VersionningQuery(get_called_class());
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DATE_DMVERSION', 'DM_PAR'], 'required'],
            [['DATE_DMVERSION'], 'safe'],
            [['DESCRIPTION'], 'string'],
            [['DM_PAR'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_VERSION' => Yii::t('app', 'Id  Version'),
            'DATE_DMVERSION' => Yii::t('app', 'Date  Dmversion'),
            'DM_PAR' => Yii::t('app', 'Dm  Par'),
            'DESCRIPTION' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModifiers()
    {
        return $this->hasMany(Modifier::className(), ['ID_VERSION' => 'ID_VERSION']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDOSSIERs()
    {
        return $this->hasMany(Dossier::className(), ['ID_DOSSIER' => 'ID_DOSSIER'])->viaTable('modifier', ['ID_VERSION' => 'ID_VERSION']);
    }
}
