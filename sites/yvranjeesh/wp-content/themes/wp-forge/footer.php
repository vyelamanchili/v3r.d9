<?php
/**
 * The template for displaying the footer.
 * @version 6.3.1.2
 */
?>
	</section><!-- end .content-wrap -->
    </div><!-- end .content_container -->
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>
    <div class="footer_container">
    	<footer id="footer" class="footer_wrap row" role="contentinfo">
            <?php get_template_part( 'content', 'footer' ); ?>
        	<?php get_template_part( 'content', 'social_menu' ); ?>
    	</footer><!-- .row -->
    </div><!-- end #footer_container -->
<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes' || get_theme_mod( 'wpforge_nav_select' ) == 'offcanvas') { ?>
        </div><!-- end off-canvas-content -->
</div><!-- end off-canvas-wrapper -->
<?php } // end if ?>
    <div id="backtotop" class="hvr-fade">
        <span class="genericon genericon-collapse"></span>
    </div><!-- #backtotop -->
<?php wp_footer(); ?>
</body>
</html>
