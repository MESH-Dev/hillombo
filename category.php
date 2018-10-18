<?php get_header(); ?>

<main id="content">
	<?php
	$bg_img = get_field('blog_welcome_bg', 'option');
	$bg_url = $bg_img['sizes']['background-fullscreen'];
	$breadcrumbs_blog = get_field('breadcrumb_switch_blog', 'option');

	$primary_color = get_field('primary_color', 'option');
	$secondary_color = get_field('secondary_color', 'option');
	$tertiary_color = get_field('tertiary_color', 'option');
	the_field('statement', 'option');

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
					<h1 id="welcomeTitle" class="pf">Browsing posts in <?php single_cat_title(); ?></h1>
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
				<div class="columns-9"><!-- columns-9 -->

					<?php if ( have_posts() ) : ?>


						<?php if ($breadcrumbs_blog): ?>
							<p class="breadcrumbs"><?php echo the_breadcrumb(); ?></p>
						<?php endif; ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<div class="post">
								<h2 class="post-title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>
								<p class="info">By <?php the_author(); ?> | <?php echo the_date(); ?> | <?php the_category(', '); ?></p>
								<?php the_excerpt(); ?>
							</div>

						<?php endwhile; ?>

					<?php endif; ?>

				</div>
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
