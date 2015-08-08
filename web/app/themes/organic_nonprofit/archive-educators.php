<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">
	
	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .eight columns -->
		<div class="twelve columns">

			<!-- BEGIN .post class -->
			<div <?php post_class('postarea padded'); ?> id="post-<?php the_ID(); ?>">
	
			<h1 class="headline">Educators</h1>
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	            <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	            
	            	<!-- BEGIN .archive-holder -->
	            	<div class="archive-holder row"> 
	            	
	            		<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
			                <div class="feature-vid four columns"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
			            <?php } else { ?>
			            	<?php if ( has_post_thumbnail()) { ?>
			                	<a class="feature-img four columns" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-img' ); ?></a>
			                <?php } ?>
			            <?php } ?>		           
						
						<!-- BEGIN .article -->
						<div class="article">
			            	<h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>            
			            	<?php the_excerpt(); ?>
			            <!-- END .article -->
			            </div>
					
					<!-- END .archive-holder -->
					</div>
	
				<?php endwhile; else: ?> 
				          
		            <h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
		            <p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
	            
				<?php endif; ?>
	            
	            <div class="pagination">
	            	<?php echo get_pagination_links(); ?>
	            </div><!-- END .pagination -->
			
			<!-- END .post class -->
	        </div>
	    
	    <!-- END .eight columns -->  
	    </div>
	    
	    <div class="four columns">
	    	<div class="sidebar padded">
	    		<?php get_sidebar( 'right-sidebar' ); ?>
	    	</div>
	    </div>
	
	<!-- END .row -->
	</div>	

<!-- END .container -->
</div>

<?php get_footer(); ?>