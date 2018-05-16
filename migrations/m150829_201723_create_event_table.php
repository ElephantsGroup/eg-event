<?php

use yii\db\Schema;
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
            'name' => 'عمومی',
        ]);
        $this->insert('{{%eg_event_category_translation}}', [
            'cat_id' => 1,
            'language' => 'fa-IR',
            'title' => 'عمومی',
        ]);
        $this->insert('{{%eg_event}}', [
            'category_id' => 1,
            'image' => 'event-1.png',
            'begin_time' => 1467629406,
            'end_time' => 1467629406,
            'creation_time' => 1467629406,
            'update_time' => 1467629406,
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event}}', [
            'category_id' => 1,
            'image' => 'event-2.png',
            'begin_time' => 1467629406,
            'end_time' => 1467629406,
            'creation_time' => 1467629406,
            'update_time' => 1467629406,
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event}}', [
            'category_id' => 1,
            'image' => 'event-3.png',
            'begin_time' => 1467629406,
            'end_time' => 1467629406,
            'creation_time' => 1467629406,
            'update_time' => 1467629406,
            'author_id' => 1,
            'status' => 1,
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 1,
            'language' => 'fa-IR',
            'title' => 'بروزرسانی سایت کلید',
            'subtitle' => 'سایت کلید به زودی بروز رسانی خواهد شد.',
            'description' => '<p>.بروزرسانی سایت کلید در اولین روز&nbsp;هفته آینده انجام خواهد شد</p>',
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 2,
            'language' => 'fa-IR',
            'title' => 'بروزرسانی سایت کلید',
            'subtitle' => 'سایت کلید به زودی بروز رسانی خواهد شد.',
            'description' => '<p>.بروزرسانی سایت کلید در اولین روز&nbsp;هفته آینده انجام خواهد شد</p>',
        ]);
        $this->insert('{{%eg_event_translation}}', [
            'event_id' => 3,
            'language' => 'fa-IR',
            'title' => 'بروزرسانی سایت کلید',
            'subtitle' => 'سایت کلید به زودی بروز رسانی خواهد شد.',
            'description' => '<p>.بروزرسانی سایت کلید در اولین روز&nbsp;هفته آینده انجام خواهد شد</p>',
        ]);

        $this->insert('{{%auth_item}}', [
            'name' => '/event/admin/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => '/event/category-admin/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => '/event/translation/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => '/event/category-translation/*',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'event_management',
            'type' => 2,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/admin/*',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/category-admin/*',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/category-translation/*',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/translation/*',
        ]);
        $this->insert('{{%auth_item}}', [
            'name' => 'event_manager',
            'type' => 1,
            'created_at' => 1467629406,
            'updated_at' => 1467629406
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'event_manager',
            'child' => 'event_management',
        ]);
        $this->insert('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'event_manager',
        ]);
    }

    public function safeDown()
    {
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'super_admin',
            'child' => 'event_manager',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'event_manager',
            'child' => 'event_management',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'event_manager',
            'type' => 1,
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/translation/*',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/category-translation/*',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/category-admin/*',
        ]);
        $this->delete('{{%auth_item_child}}', [
            'parent' => 'event_management',
            'child' => '/event/admin/*',
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => 'event_management',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/event/category-translation/*',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/event/translation/*',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/event/category-admin/*',
            'type' => 2,
        ]);
        $this->delete('{{%auth_item}}', [
            'name' => '/event/admin/*',
            'type' => 2,
        ]);

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
