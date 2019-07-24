<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\helpers\Url;
use linslin\yii2\curl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new User();
        $model->load(Yii::$app->request->queryParams);
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User(['scenario' => 'create']);

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())) {
               
            $token = Yii::$app->user->identity->auth_key;
            $url = Url::base('http').'/api/v1/user?access-token='.$token;
        
            $curl = new curl\Curl();
            $response = $curl->setPostParams([
                'username' => $model->username,
                'email' => $model->email,
                'password' => $model->password_input,
            ])
            ->post($url);
            
            $result = json_decode($response, TRUE);
            if(($result['status'] == 500) ||($result['status'] == 401)){
                Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API Modul'));
            }else{
                Yii::$app->session->setFlash('success', Yii::t('app', 'API connection status was successful. Save data successful'));
            }
            
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
//        $model = $this->findModel($id);
//        $model->scenario = 'update';

        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/user/'.$id.'?access-token='.$token;
            
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $result = json_decode($response, TRUE);
        if(($result['status'] == 500) ||($result['status'] == 401)){
            Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API modul'));
            return $this->redirect(['index']);
        }else{
            $model = new User(['scenario' => 'update']);
            $model->id = $result['message'][0]['id'];
            $model->username = $result['message'][0]['username'];
            $model->auth_key = $result['message'][0]['auth_key'];
            $model->password_hash = $result['message'][0]['password_hash'];
            $model->password_reset_token = $result['message'][0]['password_reset_token'];
            $model->email = $result['message'][0]['email'];
            $model->status = $result['message'][0]['status'];
            $model->created_at = $result['message'][0]['created_at'];
            $model->updated_at = $result['message'][0]['updated_at'];
            
            if ($model->load(Yii::$app->request->post())) {

                $curl = new curl\Curl();
                $response = $curl->setPostParams([
                    'username' => $model->username,
                    'email' => $model->email,
                    'password_input' => $model->password_input,
                ])
                ->put($url);
                $result = json_decode($response, TRUE);
                
                if(($result['status'] == 500) || ($result['status'] == 401)){
                    Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API modul'));
                }else{
                    Yii::$app->session->setFlash('success', Yii::t('app', 'API connection status was successful. Update data successful'));
                }
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/user/'.$id.'?access-token='.$token; 

        $curl = new curl\Curl();
        $response = $curl->delete($url);
        $result = json_decode($response, TRUE);
        
        if(($result['status'] == 500) ||($result['status'] == 401)){
            Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API modul'));
        }else{
            Yii::$app->session->setFlash('success', Yii::t('app', 'API connection status was successful. Delete data successful'));
        } 
        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
