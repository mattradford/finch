<?php
/*
Template Name: Where We Meet
*/
?>

<div class="page__wrap <?php if (has_post_thumbnail()) { echo ' page__image'; } ?>">

        <?php while (have_posts()) : the_post(); ?>
            <div class="page__title"><h1><?php echo roots_title(); ?></h1></div>
            <?php get_template_part('templates/content', 'page'); ?>
            <?php if( get_field('location') ) {
                    $location = get_field('location');
            ?>
            <div class="acf-map--mobile">
              <img src="http://maps.googleapis.com/maps/api/staticmap?center=<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>&markers=<?php echo $location['lat']; ?>,<?php echo $location['lng']; ?>&zoom=14&size=320x300&sensor=FALSE" />
            </div>
            <div class="acf-map acf-map--tablet">
              <div class="marker" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>"></div>
            </div>
            <?php } ?>
        <?php endwhile; ?>


</div>
