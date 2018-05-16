<?php
	use yii\helpers\Url;
	use elephantsGroup\event\models\Event;
?>

<section id="event" class="light-bg">
	<div class="container inner">
		<div class="row">
			<div class="col-md-8 col-sm-9 center-block text-center">
				<header>
					<?php echo ($event_title_is_link ? '<a href="' . Url::to(['/event', 'lang'=>$language]) . '"><h2>' . $last_event_title . '</h2></a>' : '<h2>' . $last_event_title . '</h2>') ?>

					<?php if(!$last_event_subtitle)
						echo "<p> $last_event_subtitle </p>";
					?>
				</header>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div class="row inner-top-sm">
<?php
	foreach($event as $event_item)
	{
		echo '<div class="col-md-4 inner-bottom-xs">' .
			'<figure><img src="' . $event_item['image'] . '" alt="' . $event_item['title'] . '"></figure>' .
			'<h4>' . $event_item['subtitle'] . '</h4>' .
			'<h3>' .
			($event_title_is_link ? '<a href="' . Url::to(['/event/default/view', 'id'=>$event_item['id'], 'lang'=>$language]) . '">' . $event_item['title'] . '</a>' : $event_item['title']) .
			'</h3>' .

			//'<div class="text-small">' . $event_item['intro'] . '</div>' .
		'</div><!-- /.col -->';
	}
?>
		</div><!-- /.row -->
		<?php if($show_global_more)
			echo '<div class="row text-center"><a href="' . Yii::getAlias('@web') . '/event" class="btn btn-default">' . $global_more_text . '</a></div>';
		?>
		<?php if($show_archive_button)
			echo '<div class="row text-center"><a href="' . Yii::getAlias('@web') . '/event/archive?lang=' . (isset($language) ? $language : 'fa-IR') .'"class="btn btn-default">' . $archive_button_text . '</a></div>';
		?>
	</div><!-- /.container -->
</section>