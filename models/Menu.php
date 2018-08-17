<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $ID_MENU
 * @property int $MEN_ID_MENU
 * @property string $NAME_MENU
 * @property string $LIBEL_MENU
 * @property string $ICONE_NAME_MENU
 * @property string $CONTROLE
 * @property string $NUM_ORDREMENU
 * @property string $MENU_URL
 *
 * @property Fonctionnalite[] $fonctionnalites
 * @property Menu $mENIDMENU
 * @property Menu[] $menus
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['MEN_ID_MENU'], 'integer'],
            [['NAME_MENU', 'LIBEL_MENU', 'CONTROLE'], 'required'],
            [['NAME_MENU', 'ICONE_NAME_MENU', 'MENU_URL'], 'string', 'max' => 50],
            [['LIBEL_MENU'], 'string', 'max' => 120],
            [['CONTROLE'], 'string', 'max' => 5],
            [['NUM_ORDREMENU'], 'string', 'max' => 15],
            [['MEN_ID_MENU'], 'exist', 'skipOnError' => true, 'targetClass' => Menu::className(), 'targetAttribute' => ['MEN_ID_MENU' => 'ID_MENU']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_MENU' => Yii::t('app', 'Id  Menu'),
            'MEN_ID_MENU' => Yii::t('app', 'Menu Parent'),
            'NAME_MENU' => Yii::t('app', 'Nom du menu'),
            'LIBEL_MENU' => Yii::t('app', 'Libelle du menu'),
            'ICONE_NAME_MENU' => Yii::t('app', 'Nom de l\'icône du menu'),
            'CONTROLE' => Yii::t('app', 'Controle'),
            'NUM_ORDREMENU' => Yii::t('app', 'Numero d\'ordre'),
            'MENU_URL' => Yii::t('app', 'Adresse du menu'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFonctionnalites()
    {
        return $this->hasMany(Fonctionnalite::className(), ['ID_MENU' => 'ID_MENU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMENIDMENU()
    {
        return $this->hasOne(Menu::className(), ['ID_MENU' => 'MEN_ID_MENU']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(Menu::className(), ['MEN_ID_MENU' => 'ID_MENU']);
    }
}
