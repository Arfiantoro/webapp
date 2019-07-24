<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

class BankController extends ActiveController
{
    public $modelClass = 'api\models\Bank'; 
    
    public function actions(){
        $actions = parent::actions();
        unset($actions['create']);
        unset($actions['update']);
        unset($actions['delete']);
        unset($actions['view']);
        unset($actions['index']);
        return $actions;
    }

    /* Declare methods supported by APIs */
    protected function verbs(){
        return [
            'create' => ['POST'],
            'update' => ['PUT', 'PATCH'],
            'delete' => ['DELETE'],
            'view' => ['GET'],
            'index'=>['GET'],
        ];
    }

    
    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return$behaviors;
    }
    
    public function actionIndex(){
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = \app\models\Bank::find()->all();
        return $model;
    }
    
    public function actionCreate() {
        
        $attributes = \yii::$app->request->post();
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
        
        $model = new \app\models\Bank();
        $model->bank_name = $attributes['bank_name'];
        $model->bank_address = $attributes['bank_address'];
        $model->bank_phone = $attributes['bank_phone'];
        $model->bank_email = $attributes['bank_email'];
        $model->bank_photo = $attributes['bank_photo'];
        if($model->save()){
            $response = array('status' => 200, 'message' => 'success');
        }else{
            $response = array('status' => 500, 'message' => $model->getErrors());
        }
        return $response;
    }
    
    public function actionView($id){
       \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
       
        $model = \app\models\Bank::find()->andWhere(['bank_id' => $id])->all();
        if(!empty($model)){
            $response = array('status' => 200, 'message' => $model);
        }else{
            $response = array('status' => 500, 'message' => 'Not Found');
        }  
        return $response;
    }
    
    public function actionUpdate($id){
        $attributes = \yii::$app->request->post();
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
        
        $model = \app\models\Bank::findOne($id);
        $model->bank_name = $attributes['bank_name'];
        $model->bank_address = $attributes['bank_address'];
        $model->bank_phone = $attributes['bank_phone'];
        $model->bank_email = $attributes['bank_email'];
        $model->bank_photo = $attributes['bank_photo'];
        if($model->save()){
            $response = array('status' => 200, 'message' => 'success');
        }
        return $response;
    }
    
    public function actionDelete($id){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
        
        $model = \app\models\Bank::findOne($id);   
        if($model->delete()){
            $response = array('status' => 200, 'message' => 'success');
        }else{
            $response = array('status' => 500, 'message' => $model->getErrors());
        }
        return $response;
    }
}