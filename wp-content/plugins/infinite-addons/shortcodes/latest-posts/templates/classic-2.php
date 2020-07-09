<div class="row">

	<?php while( have_posts() ): the_post(); ?>

		<div class="col-md-4">
	
			<div class="latest-posts latest-classic">
			
				<figure>
				<?php

					if( has_post_thumbnail() ) {
						rella_the_post_thumbnail( 'rella-small-blog' );

					} else{

						echo '<div class="latest-post-thumbnail-placeholder"></div>';

					}

						$category      = get_the_category();
						$firstCategory = $category[0]->cat_name;
						$category_id   = $category[0]->term_id;
						if ( ! empty( $firstCategory ) ) {

					?>
					<div class="latest-post-categories">
						<a href="<?php echo get_category_link( $category[0]->term_id ); ?>"><?php echo $firstCategory; ?></a>
					</div>	
					<?php } ?>
				</figure>
			
				<div class="latest-content">
			
					<header>
						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
					</header>
			
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
			
				</div> <!-- /.latest-content -->
			
				<a href="<?php the_permalink() ?>" class="overlay-link"></a>
			
			</div>
	
		</div><!-- /.col-md-4 -->

	<?php endwhile; ?>

</div>