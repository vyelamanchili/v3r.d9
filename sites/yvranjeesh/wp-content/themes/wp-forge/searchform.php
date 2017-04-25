<?php
/**
 * The template for displaying the search form.
 * @version 6.3.1.2
 */
?>
<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse">
		<div class="small-12 large-9 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'wp-forge'); ?>">
		</div><!-- end columns -->
		<div class="small-12 large-3 columns">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'wp-forge'); ?>" class="button">
		</div><!-- end columns -->
	</div><!-- end .row -->
</form>
