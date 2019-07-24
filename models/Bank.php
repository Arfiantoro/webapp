<?php

namespace app\models;

use Yii;
//use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use linslin\yii2\curl;
use yii\helpers\Url;

/**
 * This is the model class for table "tbl_bank".
 *
 * @property int $bank_id
 * @property string $bank_name
 * @property string $bank_address
 * @property string $bank_phone
 * @property int $bank_email
 * @property string $bank_photo
 */
class Bank extends \yii\db\ActiveRecord
{
    public $temp;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_bank';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bank_name', 'bank_address', 'bank_phone', 'bank_email', 'temp'], 'required', 'on' => ['create']],
            [['bank_name', 'bank_address', 'bank_phone', 'bank_email'], 'required', 'on' => ['update']],
            [['bank_address'], 'string'],
            [['bank_email'], 'email'],
            [['bank_name', 'bank_email'], 'string', 'max' => 255],
            [['bank_phone'], 'string', 'max' => 20],
            [['bank_photo'], 'string', 'max' => 1000],
            [['temp'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'bank_id' => Yii::t('app', 'Bank ID'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'bank_address' => Yii::t('app', 'Bank Address'),
            'bank_phone' => Yii::t('app', 'Bank Phone'),
            'bank_email' => Yii::t('app', 'Bank Email'),
            'bank_photo' => Yii::t('app', 'Bank Photo'),
            'temp' => Yii::t('app', 'Photo'),
        ];
    }
    
    public function search(){
        
        // if use model active record
        
        /*
        $query = self::find()
                ->andFilterWhere(['=', 'tbl_bank.bank_id', $this->bank_id])
                ->andFilterWhere(['like', 'tbl_bank.bank_name', $this->bank_name])
                ->andFilterWhere(['like', 'tbl_bank.bank_address', $this->bank_address])
                ->andFilterWhere(['=', 'tbl_bank.bank_phone', $this->bank_phone])
                ->andFilterWhere(['=', 'tbl_bank.bank_photo', $this->bank_photo])
                ->andFilterWhere(['like', 'tbl_bank.bank_email', $this->bank_email]);
             
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['bank_name' => SORT_ASC],
                'attributes' => ['bank_id', 'bank_name', 'bank_address', 'bank_phone', 'bank_photo', 'bank_photo']
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        
        return $dataProvider;
        */
        
        // if use model rest API
        
        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/bank?access-token='.$token; 
        
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $result = json_decode($response, TRUE);
        
        $dataProvider = new ArrayDataProvider([
            'allModels' => $result,
            'sort' => [
                'defaultOrder' => ['bank_name' => SORT_ASC],
                'attributes' => ['bank_id', 'bank_name', 'bank_address', 'bank_phone', 'bank_photo', 'bank_photo']
            ],
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $dataProvider;
    }
}
