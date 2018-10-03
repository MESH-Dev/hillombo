<?php get_header(); ?>

<main id="content">
	<?php
	$bg_img = get_field('background_image');
	$bg_url = $bg_img['url'];
	$bg_filter = get_field('bg_img_filter');

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

	<div class="panel wysiwyg page">
		<div class="container">
			<div class="row">
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
				<div class="columns-12 page-callout">
					<?php
					$callout = get_field('page_callout');
					?>
					<h3 class="pf"><?php echo $callout; ?></h3>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<?php
				$columns = get_field('content_columns');
				$col_count = count($columns);
				$col_class = '';
				if($col_count == 1){
					$col_class = 'columns-12';
				} elseif($col_count == 2){
					$col_class = 'columns-6';
				};
				if(have_rows('content_columns')): while(have_rows('content_columns')) : the_row();
					?>
					<div class="<?php echo $col_class ?> content-col">
						<?php the_sub_field('column'); ?>
					</div>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>

</main><!-- End of Content -->

<?php get_footer(); ?>
