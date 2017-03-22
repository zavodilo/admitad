<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div ng-app="ngAppMain" ng-strict-di>
        <div ng-controller="Ctrl" ng-init="save_link='<?= Url::to(['site/save']); ?>'">
            <!--Заполняем данные для короткой ссылки-->
            <div ng-hide="link_created">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Полная&nbsp;ссылка:&nbsp;&nbsp;&nbsp;</span>
                    <input type="text" ng-model="full_link" class="form-control" placeholder="" aria-describedby="basic-addon2">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Короткая&nbsp;ссылка:</span>
                    <input type="text" ng-model="short_link" class="form-control" placeholder="" aria-describedby="basic-addon1">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon3">Время&nbsp;жизни&nbsp;до:&nbsp;</span>
                    <input type="datetime-local" ng-model="date" class="form-control" placeholder="" aria-describedby="basic-addon3">
                </div>
                <button type="button" class="btn btn-default" ng-click="sendLink()">Создать ссылку</button>
            </div>

            <!--Вывод ошибки-->
            <div ng-show="error">
                <div class="alert alert-danger" role="alert" ng-show="error">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Ошибка:</span>
                    {{ error }}
                </div>
            </div>

            <!--Вывод ссылки в случае успеха-->
            <div ng-show="link_created">
                <h4>Ссылка создана</h4>
                <p>Ваша ссылка:
                    <a href="<?= Url::base(true); ?>/link/{{ short_link }}">
                    <?= Url::base(true); ?>/link/{{ short_link }}
                    </a>
                </p>
                <p>Статистика:
                    <a href="<?= Url::base(true); ?>/stat/{{ short_link }}">
                        <?= Url::base(true); ?>/stat/{{ short_link }}
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
