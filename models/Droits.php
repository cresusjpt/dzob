<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "droits".
 *
 * @property int $ID_DROITS
 * @property string $ETAT_DROIT
 * @property string $LIBELLE_DROIT
 * @property string $COMMENTAIRE_DROIT
 * @property string $DATE_DROIT
 * @property string $DATE_DM
 *
 * @property GrUsager[] $grUsagers
 */
class Droits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'droits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ETAT_DROIT', 'LIBELLE_DROIT', 'DATE_DROIT'], 'required'],
            [['ETAT_DROIT'], 'string'],
            [['DATE_DROIT', 'DATE_DM'], 'safe'],
            [['LIBELLE_DROIT'], 'string', 'max' => 250],
            [['COMMENTAIRE_DROIT'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID_DROITS' => Yii::t('app', 'Droits'),
            'ETAT_DROIT' => Yii::t('app', 'Etat Droit'),
            'LIBELLE_DROIT' => Yii::t('app', 'Libelle Droit'),
            'COMMENTAIRE_DROIT' => Yii::t('app', 'Commentaire Droit'),
            'DATE_DROIT' => Yii::t('app', 'Date Droit'),
            'DATE_DM' => Yii::t('app', 'Date Dernière modification'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrUsagers()
    {
        return $this->hasMany(GrUsager::class, ['ID_DROITS' => 'ID_DROITS']);
    }

    /**
     * {@inheritdoc}
     * @return DroitsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DroitsQuery(get_called_class());
    }
}
