<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "links_log".
 *
 * @property integer $id
 * @property integer $link_id
 * @property string $remote_addr
 * @property string $user_agent
 * @property string $date
 *
 * @property Links $link
 */
class LinksLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['link_id'], 'required'],
            [['link_id'], 'integer'],
            [['remote_addr', 'user_agent'], 'string'],
            [['date'], 'safe'],
            [['link_id'], 'exist', 'skipOnError' => true, 'targetClass' => Links::className(), 'targetAttribute' => ['link_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link_id' => 'Link ID',
            'remote_addr' => 'Remote Addr',
            'user_agent' => 'User Agent',
            'date' => 'Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(Links::className(), ['id' => 'link_id']);
    }
}
