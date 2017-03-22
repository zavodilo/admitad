<?php

use yii\db\Schema;
use yii\db\Migration;

class m170321_155742_links extends Migration
{
    public function up()
    {
        $this->createTable('links', [
            'id' => $this->primaryKey(),
            'short_link' => $this->string()->notNull()->unique(),
            'link' => $this->text()->notNull(),
            'date' => $this->dateTime()
        ]);

        //TODO не нужен, тк поле будет уникальное, а у уникального создается индекс
        /*
        // Создаю индекс для поля `short_link`
        $this->createIndex(
            'idx-links-short_link',
            'links',
            'short_link'
        );
        */
    }

    public function down()
    {
        /*
        // Удаляю индекс
        $this->dropIndex(
            'idx-links-short_link',
            'links'
        );
        */

        $this->dropTable('links');
    }
}
