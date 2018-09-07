<?php get_header();
$secondary_color = get_field('secondary_color', 'option');
?>

<div class="welcome-gate" id="top" style="background:<?php echo $secondary_color ?>;">
	<div class="container">
		<div class="row">
			<div class="sign">
				<h1>404: Page Not Found</h1>
				<p>Oops, it looks like you've navigated to a page that is not on this site. Please <a href="<?php echo esc_url( home_url( '/' ) ); ?>">click here to navigate back to the home page.</a></p>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>
