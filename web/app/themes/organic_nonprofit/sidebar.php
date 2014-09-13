<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('right-sidebar') ) : ?>
    	
<div class="widget">
    <h6><?php _e("Widget Area", 'organicthemes'); ?></h6>
    <p><?php _e("This section is widgetized. To add widgets here, go to the", 'organicthemes'); ?> <a href="<?php echo admin_url(); ?>widgets.php"><?php _e("Widgets", 'organicthemes'); ?></a> <?php _e("panel in your WordPress admin, and add the widgets you would like to the", 'organicthemes'); ?> <strong><?php _e("Right Sidebar", 'organicthemes'); ?></strong>.</p>
    <p><small><?php _e("*This message will be overwritten after widgets have been added.", 'organicthemes'); ?></small></p>
</div>
	
<?php endif; ?>