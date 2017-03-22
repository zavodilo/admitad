<?php

namespace app\controllers;

use app\models\Links;
use app\models\LinksLog;
use Carbon\Carbon;
use Yii;
use yii\base\InvalidParamException;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class LinkController extends Controller
{

    /**
     * Редиректит на указанную страницу и пишет в лог
     *
     * @return Response
     */
    public function actionTo($search)
    {
        /**
         * @var Links $link
         */
        $link = $this->getLink($search);

        // Проверяет, что ссылка не просрочена
        if ($link->date &&
            Carbon::now() > Carbon::parse($link->date)
        ) {
            throw new ForbiddenHttpException('Ссылка больше не активна');
        }
        // Создает запись в журнале переходов
        $link->createLinkLog();

        return $this->redirect($link->link, 301);
    }

    /**
     * Статистика по переходам
     *
     * @param $search
     * @return string
     */
    public function actionStat($search)
    {
        /**
         * @var Links $link
         */
        $link = $this->getLink($search);

        $data = LinksLog::find()->where(['link_id' => $link->id])->all();

        return $this->render('index', array(
            'data' => $data
        ));
    }

    /**
     * Возвращает модель ссылки по короткой ссылке
     *
     * @param $search
     * @return array|null|\yii\db\ActiveRecord
     */
    private function getLink($search)
    {
        $link = Links::find()->where(['short_link' => $search])->one();
        if (! $link) {
            throw new InvalidParamException();
        }
        return $link;
    }
}
