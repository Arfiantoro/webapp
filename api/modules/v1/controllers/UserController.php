<?php

namespace app\api\modules\v1\controllers;

use yii\rest\ActiveController;
use yii\filters\auth\QueryParamAuth;

class UserController extends ActiveController {

    public $modelClass = 'app\models\User';

    public function behaviors() {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => QueryParamAuth::className(),
        ];
        return$behaviors;
    }
    
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

    public function actionIndex() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $model = \app\models\User::find()->all();
        return $model;
    }

    public function actionCreate() {
        $attributes = \yii::$app->request->post();
        
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
        
        $model = new \app\models\User();
        $model->username = $attributes['username'];
        $model->email = $attributes['email'];
        $model->password_input = $attributes['password'];
        
        if (!empty($model->password_input)) {
            $model->setPassword($model->password_input);
            $model->generateAuthKey();
            $model->generatePasswordResetToken();
        }

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
       
        $model = \app\models\User::find()->andWhere(['id' => $id])->all();
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
        
        $model = \app\models\User::findOne($id);
        $model->username = $attributes['username'];
        $model->email = $attributes['email'];
        $model->password_input = $attributes['password_input'];
        if (!empty($model->password_input)) {
            $model->setPassword($model->password_input);
            $model->generateAuthKey();
            $model->generatePasswordResetToken();
        }
        if($model->save()){
            $response = array('status' => 200, 'message' => 'success');
        }
        return $response;
    }
    
    public function actionDelete($id){

        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $response = array('status' => 500, 'message' => 'failed');
        
        $model = \app\models\User::findOne($id);   
        if($model->delete()){
            $response = array('status' => 200, 'message' => 'success');
        }else{
            $response = array('status' => 500, 'message' => $model->getErrors());
        }
        return $response;
    }
    
}
