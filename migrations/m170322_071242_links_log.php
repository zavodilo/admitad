<?php

use yii\db\Migration;

class m170322_071242_links_log extends Migration
{
    public function up()
    {
        $this->createTable('links_log', [
            'id' => $this->primaryKey(),
            'link_id' => $this->integer()->notNull(),
            'remote_addr' => $this->text(),
            'user_agent' => $this->text(),
            'date' => $this->dateTime()
        ]);

        // creates index for column `link_id`
        $this->createIndex(
            'idx-links-link_id',
            'links_log',
            'link_id'
        );

        // add foreign key for table `links`
        $this->addForeignKey(
            'fk-links-link_id',
            'links_log',
            'link_id',
            'links',
            'id',
            'CASCADE'
        );
    }

    public function down()
    {
        // drops foreign key for table `links`
        $this->dropForeignKey(
            'fk-links-link_id',
            'links_log'
        );

        // drops index for column `link_id`
        $this->dropIndex(
            'idx-links-link_id',
            'links_log'
        );

        $this->dropTable('links_log');
    }
}
