<section id="event" class="light-bg">
	<div class="container inner">
		<div class="row">
			<div class="col-md-8 col-sm-9 center-block text-center">
				<header>
					<h2><?= $last_event_title; ?></h2>
					<p><?= $last_event_subtitle; ?></p>
				</header>
			</div><!-- /.col -->
		</div><!-- /.row -->
		<div class="row inner-top-sm">
<?php
	foreach($event as $event_item)
	{
		echo '<div class="col-md-4 inner-bottom-xs">' .
			'<figure><img src="'. $event_item['image'] . '" alt="' . $event_item['title'] . '"></figure>' .
			'<h4>' . $event_item['subtitle'] . '</h4>' .
			'<h3>' . $event_item['title'] . '</h3>' .
			//'<div class="text-small">' . $event_item['intro'] . '</div>' .
		'</div><!-- /.col -->';
	}
?>
		</div><!-- /.row -->		
	</div><!-- /.container -->
</section>