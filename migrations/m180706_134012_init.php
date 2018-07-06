<?php

use yii\db\Migration;

/**
 * Class m180706_134012_init
 */
class m180706_134012_init extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
      $tableOptions = null;
      if ($this->db->driverName === 'mysql') {
        // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
        $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE=InnoDB';
      }

      $this->createTable('{{%user}}', [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull()->unique(),
        'auth_key' => $this->string(32)->notNull(),
        'password_hash' => $this->string()->notNull(),
        'password_reset_token' => $this->string()->unique(),
        'email' => $this->string()->notNull()->unique(),

        'status' => $this->smallInteger()->notNull()->defaultValue(10),
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);

      $this->createTable('{{%admin}}', [
        'id' => $this->primaryKey(),
        'username' => $this->string()->notNull()->unique(),
        'auth_key' => $this->string(32)->notNull(),
        'password_hash' => $this->string()->notNull(),
        'password_reset_token' => $this->string()->unique(),
        'email' => $this->string()->notNull()->unique(),

        'status' => $this->smallInteger()->notNull()->defaultValue(10),
        'created_at' => $this->integer()->notNull(),
        'updated_at' => $this->integer()->notNull(),
      ], $tableOptions);

      $this->insert('{{admin}}', [
        'username' => 'admin',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('123456'),
        'email' => 'aqiang@yeah.net',
        'status' => 10,
        'created_at' => time(),
        'updated_at' => time(),
      ]);
    }

    public function down()
    {
      $this->dropTable('{{%user}}');
      $this->dropTable('{{%admin}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180706_134012_init cannot be reverted.\n";

        return false;
    }
    */
}
