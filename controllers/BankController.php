<?php

namespace app\controllers;

use Yii;
use app\models\Bank;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use linslin\yii2\curl;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\web\Response;
use yii\helpers\Url;

/**
 * BankController implements the CRUD actions for Bank model.
 */
class BankController extends Controller
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
     * Lists all Bank models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Bank();
        $model->load(Yii::$app->request->queryParams);
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Bank model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bank(['scenario' => 'create']);
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if($model->load(Yii::$app->request->post())) {
            
            //upload image
            $image = UploadedFile::getInstance($model, 'temp');
            if ($image == null) {
                $ext = '';
            } else {
                $ext = explode(".", $image->name);
                $ext = end($ext);
            }
            $fileName = Yii::$app->security->generateRandomString() . ".{$ext}";
            $path = Yii::$app->basePath . '/assets_b/uploads/secret/' . $fileName;
            $oldPath = null;
            if (!empty($model->bank_photo)) {
                $oldPath = Yii::$app->basePath . '/assets_b/uploads/secret/' . $model->bank_photo;
            }
            $image != null ? $model->bank_photo = $fileName : '';
            
            
            
            //if use model active record
            
            //if($model->save()){
            //     return $this->redirect(['index']);
            //}

            // if use model rest api
               
            $token = Yii::$app->user->identity->auth_key;
            $url = Url::base('http').'/api/v1/bank?access-token='.$token;
        
            $curl = new curl\Curl();
            $response = $curl->setPostParams([
                'bank_name' => $model->bank_name,
                'bank_address' => $model->bank_address,
                'bank_phone' => $model->bank_phone,
                'bank_email' => $model->bank_email,
                'bank_photo' => $model->bank_photo,
                 ])
            ->post($url);
            
            $result = json_decode($response, TRUE);

            if(($result['status'] == 500) ||($result['status'] == 401)){
                Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API Modul'));
            }else{
                if ($image != null) {
                    if (!file_exists(Yii::$app->basePath . '/assets_b/uploads/secret/')) {
                        FileHelper::createDirectory(Yii::$app->basePath . '/assets_b/uploads/secret/');
                    }
                    $image->saveAs($path);
                    if ($oldPath && file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }
                Yii::$app->session->setFlash('success', Yii::t('app', 'API connection status was successful. Save data successful'));
            }
            
            return $this->redirect(['index']);
            
        }else{
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Bank model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        // if use model active record
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->bank_id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
        
        // if use model rest api
        
        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/bank/'.$id.'?access-token='.$token;
            
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $result = json_decode($response, TRUE);
        if(($result['status'] == 500) ||($result['status'] == 401)){
            Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API modul'));
            return $this->redirect(['index']);
        }else{
            $model = new Bank(['scenario' => 'update']);
            $model->bank_id = $result['message'][0]['bank_id'];
            $model->bank_name = $result['message'][0]['bank_name'];
            $model->bank_address = $result['message'][0]['bank_address'];
            $model->bank_phone = $result['message'][0]['bank_phone'];
            $model->bank_email = $result['message'][0]['bank_email'];
            $model->bank_photo = $result['message'][0]['bank_photo'];
            
            if ($model->load(Yii::$app->request->post())) {

                $image = UploadedFile::getInstance($model, 'temp');
                if ($image == null) {
                    $ext = '';
                } else {
                    $ext = explode(".", $image->name);
                    $ext = end($ext);
                }
                $fileName = Yii::$app->security->generateRandomString() . ".{$ext}";
                $path = Yii::$app->basePath . '/assets_b/uploads/secret/' . $fileName;
                $oldPath = null;
                if (!empty($model->bank_photo)) {
                    $oldPath = Yii::$app->basePath . '/assets_b/uploads/secret/' . $model->bank_photo;
                }
                $image != null ? $model->bank_photo = $fileName : '';
            
                $curl = new curl\Curl();
                $response = $curl->setPostParams([
                    'bank_name' => $model->bank_name,
                    'bank_address' => $model->bank_address,
                    'bank_phone' => $model->bank_phone,
                    'bank_email' => $model->bank_email,
                    'bank_photo' => $model->bank_photo,
                     ])
                ->put($url);
                $result = json_decode($response, TRUE);

                if(($result['status'] == 500) || ($result['status'] == 401)){
                    Yii::$app->session->setFlash('error', Yii::t('app', 'an error occurred with API modul'));
                }else{
                    if ($image != null) {
                        if (!file_exists(Yii::$app->basePath . '/assets_b/uploads/secret/')) {
                            FileHelper::createDirectory(Yii::$app->basePath . '/assets_b/uploads/secret/');
                        }
                        $image->saveAs($path);
                        if ($oldPath && file_exists($oldPath)) {
                            unlink($oldPath);
                        }
                    }
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
     * Deletes an existing Bank model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        // if use model active record
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
        
        // if use model rest api
        
        $token = Yii::$app->user->identity->auth_key;
        $url = Url::base('http').'/api/v1/bank/'.$id.'?access-token='.$token; 

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
    
    public function actionGetImage($fileName) {
        $response = Yii::$app->getResponse();
        $response->headers->set('Content-Type', 'image/jpeg');
        $response->format = Response::FORMAT_RAW;
        $imgFullPath = Yii::$app->basePath . '/assets_b/uploads/secret/' . $fileName;
        if (file_exists($imgFullPath)) {
            if (!is_resource($response->stream = fopen($imgFullPath, 'r'))) {
                throw new ServerErrorHttpException('file access failed: permission deny');
            }
        } else {
            throw new NotFoundHttpException();
        }

        $response->send();
    }

    public function actionRemoveImage($id) {
        $model = $this->findModel($id);

        $imgFullPath = Yii::$app->basePath . '/assets_b/uploads/secret/' . $model->bank_photo;
        if (file_exists($imgFullPath)) {
            unlink($imgFullPath);
        }
        $model->bank_photo = null;
        $model->save();

        return Json::encode("Image successfully deleted");
    }

    /**
     * Finds the Bank model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bank the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bank::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
