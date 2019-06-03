<?php
use yii\helpers\Url;
use elephantsGroup\event\components\LastEvent;
use elephantsGroup\event\components\DateList;
$module = \Yii::$app->getModule('event');
?>
<header>
	<div class="header-content">
		<div class="header-content-inner">
			<h1 id="homeHeading"><?= Yii::t('app', 'Event List')?></h1>
			<hr>
			<p><?= Yii::t('app', 'Event Description')?></p>
		</div>
	</div>
</header>

<div class="event-default-index">
	<?php
//		echo LastEvent::widget(['title'=>Yii::t('app', 'Event'), 'subtitle'=>' ', 'show_archive_button'=>true, 'archive_button_text'=>Yii::t('app', 'َEvent Archive')]);
//		echo DateList::widget();
	?>
	<section id="event" class="light-bg">
		<div class="container inner">
			<div class="row inner-top-sm">
			<?php foreach($event as $event_item): ?>
				<div class="col-md-8 inner-bottom-xs" style="padding-top: 30px; float: right">
					<figure><img src="<?= $event_item['thumb'] ?>" alt="<?= $event_item['title'] ?>"></figure>
					<h4><?= $event_item['subtitle'] ?></h4>
					<?php
						if($module->enabled_like) echo \elephantsGroup\like\components\Likes::widget(['item' => $event_item['id'], 'service' => 3]);
					?>
					<h3>
					<a href="<?= Url::to(['/event/default/view', 'id' => $event_item['id'], 'lang'=>$language]) ?>"><?= $event_item['title'] ?></a>
					</h3>
					<div class="col-md-4" style="float: right; padding: 20px;" >
					<?php
						if ($module->enabled_rating) echo \elephantsGroup\starRating\components\Rate::widget(['item' => $event_item['id'], 'service' => 3]);
					?>
					</div>
				</div>
			<?php endforeach;?>
			</div><!-- /.row -->
		</div><!-- /.container -->
	</section>
</div>
<?php echo \yii\widgets\LinkPager::widget([
    'pagination' => $pages,
]);
?>
