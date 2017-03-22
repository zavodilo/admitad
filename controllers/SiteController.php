<?php

namespace app\controllers;

use app\models\Links;
use Carbon\Carbon;
use Yii;
use yii\base\InvalidParamException;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

class SiteController extends Controller
{

    /**
     * @inheritdoc
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
     * Отображение страницы создания ссылок.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Сохраняет ссылку.
     *
     * @return array
     */
    public function actionSave()
    {
        $model = new Links;

        $model->fill();

        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($model->validate()) {
            $model->save();
            return [
                'id' => $model->id,
            ];
        } else {
            throw new InvalidParamException();
        }
    }
}
