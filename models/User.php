<?php

namespace app\models;

use Yii;
//use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use linslin\yii2\curl;
use yii\helpers\Url;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    const STATUS_PREREGISTER = 0;
    const STATUS_REGISTER = 1;
    const STATUS_COMPLETE_REGISTER = 2;
    const STATUS_APPROVED = 3;
    const STATUS_DELETED = 4;
    const STATUS_CLOSED = 5;

    public $password_input;


    /**
    * @inheritdoc
    */
    
    public static function tableName()
    {
        return 'user';
    }
	
	
    /**
     * {@inheritdoc}
    */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'password_reset_token'], 'required', 'on' => ['update']],
            [['username', 'auth_key', 'password_hash', 'email', 'password_reset_token', 'password_input'], 'required', 'on' => ['create']],
            [['status'], 'integer'],
            [['username', 'auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email', 'password_input'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'password_input' => 'Password',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::find()->where([
            'id' => $id,
        ])->one();
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
        return static::findOne(['auth_key' => $token]);

    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::find()->andWhere([
            'username' => $username,
        ])->one();

    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        //return $this->password === $password;
	return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    
     /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password) {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey() {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken() {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken() {
        $this->password_reset_token = null;
    }
    
    public function getLevelUser()
    {
        return $this->hasOne(AuthAssignment::className(), ['user_id' => 'id']);
    }
    
    public function search(){
        
        // if use model active record
        
        
//        $query = self::find()
//                ->andFilterWhere(['=', 'user.id', $this->id])
//                ->andFilterWhere(['like', 'user.username', $this->username])
//                ->andFilterWhere(['like', 'user.email', $this->email])
//                ->andFilterWhere(['=', 'user.status', $this->status]);
//             
//        $dataProvider = new ActiveDataProvider([
//            'query' => $query,
//            'sort' => [
//                'defaultOrder' => ['username' => SORT_ASC],
//                'attributes' => ['id', 'username', 'email', 'status']
//            ],
//            'pagination' => [
//                'pageSize' => 10,
//            ],
//        ]);
//        
//        return $dataProvider;
        
        
        // if use model rest API
        
        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/user?access-token='.$token; 
        
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $result = json_decode($response, TRUE);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
            'sort' => [
                'defaultOrder' => ['username' => SORT_ASC],
                'attributes' => ['id', 'username', 'email', 'status']
            ],
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        return $dataProvider;
    }
}
