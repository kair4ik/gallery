<?php

namespace app\controllers;

use app\models\Folder;
use app\models\Image;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\UploadedFile;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

	public function actionUpload(){
		$model = new Image();
		if(Yii::$app->request->isPost){
			$model->file = UploadedFile::getInstance($model, 'file');
			$model->folder = $_GET['folder'];
			$model->name = $model->title = $model->upload();
			$model->description = "Описание";
			if ($model->save()) {
				$response['status'] = "success";
				$response['text'] = $model;
				return Json::encode($response);
			}
		}
		return $this->render('upload', ['model' => $model]);
	}


	public function actionEditName(){
    	$img = Image::findOne(['id'=>$_POST['id']]);
    	$newName = $_POST['newname'];
    	if ($newName !== $img->title) {
			$img->title = $newName;
			if ($img->save()){
				return "success";
			}
		}

	}

	public function actionEditDesc(){
		$img = Image::findOne(['id'=>$_POST['id']]);
		$newDesc = $_POST['newdesc'];
		if ($newDesc !== $img->description) {
			$img->description = $newDesc;
			if ($img->save()){
				return "success";
			}
		}

	}

	public function actionRemoveImage(){
    	$img = Image::findOne(['id'=>$_POST['id']]);
    	if ($img->delete()) {
			$img->deleteFile();
			return "success";
		}
	}

	public function actionCreateFolder(){
    	$folderName = $_POST['folderName'];
		$folder = new Folder();
		if ($folderName){
			$folder->name = $folderName;
			if ($folder->create()){
				$response['status'] = "success";
				$response['text'] = $folderName;
				return Json::encode($response);
			}
		}else {
			return "не передано имя папки";
		}
	}
}
