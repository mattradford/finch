<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>			
	<?php 
		if (is_single()) :
			the_title('<h1 id="post-title">', '</h1>');					
		else :
			the_title('<h3 class="post-title"><a href="' . esc_url( get_permalink()) . '" rel="bookmark">', '</a></h3>');			
		endif;
		the_post_thumbnail('featured');	 
	?>		
	<p class="post-meta">
		<?php if (is_sticky()) : ?> 
			<span class="sticky"><?php _e('Sticky Post', 'finch'); ?> - </span>
		<?php endif; ?>
		<?php the_time(get_option('date_format')); ?> / <?php the_author(); ?> / <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?>
	</p>
	<?php					
		if ($post->post_excerpt) :
			the_excerpt(); 	        	
		else : 
			the_content(); 
		endif;
		if (is_single()) :
			$post_tags = get_the_tags();
			if ($post_tags) :
				echo '<hr class="hr">';
				echo '<p class="post-tags">';
				    foreach($post_tags as $tag) {
				    	echo '<span>#</span><a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name.'</a>'; 
				  	}
			  	echo '</p>';					  	
			endif;
		endif; 		
	?>
	<?php wp_link_pages(); ?>
</article>