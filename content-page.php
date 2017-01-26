<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
	<?php the_title('<h1 id="post-title">', '</h1>'); ?>
	<?php the_post_thumbnail('featured'); ?>
	<?php the_content(); ?>	
</article>