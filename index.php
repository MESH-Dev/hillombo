<?php get_header();
/* Template Name: Blog Archive Template*/
?>

<main id="content">
	<?php
		$bg_img = get_field('blog_welcome_bg', 'option');
		$bg_url = $bg_img['sizes']['background-fullscreen'];
		$blog_title = get_field('blog_title', 'option');
		$archive_title = get_field('archive_title', 'option');
		$breadcrumbs_blog = get_field('breadcrumb_switch_blog', 'option');

		$primary_color = get_field('primary_color', 'option');
		$secondary_color = get_field('secondary_color', 'option');
		$tertiary_color = get_field('tertiary_color', 'options');

	if (!empty($bg_url)) { ?>
		<div class="welcome-gate short" id="top">
			<div class="hero" style="background-image:url('<?php echo $bg_url ?>')"></div>
			<div class="img-filter" style="background-color:<?php echo $primary_color ?>;"></div>
	<?php } else{ ?>
		<div class="welcome-gate short" id="top" style="background:<?php echo $primary_color ?>;">
	<?php }; ?>
		<div class="container">
			<div class="row">
				<div class="sign sf">
					<h1 id="welcomeTitle" class="pf">

						<?php if ( is_day() ) : ?>
							<?php printf( __( 'Daily News Articles: <span>%s</span>' ), get_the_date() ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( __( 'Monthly News Articles: <span>%s</span>' ), get_the_date('F Y') ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( __( 'Yearly News Articles: <span>%s</span>' ), get_the_date('Y') ); ?>
						<?php else : ?>
							<?php echo $blog_title; ?>
						<?php endif; ?>

					</h1>
				</div>
			</div>
		</div>
	</div>
	<div class="panel listing wysiwyg" <?php
	if (!$breadcrumbs_blog) { ?>
		style="padding-top:76px;"
	<?php }
	 ?>>
		<div class="container">
			<div class="row posts">
				<div class="columns-9">

					<?php if ( have_posts() ) : ?>
						<?php if ($breadcrumbs_blog): ?>
							<p class="breadcrumbs"><?php echo the_breadcrumb(); ?></p>
						<?php endif; ?>

						<?php

							$args = array(
								'post_type' => 'post',
								'posts_per_page' => 5,
								);

							$query = new WP_Query($args);
							while ( $query->have_posts() ) : $query->the_post(); ?>

							<div class="post">
								<h2 class='post-title'><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<p class="info">By <?php the_author(); ?> | <?php echo the_date(); ?> | <?php the_category(', '); ?></p>
								<?php the_excerpt(); ?>
								<?php echo get_the_tag_list('<p class="tags">Tags: ',', ','</p>');?>
							</div>

						<?php endwhile; ?>

					<?php endif; ?>
					<div class="paginated">
						<?php
						global $wp_query;

						$big = 999999999; // need an unlikely integer

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages
						) );
						?>
					</div>
				</div><!-- end columns 9 -->
				<div <?php if (!$breadcrumbs_blog) : ?>
					class="columns-3 no-bc"
				<?php else :?>
					class="columns-3"
				<?php endif; ?>>
					<?php get_sidebar(); ?>
				</div>
			</div>

		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
