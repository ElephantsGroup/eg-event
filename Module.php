<?php

namespace elephantsGroup\event;

use Yii;

class Module extends \yii\base\Module
{
    public $enabled_like;
    public $enabled_follow;
    public $enabled_comment;
    public $enabled_rating;
    public $page_size = 10;
    
    public function init()
    {
        parent::init();

        if (empty(Yii::$app->i18n->translations['event']))
		{
            Yii::$app->i18n->translations['event'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
		if (empty(Yii::$app->i18n->translations['event_cat']))
		{
            Yii::$app->i18n->translations['event_cat'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
		if (empty(Yii::$app->i18n->translations['event_params']))
		{
            Yii::$app->i18n->translations['event_params'] =
			[
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => __DIR__ . '/messages',
                //'forceTranslation' => true,
            ];
        }
    }
	public static function t($category, $message, $params = [], $language = null)
    {
        return \Yii::t($category, $message, $params, $language);
    }

}
