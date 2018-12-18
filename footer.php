<footer>	
	<div id="footer-top">
		<?php wp_nav_menu(array('theme_location' => 'footer','depth' => 1,'container' => false,'fallback_cb' => false)); ?>
		<?php get_search_form(); ?>
	</div>
	<div id="footer-bottom">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<p><span><?php _e('Copyright &copy; 2014', 'finch'); ?></span> &bull; <a id="footer-site" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a> &bull; <a href="http://www.wpmultiverse.com/themes/finch/" title="Finch WordPress Theme">Finch Theme</a></p>				
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>   
</body>
</html>