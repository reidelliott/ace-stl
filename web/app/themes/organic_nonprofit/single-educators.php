<?php
/*
Template Name: Educators

*/
?>

<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">
	
	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .eight columns -->
		<div class="twelve columns">
			<!-- BEGIN .postarea -->
			<div <?php post_class('postarea blog-page'); ?> id="page-<?php the_ID(); ?>">
		        
		        <?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
		        <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
		        <?php global $more; $more = 0; ?>
		        
		        <!-- BEGIN .blog-holder -->
		        <div class="blog-holder row">
		            
		            <?php if(of_get_option('display_feature_blog') == '1') { ?>
		                <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
		                    <div class="feature-vid four columns"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
		                <?php } else { ?>
		                    <?php if ( has_post_thumbnail()) { ?>
		                    	<div class="feature-img four columns"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-img' ); ?></a>
		            	</div>
		                    <?php } ?>
		                <?php } ?>
		            <?php } ?>
			            <!-- BEGIN .article -->
		            <div class="article seven columns">
		        	
			            <h2 class="headline"><?php the_title(); ?></h2>
		            	<a href="<?php the_field('link'); ?>" target="_blank" title="<?php the_title(); ?>">View Website</a>
		            	<?php the_content($post->ID); ?>
		            <!-- END .article -->
		            </div>
		            
		            <?php if(of_get_option('display_social_blog') == '1') { ?>
		            <div class="social">
		            	<div class="like-btn">
		            	  	<div class="fb-like" href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="100" data-show-faces="false"></div>
		            	</div>
		            	<div class="tweet-btn">
		            		<a href="http://twitter.com/share" class="twitter-share-button"
		            		data-url="<?php the_permalink(); ?>"
		            		data-via="<?php echo of_get_option('twitter_user'); ?>"
		            		data-text="<?php the_title(); ?>"
		            		data-related=""
		            		data-count="horizontal"><?php _e("Tweet", 'organicthemes'); ?></a>
		            	</div>
		            	<div class="plus-btn">
		            		<g:plusone size="medium" annotation="bubble" href="<?php the_permalink(); ?>"></g:plusone>
		            	</div>
		            </div>
		            <?php } ?>
		        
		        <!-- END .blog-holder -->
		        </div>
		        
		        <?php endwhile; ?>
		        
		        <div class="pagination">
		        	<?php echo get_pagination_links(); ?>
		        </div>
		        
		        <?php else : // do not delete ?>
		                
		        <div class="error-404">
		            <h1 class="headline"><?php _e("No Posts Found", 'organicthemes'); ?></h1>
		            <p><?php _e("We're sorry, but no posts have been found. Create a post to be added to this section, and configure your theme options.", 'organicthemes'); ?></p>
		        </div>
		        
		        <?php endif; // do not delete ?>
		    
		    <!-- END .postarea -->   
	        </div>
		
		<!-- END .eight columns -->
		</div>
	
	<!-- END .row -->
	</div>
	
<!-- END .container -->	
</div>

<?php get_footer(); ?>