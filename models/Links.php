<?php

namespace app\models;

use Carbon\Carbon;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "links".
 *
 * @property integer $id
 * @property string $short_link
 * @property string $link
 * @property string $date
 */
class Links extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['short_link', 'link'], 'required'],
            [['link'], 'string'],
            [['date'], 'safe'],
            [['short_link'], 'string', 'max' => 255],
            [['short_link'], 'unique'],
            ['date', 'date', 'format' => 'yyyy-M-d H:m:s'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'short_link' => 'Short Link',
            'link' => 'Link',
            'date' => 'Date',
        ];
    }

    /**
     * Создает запись в журнале
     */
    public function createLinkLog()
    {
        $link_log = new LinksLog();
        $link_log->link_id = $this->id;
        // Устанавливает ip
        $link_log->remote_addr = getenv("REMOTE_ADDR");
        // Устанавливает User Agent
        $link_log->user_agent = getenv("HTTP_USER_AGENT");
        // Устанавливает дату
        $link_log->date = Carbon::now()->toDateTimeString();

        $link_log->save();
    }

    /**
     * Заполняет модель данными из реквеста
     */
    public function fill()
    {
        // Устаавливаю короткую сслыку
        $this->short_link = Yii::$app->request->post('short_link');
        // Устанавливаю полную сслку
        $this->link = Yii::$app->request->post('full_link');
        // Устанавливаю дату
        $date = Yii::$app->request->post('date');
        if ($date) {
            $this->date = Carbon::parse($date)->toDateTimeString();
        }
    }
}
