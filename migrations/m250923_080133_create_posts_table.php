<?php
use yii\db\Migration;

class m250923_080133_create_posts_table extends Migration
{
    public function safeUp()
    {
        // Создание таблицы posts
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'content' => $this->text()->notNull(),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'),
        ], 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB');

        // Добавление внешнего ключа
        $this->addForeignKey(
            'fk-posts-user_id',
            'posts',
            'user_id',
            'users',
            'id',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        // Удаление внешнего ключа
        $this->dropForeignKey('fk-posts-user_id', 'posts');

        // Удаление таблицы
        $this->dropTable('posts');
    }
}
