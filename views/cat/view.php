<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use elephantsGroup\event\models\Event;
use elephantsGroup\event\models\EventCategory;
use elephantsGroup\jdf\Jdf;
use elephantsGroup\user\models\User;
use elephantsGroup\event\models\EventCategoryTranslation;
use yii\helpers\Url;
use elephantsGroup\follow\assets\FollowAsset;

FollowAsset::register($this);


/* @var $this yii\web\View */
/* @var $model app\models\Event */
$module_cat = \Yii::$app->getModule('event_cat');
$module = \Yii::$app->getModule('event');
$lang = Yii::$app->language;

$this->params['breadcrumbs'][] = ['label' => Yii::t('event', 'Events'), 'url' => ['index', 'lang'=>Yii::$app->controller->language]];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- ============================================================= SECTION – Event POST ============================================================= -->
<header>
	<div class="header-content">
		<div class="header-content-inner">
			<a href="<?= Yii::getAlias('@web') ?>/event-list/index" style="color: white"><h1 id="homeHeading"><?= Yii::t('event_cat', 'Related Event Categories')?></h1></a>
			<hr>
			<p><?= ($model->translationByLang ? $model->translationByLang->title : '') ?></p>

		</div>
	</div>
</header>
<section id="event-post" class="light-bg">
	<div class="container inner-top-sm inner-bottom classic-event no-sidebar">
		<div class="row">
			<div class="col-md-9 center-block">
					
				<div class="post">
				
					<div class="post-content">
						<div class="post-media">
							<figure>
								<img src=" <?= EventCategory::$upload_url . $model->id . '/' . $model->logo ?>" alt="">
							</figure>
							<?php
								if($module->enabled_follow) echo \elephantsGroup\follow\components\Follows::widget(['item' => $model->id, 'service' => 3]);
							?>
						</div>
						
						<h1 class="post-title"><?= Html::encode($this->title) ?></h1>

						<ul class="post-details">
							<?php foreach ($event_list as $item):?>
							<li>
								<h4><?= $item['subtitle'] ?></h4>
								<h3>
									<a href="<?= Url::to(['/event/default/view', 'id'=>$item['id']]) ?>"><?= $item['title'] ?></a>
								</h3>
							</li>
							<?php endforeach;?>
						</ul><!-- /.post-details -->
						<div class="clearfix"></div>

					</div><!-- /.post-content -->
					
				</div><!-- /.post -->
				
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<!-- ============================================================= SECTION – Event POST : END ============================================================= -->
