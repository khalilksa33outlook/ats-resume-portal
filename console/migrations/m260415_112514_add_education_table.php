<?php

use yii\db\Migration;

class m260415_112514_add_education_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
{
    $this->createTable('{{%resume_education}}', [
        'id' => $this->primaryKey(),
        'resume_id' => $this->integer()->notNull(),
        'institution' => $this->string(255)->notNull(),
        'degree' => $this->string(255),
        'field_of_study' => $this->string(255),
        'start_date' => $this->date(),
        'end_date' => $this->date(),
        'description' => $this->text(),
    ]);

    // $this->addForeignKey('fk-education-resume', '{{%resume_education}}', 'resume_id', '{{%resume}}', 'id', 'CASCADE');
}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m260415_112514_add_education_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260415_112514_add_education_table cannot be reverted.\n";

        return false;
    }
    */
}
