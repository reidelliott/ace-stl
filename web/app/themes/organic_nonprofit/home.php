<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container home">

	<!-- BEGIN .row -->
	<div class="row">
	
		<!-- BEGIN .twelve columns -->
		<div class="twelve columns">
	
			<!-- BEGIN #slideshow -->
			<div id="slideshow">
			
				<!-- BEGIN .flexslider -->
				<div class="flexslider loading" data-speed="<?php echo of_get_option('transition_interval'); ?>">
					<!-- BEGIN .slides -->
					<ul class="slides">
						<?php $wp_query = new WP_Query(array('cat'=>of_get_option('category_slideshow_home'),'posts_per_page'=>of_get_option('postnumber_slideshow_home'))); ?>
						<?php if($wp_query->have_posts()) : while($wp_query->have_posts()) : $wp_query->the_post(); ?>
						<?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
						<?php global $more; $more = 0; ?>
						
						<li>
							<?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
							    <div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
							<?php } else { ?>
							    <?php if ( has_post_thumbnail()) { ?>
								    <a class="feature-img" href="<?php the_permalink(); ?>" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><?php the_post_thumbnail( 'featured-large' ); ?></a>
							    <?php } else { ?>
							    	<a class="feature-img" href="/classes" rel="bookmark" title="<?php esc_attr(the_title_attribute()); ?>"><img src="<?php bloginfo('template_directory'); ?>/images/logo.jpg" alt="<?php the_title(); ?>" /></a>
							    <?php } ?>
							<?php } ?>
							<div class="holder">
								<div class="information">
									<h2 class="headline"><a href="/classes" rel="bookmark">Expecting or Soon to be Expecting?</a></h2>
						            <h3 class="headline"><a href="/classes" rel="bookmark">Find a Class here!</a></h3>
					            </div>
					            <span class="background"></span>
							</div>
						</li>
						
						<?php endwhile; ?>
						<?php endif; ?>
					<!-- END .slides -->
					</ul>
				<!-- END .flexslider -->
				</div>
			
			<!-- END #slideshow -->
			</div>
	    
	    <!-- END .twelve columns -->
	    </div>
	
	<!-- END .row -->
	</div>
	<div class="row">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
	
	<?php if(of_get_option('display_home_mid') == '1') { ?>
	<?php if ( 'false' != of_get_option( 'mid_page_left' ) && 'false' != of_get_option( 'mid_page_mid' ) && 'false' != of_get_option( 'mid_page_right' ) ) { ?> 
	

	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .featured-pages -->
	    <div class="featured-pages"> 
	    
	    	<div class="holder first one-third">
				<?php $recent = new WP_Query('page_id='.of_get_option('mid_page_left')); while($recent->have_posts()) : $recent->the_post();?>
		            <?php get_template_part( 'content', 'home' ); ?>
	            <?php endwhile; ?>
			</div>
	
	        <div class="holder one-third">
				<?php $recent = new WP_Query('page_id='.of_get_option('mid_page_mid')); while($recent->have_posts()) : $recent->the_post();?>
	            	<?php get_template_part( 'content', 'home' ); ?>
	            <?php endwhile; ?>
			</div>
	
	        <div class="holder last one-third">
				<?php $recent = new WP_Query('page_id='.of_get_option('mid_page_right')); while($recent->have_posts()) : $recent->the_post();?>
		            <?php get_template_part( 'content', 'home' ); ?>
	            <?php endwhile; ?>
			</div>
	    
	    <!-- END .featured-pages -->
	    </div>
	
	<!-- END .row -->    
	</div>
	
	<?php } ?>
	<?php } ?>
	
	<?php if (of_get_option('display_home_bot') == '1') { ?>
	<?php if ( 'false' != of_get_option( 'bottom_page' ) || '-1' != of_get_option( 'category_tabs' ) ) { ?>
	
	<!-- BEGIN .row -->
	<div class="row">
		
		<!-- BEGIN .home-bottom -->
	    <div class="home-bottom"> 
	    
	    	<!-- BEGIN .six columns -->
	    	<div class="six columns">
	    
		        <div class="holder">
					<?php $recent = new WP_Query('page_id='.of_get_option('bottom_page')); while($recent->have_posts()) : $recent->the_post(); ?>
					
		                <h3 class="headline"><?php the_title(); ?></h3>		
		                <?php the_content(__("Meh!", 'organicthemes')); ?>
		                
		            <?php endwhile; ?>
		        </div>
	        
	        <!-- END .six columns -->
	        </div>
	        
	        <!-- BEGIN .six columns -->
	        <div class="six columns">
	    		
	    		<!-- BEGIN .organic-tabs -->
		        <div class="organic-tabs">
		        
		        	<?php $tabs = new WP_Query(array('cat'=>of_get_option('category_tabs'), 'posts_per_page'=>of_get_option('postnumber_tabs'))); ?>
		            
		            <ul id="tabs">
		            
						<?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>
								
						<?php $trimtitle = get_the_title(); ?>
						<?php $shorttitle = wp_trim_words( $trimtitle, $num_words = 3, $more = __('...', 'organicthemes') ); ?>
						
						<li><a href="<?php echo esc_url( '#tabs-' . $count ); ?>"><?php echo esc_html( $shorttitle ); ?></a></li>
				
						<?php $count++; ?>
						<?php endwhile; ?>
						
		            </ul>
		            
		            <?php endif; ?>
		            <?php wp_reset_postdata(); ?>
		            
		            <?php if ($tabs->have_posts()) : $count = 1; while ($tabs->have_posts()) : $tabs->the_post(); ?>
		            <?php if (isset($_POST['featurevid'])){ $custom = get_post_custom($post->ID); $featurevid = $custom['featurevid'][0]; } ?>
		            
		            <div id="tabs-<?php echo $count; ?>">
		            
	                    <?php if ( get_post_meta($post->ID, 'featurevid', true) ) { ?>
	                        <div class="feature-vid"><?php echo get_post_meta($post->ID, 'featurevid', true); ?></div>
	                    <?php } else { ?>
	                    	<?php if ( has_post_thumbnail()) { ?>
	                        	<a class="feature-img" href="<?php the_permalink() ?>" rel="bookmark"><?php the_post_thumbnail( 'featured-medium' ); ?></a>
	                        <?php } ?>
	                    <?php } ?>
	                    
	                    <div class="information">
	                        <h3 class="title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
	                        <?php the_excerpt(); ?>
	                    </div>
	                    
	                    <a class="organic-btn white-btn" href="<?php the_permalink(); ?>" rel="bookmark"><span class="btn-holder"><?php _e("Learn More", 'organicthemes'); ?></span></a>
	                    
		             </div>
		            
		            <?php $count++; ?>
		            <?php endwhile; endif; ?>
		        
		        <!-- END .organic-tabs -->
		        </div>     
	        
	        <!-- END .six columns -->
	        </div>
		
		<!-- END .home-bottom -->
	    </div>
	
	<!-- END .row -->
	</div>
	
	<?php } ?>
	<?php } ?>

<!-- END .container -->
</div>

<?php get_footer(); ?>