<?php get_header(); ?>

<main id="content">
	<?php
	$bg_img = get_field('background_image');
	$bg_url = $bg_img['sizes']['background-fullscreen'];
	$breadcrumbs = get_field('breadcrumb_switch');
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
					<h1 id="welcomeTitle" class="pf"><?php the_title(); ?></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="panel page wysiwyg" <?php
	if (!$breadcrumbs) { ?>
		style="padding-top:76px;"
	<?php }
	 ?>>
		<div class="container">
			<div class="row">
				<?php
				if ($breadcrumbs) {?>
				<p class="breadcrumbs">
					<?php echo the_breadcrumb(); ?>
				</p>
			<?php }
			?>
				<?php $callout = get_field('page_callout');

				if($callout != ''){ ?>
				<div class="columns-12 page-callout">
					<h3 class="pf"><?php echo $callout; ?></h3>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="container">
			<div class="columns-10"><!-- columns-9 -->
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

					<?php $the_terms = wp_get_post_terms($post->ID, 'category');
						//var_dump()
						$separator=", ";
						$cat = '';
						foreach($the_terms as $cats){
							$cat .= $cats->name.$separator;
						}
						$image = get_the_post_thumbnail('large');
						//return $image;
					?>
					<h1><?php the_title(); ?></h1>

					<p class="info">By: <?php the_author(); ?> | <?php echo the_date(); ?> | <?php the_category(', '); ?> </p>

					<?php the_content(); ?>

					<?php

					$tags = wp_get_post_tags($post->ID);
					//ar_dump($tags);
					$post_tags = '';
					foreach($tags as $tag){
						$post_tags .= $tag->name.$separator;
					}

					 ?>

					<?php echo get_the_tag_list('<p class="tags">Tags: ',', ','</p>');?>
					</p>
				<?php endwhile; ?>

			</div>
		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
