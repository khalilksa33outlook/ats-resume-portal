<?php

use yii\db\Migration;

class m260415_094959_create_resume_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Resume Main Table
    $this->createTable('{{%resume}}', [
        'id' => $this->primaryKey(),
        'user_id' => $this->integer()->notNull(),
        'title' => $this->string(255)->notNull(),
        'summary' => $this->text(),
        'language' => $this->string(5)->defaultValue('en'),
        'is_paid' => $this->boolean()->defaultValue(false),
        'created_at' => $this->integer(),
        'updated_at' => $this->integer(),
    ]);

    // Experience Table
    $this->createTable('{{%resume_experience}}', [
        'id' => $this->primaryKey(),
        'resume_id' => $this->integer()->notNull(),
        'company' => $this->string(255),
        'job_title' => $this->string(255),
        'description' => $this->text(),
        'start_date' => $this->date(),
        'end_date' => $this->date(),
    ]);

    // Add Foreign Key for Experience
    // $this->addForeignKey('fk-experience-resume', '{{%resume_experience}}', 'resume_id', '{{%resume}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260415_094959_create_resume_tables cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260415_094959_create_resume_tables cannot be reverted.\n";

        return false;
    }
    */
}
