<?php

use yii\db\Migration;

class m150829_201723_create_event_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%eg_event_category}}',[
            'id' => $this->primaryKey(),
            'name' => $this->string(32)->notNull(),
            'logo' => $this->string(32)->notNull()->defaultValue('default.png'),
            'status' => $this->smallInteger(4)->notNull()->defaultValue(0)
        ]);
        $this->createTable('{{%eg_event_category_translation}}',[
            'cat_id' => $this->integer(11),
            'language' => $this->string(5)->notNull(),
            'title' => $this->string(32),
            'PRIMARY KEY (`cat_id`, `language`)'
        ]);
        $this->addForeignKey('fk_eg_event_category_translation', '{{%eg_event_category_translation}}', 'cat_id', '{{%eg_event_category}}', 'id', 'RESTRICT', 'CASCADE');

        $this->createTable('{{%eg_event}}',[
            'id' => $this->primaryKey(),
            'image' => $this->string(32)->notNull()->defaultValue('default.png'),
            'category_id' => $this->integer(11),
            'author_id' => $this->integer(11),
            'views' => $this->integer(11)->defaultValue(0),
            'sort_order' => $this->smallInteger()->notNull()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'begin_time' => $this->timestamp()->notNull(),
            'end_time' => $this->timestamp()->notNull(),
            'update_time' => $this->timestamp()->notNull(),
            'creation_time' => $this->timestamp()->notNull(),
        ]);
        $this->addForeignKey('fk_eg_event_category', '{{%eg_event}}', 'category_id', '{{%eg_event_category}}', 'id', 'SET NULL', 'CASCADE');
        $this->addForeignKey('fk_eg_event_author', '{{%eg_event}}', 'author_id', '{{%user}}', 'id', 'SET NULL', 'CASCADE');
        $this->createTable('{{%eg_event_translation}}',[
            'event_id' => $this->integer(11)->notNull(),
            'language' => $this->string(5)->notNull(),
            'title' => $this->string(255),
            'subtitle' => $this->string(255),
            'description' => $this->text(),
            'PRIMARY KEY (`event_id`,`language`)',
        ]);
        $this->addForeignKey('fk_event_translation_', '{{%eg_event_translation}}', 'event_id', '{{%eg_event}}', 'id', 'RESTRICT', 'CASCADE');

        $this->insert('{{%eg_event_category}}', [
			'id' => 1,
            'name' => 'عمومی',
			'status' => 1,
        ]);
        $this->insert('{{%eg_event_category_translation}}', [
            'cat_id' => 1,
            'language' => 'fa-IR',
            'title' => 'عمومی',
        ]);
        $this->insert('{{%eg_event_category_translation}}', [
            'cat_id' => 1,
            'language' => 'en-US',
            'title' => 'public',
        ]);
        $this->insert('{{%eg_event}}', [
			'id' => 1,
            'category_id' => 1,
            'image' => 'event-1.png',
            'begin_time' => date('Y-m-d H:i:s',time() + 7200),
            'end_time' => date('Y-m-d H:i:s',time() + 115200),
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event}}', [
			'id' => 2,
            'category_id' => 1,
            'image' => 'event-2.png',
            'begin_time' => date('Y-m-d H:i:s',time() + 14400),
            'end_time' => date('Y-m-d H:i:s',time() + 115200),
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event}}', [
			'id' => 3,
            'category_id' => 1,
            'image' => 'event-3.png',
            'begin_time' => date('Y-m-d H:i:s',time() + 21600),
            'end_time' => date('Y-m-d H:i:s',time() + 136800),
            'creation_time' => date('Y-m-d H:i:s',time()),
            'update_time' => date('Y-m-d H:i:s',time()),
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 1,
            'language' => 'fa-IR',
            'title' => 'ساخت اولین نسخه eg-cms',
            'subtitle' => 'اولین نسخه eg-cms با داشتن پلاگین های متعدد ساخته و در گیت هاب عرضه شد.',
            'description' => '<p>سورس کد برنامه در <a href="https://github.com/ElephantsGroup/eg-cms">گیت هاب</a> موجود است. این بسته بر پایه ی Yii2 ساخته شده است. اطلاعات بیشتر را می توانید در <a href="http://elephantsgroup.com">وب سایت ما</a> بیابید.</p>',
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 2,
            'language' => 'fa-IR',
            'title' => 'ساخت اولین نسخه eg-cms',
            'subtitle' => 'اولین نسخه eg-cms با داشتن پلاگین های متعدد ساخته و در گیت هاب عرضه شد.',
            'description' => '<p>سورس کد برنامه در <a href="https://github.com/ElephantsGroup/eg-cms">گیت هاب</a> موجود است. این بسته بر پایه ی Yii2 ساخته شده است. اطلاعات بیشتر را می توانید در <a href="http://elephantsgroup.com">وب سایت ما</a> بیابید.</p>',
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 3,
            'language' => 'fa-IR',
            'title' => 'ساخت اولین نسخه eg-cms',
            'subtitle' => 'اولین نسخه eg-cms با داشتن پلاگین های متعدد ساخته و در گیت هاب عرضه شد.',
            'description' => '<p>سورس کد برنامه در <a href="https://github.com/ElephantsGroup/eg-cms">گیت هاب</a> موجود است. این بسته بر پایه ی Yii2 ساخته شده است. اطلاعات بیشتر را می توانید در <a href="http://elephantsgroup.com">وب سایت ما</a> بیابید.</p>',
        ]);
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk_event_translation_', '{{%eg_event_translation}}');
        $this->dropTable('{{%eg_event_translation}}');
        $this->dropForeignKey('fk_eg_event_category', '{{%eg_event}}');
        $this->dropForeignKey('fk_eg_event_author', '{{%eg_event}}');
        $this->dropTable('{{%eg_event}}');
        $this->dropForeignKey('fk_eg_event_category_translation', '{{%eg_event_category_translation}}');
        $this->dropTable('{{%eg_event_category_translation}}');
        $this->dropTable('{{%eg_event_category}}');
    }
}
