<?php
/**
 * Created by IntelliJ IDEA.
 * User: Simone Sika
 * Date: 15/08/2018
 * Time: 16:34
 */

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class Utilisateur extends ActiveRecord implements IdentityInterface
{
    public $rawpassword;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'utilisateur';
    }

    public function rules()
    {
        return [
            [['USERNAME', 'rawpassword', 'PASSWORD', 'ADRESSE', 'TELEPHONE','DATE_NAISSANCE' ,'NOM', 'PRENOM','EMAIL','SEXE','ETAT'], 'required'],
            ['USERNAME', 'unique', 'targetClass' => 'app\models\Utilisateur', 'message' => 'Le nom d\'utilisateur est déjà pris'],
            [['USERNAME'], 'string', 'max' => 32],
            [['EMAIL'],'email'],
            [['USERNAME', 'PASSWORD', 'rawpassword', 'authKey', 'accessToken'], 'safe']
        ];
        //return parent::rules(); // TODO: Change the autogenerated stub
    }

    /**
     * Finds an identity by the given ID.
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        return static::findOne([
            'IDENTIFIANT' => $id
        ]);
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne([
            'ACCESS_TOKEN' => $token
        ]);
    }

    /**
     * @param $username
     * @return Utilisateur|null
     */
    public static function findByUsername($username)
    {
        return static::findOne([
            'USERNAME' => $username
        ]);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param $password
     * @return void
     * @throws yii\base\Exception
     */
    public function setPassword($password)
    {
        $this->PASSWORD = Yii::$app->security->generatePasswordHash($password);
    }

    public function isSamePassword($password1, $password2)
    {
        if ($password1 === $password2) {
            return true;
        }
        return false;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        //return true;
        return Yii::$app->security->validatePassword($password, $this->PASSWORD);
    }

    /**
     * Genrates remember me  authentification Key
     * @throws Exception
     * @throws \yii\base\Exception
     */
    public function generateAuthKey()
    {
        $this->AUTH_KEY = Yii::$app->security->generateRandomString();
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|int an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->IDENTIFIANT;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->AUTH_KEY;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return $this->AUTH_KEY === $authKey;
    }

    public function attributeLabels()
    {
        return [
            'identifiant' => 'Identifiant',
            'username' => 'Nom d\'utilisateur',
            'PASSWORD' => 'Mot de passe',
            'rawpassword' => 'Mot de passe encore',
            'AUTH_KEY' => 'Authentification Key',
            'ACCESS_TOKEN' => 'Access Token',
        ];
        //return parent::attributeLabels()
    }

    /**
     * @return string
     */
    public function getSexe()
    {
        $sexe = '';
        if ($this->SEXE =='M'){
            $sexe = 'Masculin';
        }else if ($this->SEXE == 'F'){
            $sexe = 'Feminin';
        }
        return $sexe;
    }
}