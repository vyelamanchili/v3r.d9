<?php
//about theme info
add_action( 'admin_menu', 'recipe_lite_abouttheme' );
function recipe_lite_abouttheme() {    	
	add_theme_page( esc_html__('About Theme', 'recipe-lite'), esc_html__('About Theme', 'recipe-lite'), 'edit_theme_options', 'recipe_lite_guide', 'recipe_lite_mostrar_guide');   
} 

//guidline for about theme
function recipe_lite_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
?>
<div class="wrapper-info">
	<div class="col-left">
   		   <div class="col-left-area">
			  <?php esc_attr_e('Theme Information', 'recipe-lite'); ?>
		   </div>
          <p><?php esc_html_e('SKT Recipe Lite WordPress theme can be used by chefs, recipe makers, recipe and food bloggers, caterers, restaurant and bistro owners, cafe and coffee shops as well as other food packaging owners to have a nice and decent website. Pizza delivery and online food ordering website can also use this template and make use of WooCommerce for online food delivery and booking orders. Translation ready and page builder friendly this recipe template is also compatible with multilingual plugins and recipe plugins. It is multipurpose template and comes with a ready to import Elementor template plugin as add on which allows to import 150+ design templates for making use in home and other inner pages. Use it to create any type of business, personal, blog and eCommerce website. It is fast, flexible, simple and fully customizable.','recipe-lite'); ?></p>
		  <a href="<?php echo esc_url(RECIPE_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/free-vs-pro.png" alt="" /></a>
	</div><!-- .col-left -->
	<div class="col-right">			
			<div class="centerbold">
				<hr />
				<a href="<?php echo esc_url(RECIPE_LITE_SKTTHEMES_LIVE_DEMO); ?>" target="_blank"><?php esc_html_e('Live Demo', 'recipe-lite'); ?></a> | 
				<a href="<?php echo esc_url(RECIPE_LITE_SKTTHEMES_PRO_THEME_URL); ?>"><?php esc_html_e('Buy Pro', 'recipe-lite'); ?></a> | 
				<a href="<?php echo esc_url(RECIPE_LITE_SKTTHEMES_THEME_DOC); ?>" target="_blank"><?php esc_html_e('Documentation', 'recipe-lite'); ?></a>
                <div class="space5"></div>
				<hr />                
                <a href="<?php echo esc_url(RECIPE_LITE_SKTTHEMES_THEMES); ?>" target="_blank"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/sktskill.jpg" alt="" /></a>
			</div>		
	</div><!-- .col-right -->
</div><!-- .wrapper-info -->
<?php } ?>