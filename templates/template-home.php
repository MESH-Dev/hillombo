<?php /* Template Name: Home Page */ ?>
<?php get_header(); ?>

<main id="content">
	<?php
	$bg_img = get_field('background_image');
	$bg_url = $bg_img['url'];
	$bg_filter = get_field('bg_img_filter');

	$primary_color = get_field('primary_color', 'option');
		$secondary_color = get_field('secondary_color', 'option');
		$tertiary_color = get_field('tertiary_color', 'options');

	if (!empty($bg_url)) { ?>
		<div class="welcome-gate" id="top">
			<div class="hero" style="
			<?php if ($bg_filter == false): echo 'filter:none;'; endif; ?>
			background-image:url('<?php echo $bg_url ?>');"></div>
			<div class="img-filter" <?php if ($bg_filter): ?> style="background-color:<?php echo $primary_color ?>;"<?php endif; ?>></div>
	<?php } else{ ?>
		<div class="welcome-gate" id="top" style="background:<?php echo $primary_color ?>;">
	<?php }; ?>
		<div class="container">
			<div class="row">
				<div class="sign sf">
					<h1 id="welcomeTitle" class="pf"><?php the_field('statement'); ?></h1>
					<p id="welcomeDesc" class="sf"><?php the_field('main_blurb'); ?></p>
				</div>
			</div>
		</div>
		<a id="scrollLink">
			<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 81 31">
			    <g>
			      <path d="M3,1.31l37.3,27.88L77.6,1.31" style="fill: none;stroke: #fff;stroke-width: 3px"/>
			    </g>
			</svg>
		</a>
	</div>
	<?php
	if(have_rows('panels')):
		while(have_rows('panels')) : the_row();
		$panel_type = get_sub_field('panel_type');
	?>
				<?php
				if ($panel_type == 'intro') { ?>
					<div class="panel <?php the_sub_field('panel_type'); ?>" id="<?php the_sub_field('panel_id'); ?>">
						<div class="container">
							<div class="row">
								<div class="columns-5">
									<h2 class="blurb pf" style="color:<?php echo $primary_color ?>"><?php the_sub_field('main_blurb'); ?></h2>
								</div>
								<div class="columns-6 offset-by-1">
									<div class="intro-desc sf"><?php the_sub_field('intro_text'); ?></div>
									<?php
									$cta_link = get_sub_field('cta_link');
									$cta_link_external = get_sub_field('cta_link_external');
									$cta_title = get_sub_field('cta_title');
									if(!empty($cta_title)){ ?>
										<a href="<?php echo $cta_link ?>"<?php if ($cta_link_external) {echo 'target="_blank"';} ?>><p class="cta pf"><?php echo $cta_title ?></p></a>
									<?php };
									?>
								</div>
							</div>
						</div>
					</div>
				<?php
			} elseif($panel_type == 'cards'){
				$panel_bg = get_sub_field('panel_background_image');
				$panel_bg_url = $panel_bg['sizes']['background-fullscreen'];
				if (!empty($panel_bg_url)) { ?>
					<div class="panel <?php the_sub_field('panel_type'); ?>" id="<?php the_sub_field('panel_id'); ?>">
						<div class="hero" style="background-image:url('<?php echo $panel_bg_url ?>')"></div>
						<div class="img-filter" style="background-color:<?php echo $primary_color ?>"></div>
				<?php } else{ ?>
					<div class="panel <?php the_sub_field('panel_type'); ?>" id="<?php the_sub_field('panel_id'); ?>" style="background-color:<?php echo $primary_color ?>;">
				<?php }; ?>
					<div class="container">
						<div class="row">
							<?php
							$cards = get_sub_field('cards');
							$card_num = count($cards);
							$width_class = '';
							if ($card_num == 1) {
								$width_class = 'columns-12';
							} elseif ($card_num == 2) {
								$width_class = 'columns-6';
							} elseif ($card_num == 3) {
								$width_class = 'columns-4';
							} elseif ($card_num == 4) {
								$width_class = 'columns-3';
							}
							if(have_rows('cards')): while(have_rows('cards')): the_row();
							?>
								<div class="card <?php echo $width_class ?>">
									<?php
									$card_img = get_sub_field('card_image');
									$card_img_url = $card_img['sizes']['medium_large'];
									$card_link = get_sub_field('card_link');
									?>
									<a <?php if(!empty($card_link)){ ?> href="<?php echo $card_link ?>" <?php }; ?>>
										<img src="<?php echo $card_img_url ?>" alt="">
										<div class="text">
											<h3 class="pf"><?php the_sub_field('card_title'); ?></h3>
											<p class="sf"><?php the_sub_field('card_blurb'); ?></p>
										</div>
									</a>
								</div>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			<?php	} elseif ($panel_type == 'wysiwyg') { ?>
				<div class="panel wysiwyg" id="<?php the_sub_field('panel_id'); ?>">
					<div class="container">
						<div class="row">
							<?php
							$columns = get_sub_field('text_panel');
							$col_count = count($columns);
							$col_class = '';
							if($col_count == 1){
								$col_class = 'columns-12';
							} elseif($col_count == 2){
								$col_class = 'columns-6';
							};
							if(have_rows('text_panel')): while(have_rows('text_panel')) : the_row();
								?>
								<div class="<?php echo $col_class ?> content-col">
									<?php the_sub_field('content_column'); ?>
								</div>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			<?php }; ?>
	<?php endwhile; endif; ?>

</main><!-- End of Content -->

<?php get_footer(); ?>
