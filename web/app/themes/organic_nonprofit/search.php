<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">
	
	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .eight columns -->
		<div class="eight columns">
			
			<!-- BEGIN .post class -->
			<div <?php post_class('postarea padded'); ?> id="post-<?php the_ID(); ?>">
	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	            <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
	            
	            	<!-- BEGIN .archive-holder -->
	            	<div class="archive-holder">
		
			            <h2 class="headline"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
			            <div class="post-author">
			                <p class="align-left"><i class="fa fa-clock-o"></i> <?php _e("Posted on", 'organicthemes'); ?> <?php the_time(__("F j, Y", 'organicthemes')); ?></p> 
			                <p class="align-right"><i class="fa fa-comment"></i> <a href="<?php the_permalink(); ?>#comments"><?php comments_number(__("Leave a Comment", 'organicthemes'), __("1 Comment", 'organicthemes'), __("% Comments", 'organicthemes')); ?></a></p>
			            </div>
			            
			            <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
			                <div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
			            <?php } else { ?>
			            	<?php if ( has_post_thumbnail()) { ?>
			                	<a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-img' ); ?></a>
			                <?php } ?>
			            <?php } ?>
			
			            <!-- BEGIN .article -->
			            <div class="article">
			            	<?php the_excerpt(); ?>
			            <!-- END .article -->
			            </div>
			
						<div class="post-meta">
							<p><i class="fa fa-reorder"></i> &nbsp;<?php _e("Category:", 'organicthemes'); ?> <?php the_category(', ') ?> &nbsp; &nbsp; <i class="fa fa-tags"></i> &nbsp;<?php _e("Tags:", 'organicthemes'); ?> <?php the_tags('') ?></p>
						</div>
					
					<!-- END .archive-holder -->
					</div>
	
				<?php endwhile; else: ?> 
				    
				    <!-- BEGIN .postarea padded -->
				    <div class="postarea padded">
				    
			            <h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
			            <p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
			        
			        <!-- END .postarea padded -->
		            </div>
	            
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