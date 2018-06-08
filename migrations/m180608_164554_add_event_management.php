<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m180608_164554_add_create_management
 */
class m180608_164554_add_event_management extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$db = \Yii::$app->db;
		$query = new Query();
        if ($db->schema->getTableSchema("{{%auth_item}}", true) !== null)
		{
			if (!$query->from('{{%auth_item}}')->where(['name' => '/event/admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/event/admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/event/category-admin/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/event/category-admin/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/event/translation/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/event/translation/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => '/event/category-translation/*'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> '/event/category-translation/*',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'event_management'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'event_management',
					'type'			=> 2,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'event_manager'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'event_manager',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
			if (!$query->from('{{%auth_item}}')->where(['name' => 'administrator'])->exists())
				$this->insert('{{%auth_item}}', [
					'name'			=> 'administrator',
					'type'			=> 1,
					'created_at'	=> time(),
					'updated_at'	=> time()
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_item_child}}", true) !== null)
		{
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'event_management', 'child' => '/event/admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'event_management',
					'child'		=> '/event/admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'event_management', 'child' => '/event/category-admin/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'event_management',
					'child'		=> '/event/category-admin/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'event_management', 'child' => '/event/translation/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'event_management',
					'child'		=> '/event/translation/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'event_management', 'child' => '/event/category-translation/*'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'event_management',
					'child'		=> '/event/category-translation/*'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'event_manager', 'child' => 'event_management'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'event_manager',
					'child'		=> 'event_management'
				]);
			if (!$query->from('{{%auth_item_child}}')->where(['parent' => 'administrator', 'child' => 'event_manager'])->exists())
				$this->insert('{{%auth_item_child}}', [
					'parent'	=> 'administrator',
					'child'		=> 'event_manager'
				]);
		}
        if ($db->schema->getTableSchema("{{%auth_assignment}}", true) !== null)
		{
			if (!$query->from('{{%auth_assignment}}')->where(['item_name' => 'administrator', 'user_id' => 1])->exists())
				$this->insert('{{%auth_assignment}}', [
					'item_name'	=> 'administrator',
					'user_id'	=> 1,
					'created_at' => time()
				]);
		}
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
		// it's not safe to remove auth data in migration down
    }
}
