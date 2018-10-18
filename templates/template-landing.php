<?php /* Template Name: Landing Page */ ?>
<?php get_header(); ?>

<main id="content">
	<?php
	$bg_img = get_field('background_image');
	$bg_url = $bg_img['url'];
	$bg_filter = get_field('bg_img_filter');
	$breadcrumbs = get_field('breadcrumb_switch');

	$primary_color = get_field('primary_color', 'option');
		$secondary_color = get_field('secondary_color', 'option');
		$tertiary_color = get_field('tertiary_color', 'options');

		$welcome_color_switch = get_field('welcome_gate_custom_color_on_or_off');
		$welcome_color = get_field('welcome_gate_custom_color');

	if (!empty($bg_url)) { ?>
		<div class="welcome-gate short" id="top">
			<div class="hero" style="
			<?php if ($bg_filter == false): echo 'filter:none;'; endif; ?>
			background-image:url('<?php echo $bg_url ?>');"></div>
			<div class="img-filter" <?php if ($bg_filter): ?> style="background-color:<?php if($welcome_color_switch){echo $welcome_color;}else{echo $primary_color;};?>;"<?php endif; ?>></div>
	<?php } else{ ?>
		<div class="welcome-gate short" id="top" style="background:<?php if($welcome_color_switch){echo $welcome_color;}else{echo $primary_color;};?>;">
	<?php }; ?>
		<div class="container">
			<div class="row">
				<div class="sign sf">
					<h1 id="welcomeTitle" class="pf"><?php the_field('statement'); ?></h1>
				</div>
			</div>
		</div>
		<!-- <a id="scrollLink">
			<svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 81 31">
			    <g>
			      <path d="M3,1.31l37.3,27.88L77.6,1.31" style="fill: none;stroke: #fff;stroke-width: 3px"/>
			    </g>
			</svg>
		</a> -->
	</div>
	<div class="panel listing" <?php
	if (!$breadcrumbs) { ?>
		style="padding-top:76px;"
	<?php }
	 ?>>
		<div class="container">
			<div class="row">
				<?php
				if ($breadcrumbs) {?>
					<p class="breadcrumbs">
						 <?php if( is_page() ) :
							 if( $ancs = array_reverse(get_ancestors($post->ID,'page')) ) {
								  foreach( $ancs as $anc ) {
									  $this_link = get_permalink($anc);
										?>
									  <a href="<?php echo $this_link; ?>" >
									  <?php
									  echo get_page( $anc )->post_title . '</a> > '; ?>
								  <?php
								  }
							 }
							 echo $post->post_title;
						endif; ?>
					</p>
				<?php }
				?>
				<?php
				$callout = get_field('page_callout');
				if (!empty($callout)):?>
					<div class="columns-12 page-callout">
						<h3 class="pf"><?php echo $callout; ?></h3>
					</div>
				<?php endif;
				?>
			</div>
		</div>
		<div class="container">
			<?php
			if( have_rows('item_card') ):
				$grid = get_field('item_layout');
				$width_class = '';
				if ($grid) {
					$cards = get_field('item_card');
					$card_num = count($cards);
					$card_cnt=0;
					// $width_class = 'columns-4';
					?>
					<div class="row listing grid">
						<?php while ( have_rows('item_card') ) : the_row();
						$card_cnt++;
						?>
						<div class="listing-card columns-4 listing-grid">
							<?php
							$thumbnail = get_sub_field('thumbnail');
							$thumbnail_url = $thumbnail['sizes']['large'];
							$item_title = get_sub_field('item_title');
							$item_desc = get_sub_field('item_description');
							$link_text = get_sub_field('link_text');
							$link_url = get_sub_field('link_url');
							if (!empty($thumbnail_url)) { ?>
								<div class="thumbnail" style="background-image: url('<?php echo $thumbnail_url; ?>');">
								</div>
							<?php }
							?>
							<div class="item-text">
								<h4 class="item-title pf"><?php echo $item_title; ?></h4>
								<?php
								if ($item_desc) { ?>
									<p class="item-exc sf"><?php echo $item_desc; ?></p>
								<?php }
								if ($link_text) { ?>
									<a class="read-more pf" href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
								<?php }
								?>
							</div>
						</div>
						<?php
						if ($card_cnt % 3 == 0) {
						  echo '</div><div class="row listing grid">';
					  } elseif($card_cnt == $card_num){?>
						  </div><!--end final row -->
					  <?php }
					  endwhile;
					} else{
					// $width_class = 'columns-12';
					while ( have_rows('item_card') ) : the_row();
					?>
					<div class="row listing">
						<div class="listing-card columns-12">
							<?php
							$thumbnail = get_sub_field('thumbnail');
							$thumbnail_url = $thumbnail['sizes']['large'];
							$item_title = get_sub_field('item_title');
							$item_desc = get_sub_field('item_description');
							$link_text = get_sub_field('link_text');
							$link_url = get_sub_field('link_url');
							?>
							<div class="thumbnail columns-5" style="background-image: url('<?php echo $thumbnail_url; ?>');">
							</div>
							<div class="item-text columns-7">
								<h4 class="item-title pf"><?php echo $item_title; ?></h4>
								<?php
								if ($item_desc) { ?>
									<p class="item-exc sf"><?php echo $item_desc; ?></p>
								<?php }
								if ($link_text) { ?>
									<a class="read-more pf" href="<?php echo $link_url; ?>"><?php echo $link_text; ?></a>
								<?php }
								?>
							</div>
						</div>
					</div>
					<?php endwhile;
				}
			endif;
				?>
		</div>
	</div>
</main><!-- End of Content -->

<?php get_footer(); ?>
