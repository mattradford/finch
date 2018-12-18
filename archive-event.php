<div class="page__wrap">
	<header>
		<div class="page__title">
			<h1><?php echo roots_title(); ?></h1>
		</div>
    </header>
	<?php
	$term = get_queried_object();
	echo do_shortcode('[eo_events event_category="'. $term->slug .'" showpastevents="false"]');
	?>
</div>