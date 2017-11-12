/* @version 6.4.3 */

( function( $ ) {

/* Start adding */

///////////////////////////////////
// Header Section
///////////////////////////////////

	// Site Title Font Size
	wp.customize('wpforge_site_title_font_size',function( value ) {
        value.bind(function(to) {
            $('.site-title').css('font-size', to ? to : '' );
        });
    });

	// Site Description Font Size
	wp.customize('wpforge_site_desc_font_size',function( value ) {
        value.bind(function(to) {
            $('.site-description').css('font-size', to ? to : '' );
        });
    });

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header Wrap Width
	wp.customize('header_width',function( value ) {
        value.bind(function(to) {
            $('.header_wrap').css('max-width', to ? to : '' );
        });
    });

	// Header Wrap Background Color
	wp.customize('header_color',function( value ) {
        value.bind(function(to) {
            $('.header_wrap').css('background-color', to ? to : '' );
        });
    });

    // Site Title Link Color
	wp.customize('site_title_link_color',function( value ) {
        value.bind(function(to) {
            $('.site-title a').css('color', to ? to : '' );
        });
    });

    // Site Description Color
	wp.customize('header_textcolor',function( value ) {
        value.bind(function(to) {
            $('h2.site-description').css('color', to ? to : '' );
        });
    });

	// Header Text Display
    wp.customize( 'wpforge_hide_sitetitle', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                $( 'body' ).addClass( 'no-site-title' ).removeClass('has-site-title');
            } else {
                $( 'body' ).removeClass( 'no-site-title' ).addClass('has-site-title');
            }
        } );
    } );

    wp.customize( 'wpforge_hide_tagline', function( value ) {
        value.bind( function( to ) {
            if ( to ) {
                $( 'body' ).addClass( 'no-site-tagline' ).removeClass('has-site-tagline');
            } else {
                $( 'body' ).removeClass( 'no-site-tagline' ).addClass('has-site-tagline');
            }
        } );
    } );

	// Nav Wrap Width
	wp.customize('nav_width',function( value ) {
        value.bind(function(to) {
            $('.nav_wrap').css('max-width', to ? to : '' );
        });
    });

///////////////////////////////////
// Top-Bar Menu
///////////////////////////////////

	// Top-Bar Home Link Text
	wp.customize('wpforge_nav_text', function(value) {
		value.bind(function(to) {
			$('.top-bar .top-bar-title').html(to);
		});
	});

	// Top-Bar Font Size
	wp.customize('wpforge_top_bar_font_size',function( value ) {
        value.bind(function(to) {
            $('.top-bar').css('font-size', to ? to : '' );
        });
    });

	// Top-Bar Main Color
	wp.customize('top_bar_main_color',function( value ) {
        value.bind(function(to) {
            $('.contain-to-grid .top-bar,.top-bar,.top-bar ul,.top-bar ul li,.contain-to-grid,.top-bar.title-bar,.title-bar').css('background-color', to ? to : '' );
        });
    });

	// Top-Bar Dropdown Arrow Position
	wp.customize('wpforge_top_bar_arrow_position',function( value ) {
        value.bind(function(to) {
            $('.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after').css('margin-top', to ? to : '' );
        });
    });
    
	// Top-Bar Link Background Hover Color
	wp.customize('top_bar_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.top-bar-right .menu > li.name:hover,.top-bar .menu > li:not(.menu-text) > a:hover,.top-bar .menu > .active:hover').css('background', to ? to : '' );
	    });
	});

	// Top-Bar Link Color
	wp.customize('top_bar_font_color',function( value ) {
	    value.bind(function(to) {
	    	$('.top-bar .menu-item a').css('color', to ? to : '' );
	    });
	});

	// Top-Bar Link Hover Color
	wp.customize('top_bar_font_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.top-bar .name a:hover,.top-bar ul li a:hover').css('color', to ? to : '' );
	    });
	});

	// Top-Bar Dropdown Arrow Color
	wp.customize('top_bar_dropdown_arrow_color',function( value ) {
	    value.bind(function(to) {
	        $('.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after,.is-drilldown-submenu-parent > a::after,.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after,.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after,.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after,.js-drilldown-back > a::before').css('border-top-color', to ? to : '' );
	    });
	});

	// Current Menu Item Background Color
	wp.customize('top_bar_active_color',function( value ) {
	    value.bind(function(to) {
	        $('.top-bar .menu .current-menu-parent, .top-bar .menu .current-page-parent, .top-bar .menu .current-page-ancestor, .top-bar .menu .current_page_item').css('background-color', to ? to : '' );
	    });
	});

	// Current Menu Item Link Color
	wp.customize('current_item_link_color',function( value ) {
	    value.bind(function(to) {
	        $('.top-bar .menu .current_page_item a').css('color', to ? to : '' );
	    });
	});

	// Current Menu Item Link Hover Color
	wp.customize('current_item_link_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.top-bar .menu .current_page_item a:hover').css('color', to ? to : '' );
	    });
	});

	// Mobile Off-Canvas Title Bar Size
	wp.customize('offcanvas_mobile_text_size',function( value ) {
        value.bind(function(to) {
            $('.off-canvas-content .mbl .title-bar-title').css('font-size', to ? to : '' );
        });
    });

	// Mobile Off-Canvas Link Size
	wp.customize('offcanvas_mobile_link_size',function( value ) {
        value.bind(function(to) {
            $('.off-canvas .menu-item a,.off-canvas-absolute .menu-item a').css('font-size', to ? to : '' );
        });
    });

///////////////////////////////////
// Off-Canvas Menu
///////////////////////////////////

// Off-Canvas Main Color
wp.customize('wpforge_off_canvas_main_color',function( value ) {
    value.bind(function(to) {
        $('.off-canvas,.off-canvas .is-drilldown-submenu,.off-canvas-absolute,.off-canvas-absolute .is-drilldown-submenu,.off-canvas-content .title-bar').css('background-color', to ? to : '' );
    });
});

	// Off-Canvas Hamburger Icon Text
	wp.customize('wpforge_off_canvas_text', function(value) {
		value.bind(function(to) {
			$('.off-canvas-content .title-bar-title').html(to);
		});
	});

	// Off-Canvas Link Color
	wp.customize('wpforge_off_canvas_link_color',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu-item a,.off-canvas-absolute .menu-item a{').css('color', to ? to : '' );
	    });
	});

	// Off-Canvas Link Hover Color
	wp.customize('wpforge_off_canvas_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu-item a:hover,.off-canvas-absolute .menu-item a:hover').css('color', to ? to : '' );
	    });
	});

	// Off-Canvas Dropdown Arrow Color
	wp.customize('wpforge_off_dropdown_arrow_color',function( value ) {
	    value.bind(function(to) {
	        $('.submenu-toggle::after').css('border-color', to ? to : '' );
	    });
	});

	// Off-Canvas Title Font Size
	wp.customize('wpforge_off_canvas_title_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas-content .title-bar-title').css('font-size', to ? to : '' );
	    });
	});

	// Off-Canvas Font Size
	wp.customize('wpforge_off_canvas_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu-item a,.off-canvas-absolute .menu-item a').css('font-size', to ? to : '' );
	    });
	});

	// Off-Canvas Active Color
	wp.customize('off_canvas_active_color',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu .menu-item-home,.off-canvas .menu .current-menu-parent,.off-canvas .menu .current-page-parent,.off-canvas .menu .current-page-ancestor,.off-canvas .menu .current_page_item,.off-canvas-absolute .menu .menu-item-home,.off-canvas-absolute .menu .menu-item-home,.off-canvas-absolute .menu .current-menu-parent,.off-canvas-absolute .menu .current-page-parent,.off-canvas-absolute .menu .current-page-ancestor,.off-canvas-absolute .menu .current_page_item').css('background-color', to ? to : '' );
	    });
	});

	// Off-Canvas Current Menu Item Link Color
	wp.customize('off_canvas_current_item_link_color',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu > .current_page_item > a,.off-canvas-absolute .menu > .current_page_item > a').css('color', to ? to : '' );
	    });
	});

	// Off-Canvas Current Menu Item Link Hover Color
	wp.customize('off_canvas_current_item_link_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.off-canvas .menu > .current_page_item > a:hover,.off-canvas-absolute .menu > .current_page_item > a:hover').css('color', to ? to : '' );
	    });
	});

///////////////////////////////////
// Content Position Options
///////////////////////////////////

	// Content Position
	wp.customize('wpforge_content_position',function( value ) {
	    value.bind(function(to) {
	        $('#content.columns').css('float', to ? to : '' );
	    });
	});

///////////////////////////////////
// Post Options
///////////////////////////////////

	// Category Font Size
	wp.customize('wpforge_category_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-categories').css('font-size', to ? to : '' );
	    });
	});

	// Post Meta Font Size
	wp.customize('wpforge_postmeta_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-header,span.edit-link a').css('font-size', to ? to : '' );
	    });
	});

	// Post Meta Genericon Font Size
	wp.customize('wpforge_postmeta_gen_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-header .genericon,.entry-meta-categories .genericon,span.edit-link .genericon').css('font-size', to ? to : '' );
	    });
	});

	// Post Title Font Size
	wp.customize('wpforge_post_title_font_size',function( value ) {
	    value.bind(function(to) {
	        $('h1.entry-title-post').css('font-size', to ? to : '' );
	    });
	});

	// Post Font Size
	wp.customize('wpforge_post_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-post p,.entry-content-post ul li,.entry-content-post ol li,.entry-content-post table,.comment-content table,.entry-content-post address,.comment-content address,.entry-content-post pre,.comment-content pre,.comments-area article header cite,.entry-content-post #comments,.entry-content-post dl,.entry-content-post dt').css('font-size', to ? to : '' );
	    });
	});

	// Category displayed above tag font size
	wp.customize('wpforge_category_tag_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-categories_bottom').css('font-size', to ? to : '' );
	    });
	});

	// Category displayed above tag  genericon font size
	wp.customize('wpforge_category_gen_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-categories_bottom .genericon').css('font-size', to ? to : '' );
	    });
	});

	// Post Tag Size
	wp.customize('wpforge_post_tag_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-tags').css('font-size', to ? to : '' );
	    });
	});

	// Tag Genericon Size
	wp.customize('wpforge_tag_gen_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-meta-tags .genericon').css('font-size', to ? to : '' );
	    });
	});

	// Post Link Decoration
	wp.customize('wpforge_post_link_decoration',function( value ) {
		value.bind(function(to) {
		    $('.entry-content-post a').css('text-decoration', to ? to : '' );
		});
	});

	// Post Link Hover Decoration
	wp.customize('wpforge_post_link_hover_decoration',function( value ) {
		value.bind(function(to) {
		    $('.entry-content-post a:hover').css('text-decoration', to ? to : '' );
		});
	});

	// Post Link Font Weight
	wp.customize('wpforge_post_link_weight',function( value ) {
		value.bind(function(to) {
		    $('.entry-content-post a').css('font-weight', to ? to : '' );
		});
	});

	// Post H1 Font Size
	wp.customize('wpforge_post_h1_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h1').css('font-size', to ? to : '' );
	  });
	});

	// Post H2 Font Size
	wp.customize('wpforge_post_h2_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h2').css('font-size', to ? to : '' );
	  });
	});

	// Post H3 Font Size
	wp.customize('wpforge_post_h3_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h3').css('font-size', to ? to : '' );
	  });
	});

	// Post H4 Font Size
	wp.customize('wpforge_post_h4_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h4').css('font-size', to ? to : '' );
	  });
	});

	// Post H5 Font Size
	wp.customize('wpforge_post_h5_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h5').css('font-size', to ? to : '' );
	  });
	});

	// Post H6 Font Size
	wp.customize('wpforge_post_h6_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-post h6').css('font-size', to ? to : '' );
	  });
	});

///////////////////////////////////
// Page Options
///////////////////////////////////

	// Page Title Font Size
	wp.customize('wpforge_page_title_font_size',function( value ) {
	    value.bind(function(to) {
	        $('h1.entry-title-page').css('font-size', to ? to : '' );
	    });
	});

	// Page Title Color
	wp.customize('wpforge_page_title_color',function( value ) {
	    value.bind(function(to) {
	        $('h1.entry-title-page').css('color', to ? to : '' );
	    });
	});

	// Page Content Font Size
	wp.customize('wpforge_page_content_font_size',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-page p,.entry-content-page ul li,.entry-content-page ol li,.entry-content-page table,.entry-content-page table th,.entry-content-page .comment-content table,.entry-content-page address,.entry-content-page .comment-content address,.entry-content-page pre,.entry-content-page .comment-content pre,.comments-area article header cite,.entry-content-page #comments,.entry-content-page dl,.entry-content-page dt').css('font-size', to ? to : '' );
	    });
	});

	// Page Content Font Color
	wp.customize('wpforge_page_text_color',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-page p,.entry-content-page ul li,.entry-content-page ol li,.entry-content-page table,.entry-content-page table th,.entry-content-page .comment-content table,.entry-content-page address,.entry-content-page .comment-content address,.entry-content-page pre,.entry-content-page .comment-content pre,.comments-area article header cite,.entry-content-page #comments,.entry-content-page dl,.entry-content-page dt').css('color', to ? to : '' );
	    });
	});

	// Page Link Color
	wp.customize('wpforge_page_link_color',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-page a').css('color', to ? to : '' );
	    });
	});

	// Page Link Hover Color
	wp.customize('wpforge_page_link_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-page a:hover').css('color', to ? to : '' );
	    });
	});

	// Page Link Decoration
	wp.customize('wpforge_page_link_decoration',function( value ) {
	    value.bind(function(to) {
	        $('.entry-content-page a').css('text-decoration', to ? to : '' );
	    });
	});

	// Page Link Hover Decoration
		wp.customize('wpforge_page_link_hover_decoration',function( value ) {
		value.bind(function(to) {
			$('.entry-content-page a:hover,.entry-content-page a:focus').css('text-decoration', to ? to : '' );
		});
	});

	// Page Link Font Weight
	wp.customize('wpforge_page_link_weight',function( value ) {
		value.bind(function(to) {
		    $('.entry-content-page a').css('font-weight', to ? to : '' );
		});
	});

	// Page H1 Font Size
	wp.customize('wpforge_page_h1_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h1').css('font-size', to ? to : '' );
	  });
	});

	// Page H2 Font Size
	wp.customize('wpforge_page_h2_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h2').css('font-size', to ? to : '' );
	  });
	});

	// Page H3 Font Size
	wp.customize('wpforge_page_h3_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h3').css('font-size', to ? to : '' );
	  });
	});

	// Page H4 Font Size
	wp.customize('wpforge_page_h4_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h4').css('font-size', to ? to : '' );
	  });
	});

	// Page H5 Font Size
	wp.customize('wpforge_page_h5_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h5').css('font-size', to ? to : '' );
	  });
	});

	// Page H6 Font Size
	wp.customize('wpforge_page_h6_size',function( value ) {
	  value.bind(function(to) {
	      $('.entry-content-page h6').css('font-size', to ? to : '' );
	  });
	});

///////////////////////////////////
//
///////////////////////////////////

	// Hook into background color/image change and adjust body class value as needed.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( ( '#ffffff' == to || '#fff' == to ) && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-white' );
			else if ( '' == to && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-empty' );
			else
				body.removeClass( 'custom-background-empty custom-background-white' );
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( '' != to )
				body.removeClass( 'custom-background-empty custom-background-white' );
			else if ( 'rgb(255, 255, 255)' == body.css( 'background-color' ) )
				body.addClass( 'custom-background-white' );
			else if ( 'rgb(230, 230, 230)' == body.css( 'background-color' ) && '' == _wpCustomizeSettings.values.background_color )
				body.addClass( 'custom-background-empty' );
		} );
	} );

	// Content Wrapper Width
	wp.customize('content_width',function( value ) {
        value.bind(function(to) {
            $('.content_wrap').css('max-width', to ? to : '' );
        });
    });

	// Content Background Color
	wp.customize('content_color',function( value ) {
        value.bind(function(to) {
            $('.content_wrap').css('background-color', to ? to : '' );
        });
    });

///////////////////////////////////
// Main Sidebar Options
///////////////////////////////////

	// Widget Title Font Size
	wp.customize('wpforge_sidebar_widget_title',function( value ) {
	  value.bind(function(to) {
	      $('#secondary .widget-title').css('font-size', to ? to : '' );
	  });
	});

  // Sidebar Widget Title Text Transform
  wp.customize('wpforge_sidebar_widget_title_transform',function( value ) {
    value.bind(function(to) {
        $('#secondary .widget-title').css('text-transform', to ? to : '' );
    });
  });

  // Sidebar Widget Title Weight
  wp.customize('wpforge_sidebar_widget_title_weight',function( value ) {
    value.bind(function(to) {
        $('#secondary .widget-title').css('font-weight', to ? to : '' );
    });
  });

  // Sidebar Font Size
  wp.customize('wpforge_sidebar_font_size',function( value ) {
    value.bind(function(to) {
        $('#secondary p,#secondary li').css('font-size', to ? to : '' );
    });
  });

  // Sidebar Link Decoration
  wp.customize('wpforge_sidebar_link_decoration',function( value ) {
    value.bind(function(to) {
        $('#secondary a').css('text-decoration', to ? to : '' );
    });
  });

  // Sidebar Link Hover Decoration
  wp.customize('wpforge_sidebar_link_hover_decoration',function( value ) {
    value.bind(function(to) {
        $('#secondary a:hover').css('text-decoration', to ? to : '' );
    });
  });

  // Sidebar Link Font Weight
  wp.customize('wpforge_sidebar_link_weight',function( value ) {
    value.bind(function(to) {
        $('#secondary a').css('font-weight', to ? to : '' );
    });
  });

///////////////////////////////////
// Footer Sidebar Options
///////////////////////////////////

// Footer Sidebar Width
wp.customize('footer_sidebar_width',function( value ) {
    value.bind(function(to) {
        $('#secondary-sidebar').css('max-width', to ? to : '' );
    });
});

// Footer Sidebar Content Background Color
wp.customize('footer_sidebar_color',function( value ) {
    value.bind(function(to) {
        $('#secondary-sidebar').css('background-color', to ? to : '' );
    });
});

// Footer Sidebar Widget Title Font Size
wp.customize('wpforge_footer_sidebar_widget_title',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar .widget-title').css('font-size', to ? to : '' );
	  });
});

// Footer Sidebar Widget Title Transform
wp.customize('wpforge_footer_sidebar_widget_title_transform',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar .widget-title').css('text-transform', to ? to : '' );
	  });
});

// Footer Sidebar Widget Title Weight
wp.customize('wpforge_footer_sidebar_widget_title_weight',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar .widget-title').css('font-weight', to ? to : '' );
	  });
});

// Footer Sidebar Font Size
wp.customize('wpforge_footer_sidebar_font_size',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar p,#secondary-sidebar li,#secondary-sidebar .widget.widget_text').css('font-size', to ? to : '' );
	  });
});

// Footer Sidebar Link Font Weight
wp.customize('wpforge_footer_sidebar_link_weight',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar a').css('font-weight', to ? to : '' );
	  });
});

// Footer Sidebar Link Decoration
wp.customize('wpforge_footer_sidebar_link_decoration',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar a').css('text-decoration', to ? to : '' );
	  });
});

// Footer Sidebar Link Hover Decoration
wp.customize('wpforge_footer_sidebar_link_hover_decoration',function( value ) {
	  value.bind(function(to) {
	      $('#secondary-sidebar a:hover').css('text-decoration', to ? to : '' );
	  });
});

///////////////////////////////////
// Footer Options
///////////////////////////////////

// Footer Content Width
wp.customize('footer_content_width',function( value ) {
    value.bind(function(to) {
        $('.footer[role="contentinfo"]').css('max-width', to ? to : '' );
    });
});

// Footer Content Background Color
wp.customize('footer_content_color',function( value ) {
    value.bind(function(to) {
        $('footer[role="contentinfo"]').css('background-color', to ? to : '' );
    });
});

// Footer Text
wp.customize('wpforge_footer_text', function(value) {
	value.bind(function(to) {
		$('.footer[role="contentinfo"]').html(to);
	});
});
wp.customize('textarea_settings', function(value) {
	value.bind(function(to) {
		$('.footer[role="contentinfo"]').html(to);
	});
});

// Footer Text Font Size
wp.customize('wpforge_footer_txt_size',function( value ) {
    value.bind(function(to) {
        $('.footer[role="contentinfo"] p, .footer[role="contentinfo"] a').css('font-size', to ? to : '' );
    });
});

///////////////////////////////////
// Color Options
///////////////////////////////////

// Category Link Color
wp.customize('category_link_color',function( value ) {
      value.bind(function(to) {
          $('span.categories-links a').css('color', to ? to : '' );
      });
  });

// Category Link Hover Color
wp.customize('category_link_hover_color',function( value ) {
    value.bind(function(to) {
        $('span.categories-links a:hover').css('color', to ? to : '' );
    });
});

// Post Title Link Color
wp.customize('post_title_link_color',function( value ) {
      value.bind(function(to) {
          $('h2.entry-title-post a').css('color', to ? to : '' );
      });
  });

// Post Title Link Hover Color
wp.customize('post_title_link_hover_color',function( value ) {
    value.bind(function(to) {
        $('h2.entry-title-post a:hover').css('color', to ? to : '' );
    });
});

// Single Post View Title Color
wp.customize('single_post_title_color',function( value ) {
    value.bind(function(to) {
        $('h1.entry-title-post').css('color', to ? to : '' );
    });
});

// Post Meta Link Color
wp.customize('meta_header_link_color',function( value ) {
      value.bind(function(to) {
          $('.entry-meta-header a').css('color', to ? to : '' );
      });
  });

// Post Meta Link Hover Color
wp.customize('meta_header_link_hover_color',function( value ) {
    value.bind(function(to) {
        $('.entry-meta-header a:hover').css('color', to ? to : '' );
    });
});

// Content Font Color
wp.customize('content_font_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post p,.entry-content-post ul li,.entry-content-post ol li,.entry-content-post table,.comment-content table,.entry-content-post address,.comment-content address,.entry-content-post pre,.comment-content pre,.comments-area article header cite,#comments,.entry-content-post dl,.entry-content-post dt').css('color', to ? to : '' );
    });
});

// Content Link Color
wp.customize('content_link_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post a').css('color', to ? to : '' );
    });
});

// Content Link Hover Color
wp.customize('content_hover_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post a:hover').css('color', to ? to : '' );
    });
});

// Tag Link Color
wp.customize('tag_link_color',function( value ) {
      value.bind(function(to) {
          $('span.tags-links a').css('color', to ? to : '' );
      });
  });

// Tag Link Hover Color
wp.customize('tag_link_hover_color',function( value ) {
    value.bind(function(to) {
        $('span.tags-links a:hover').css('color', to ? to : '' );
    });
});

// Post Content H1 Color
wp.customize('wpforge_content_h1_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h1').css('color', to ? to : '' );
    });
});

// Post Content H2 Color
wp.customize('wpforge_content_h2_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h2').css('color', to ? to : '' );
    });
});

// Post Content H3 Color
wp.customize('wpforge_content_h3_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h3').css('color', to ? to : '' );
    });
});

// Post Content H4 Color
wp.customize('wpforge_content_h4_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h4').css('color', to ? to : '' );
    });
});

// Post Content H5 Color
wp.customize('wpforge_content_h5_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h5').css('color', to ? to : '' );
    });
});

// Post Content H6 Color
wp.customize('wpforge_content_h6_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-post h6').css('color', to ? to : '' );
    });
});

// Page H1 Color
wp.customize('wpforge_page_h1_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h1').css('color', to ? to : '' );
    });
});

// Page H2 Color
wp.customize('wpforge_page_h2_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h2').css('color', to ? to : '' );
    });
});

// Page H3 Color
wp.customize('wpforge_page_h3_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h3').css('color', to ? to : '' );
    });
});

// Page H4 Color
wp.customize('wpforge_page_h4_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h4').css('color', to ? to : '' );
    });
});

// Page H5 Color
wp.customize('wpforge_page_h5_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h5').css('color', to ? to : '' );
    });
});

// Page H6 Color
wp.customize('wpforge_page_h6_color',function( value ) {
    value.bind(function(to) {
        $('.entry-content-page h6').css('color', to ? to : '' );
    });
});

// Widget Color
wp.customize('main_widget_title_color',function( value ) {
    value.bind(function(to) {
        $('#secondary .widget-title').css('color', to ? to : '' );
    });
});

// Widget Text Color
wp.customize('main_widget_text_color',function( value ) {
    value.bind(function(to) {
        $('#secondary p,#secondary li,#secondary .widget.widget_text').css('color', to ? to : '' );
    });
});

// Widget Links Color
wp.customize('main_widget_link_color',function( value ) {
    value.bind(function(to) {
        $('#secondary a').css('color', to ? to : '' );
    });
});

// Footer Sidebar Widget Title Color
wp.customize('footer_widget_title_color',function( value ) {
    value.bind(function(to) {
        $('#secondary-sidebar .widget-title').css('color', to ? to : '' );
    });
});

// Footer Sidebar Widget Text Color
wp.customize('footer_widget_text_color',function( value ) {
    value.bind(function(to) {
        $('#secondary-sidebar p,#secondary-sidebar li,#secondary-sidebar .widget.widget_text').css('color', to ? to : '' );
    });
});

// Footer Sidebar Widget Links Color
wp.customize('footer_widget_link_color',function( value ) {
    value.bind(function(to) {
        $('#secondary-sidebar a').css('color', to ? to : '' );
    });
});
// Footer Text Color
wp.customize('footer_text_color',function( value ) {
    value.bind(function(to) {
        $('footer[role="contentinfo"] p,footer[role="contentinfo"]').css('color', to ? to : '' );
    });
});
// Footer Link Color
wp.customize('footer_link_color',function( value ) {
    value.bind(function(to) {
        $('footer[role="contentinfo"] a,#footer .menu > .current_page_item > a').css('color', to ? to : '' );
    });
});

///////////////////////////////////
// Primary Button Options
///////////////////////////////////

// Primary Button Color
wp.customize('primary_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button,.button,button').css('background-color', to ? to : '' );
      });
  });

// Primary Button Hover Color
wp.customize('primary_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button:hover,.button:hover,button:hover,a.button:focus,.button:focus,button:focus').css('background-color', to ? to : '' );
      });
  });

// Primary Button Font Color
wp.customize('primary_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button,.button,button').css('color', to ? to : '' );
      });
  });

// Primary Button Font Hover Color
wp.customize('primary_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button:hover,.button:hover,button:hover,a.button:focus,.button:focus,button:focus').css('color', to ? to : '' );
      });
  });

// Primary Button Font Weight
wp.customize('primary_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button,.button,button').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Secondary Button Options
///////////////////////////////////

// Secondary Button Color
wp.customize('secondary_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button.secondary').css('background-color', to ? to : '' );
      });
  });

// Secondary Button Font Color
wp.customize('secondary_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button.secondary').css('color', to ? to : '' );
      });
  });

// Secondary Button Hover Color
wp.customize('secondary_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.secondary:hover,a.button.secondary:focus').css('background-color', to ? to : '' );
      });
  });

// Secondary Button Font Hover Color
wp.customize('secondary_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.secondary:hover,a.button.secondary:focus').css('color', to ? to : '' );
      });
  });

// Secondary Button Font Weight
wp.customize('secondary_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button.secondary').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Success Button Options
///////////////////////////////////

// Success Button Color
wp.customize('success_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button.success').css('background-color', to ? to : '' );
      });
  });

// Success Button Hover Color
wp.customize('success_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.success:hover,a.button.success:focus').css('background-color', to ? to : '' );
      });
  });

// Success Button Font Color
wp.customize('success_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button.success').css('color', to ? to : '' );
      });
  });

// Success Button Font Hover Color
wp.customize('success_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.success:hover,a.button.success:focus').css('color', to ? to : '' );
      });
  });

// Success Button Font Weight
wp.customize('success_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button.success').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Warning Button Options
///////////////////////////////////

// Warning Button Color
wp.customize('warning_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button.warning').css('background-color', to ? to : '' );
      });
  });

// Warning Button Hover Color
wp.customize('warning_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.warning:hover,a.button.warning:focus').css('background-color', to ? to : '' );
      });
  });

// Warning Button Font Color
wp.customize('warning_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button.warning').css('color', to ? to : '' );
      });
  });

// Warning Button Font Hover Color
wp.customize('warning_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.warning:hover,a.button.warning:focus').css('color', to ? to : '' );
      });
  });

// Warning Button Font Weight
wp.customize('warning_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button.warning').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Alert Button Options
///////////////////////////////////

// Alert Button Color
wp.customize('alert_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button.alert').css('background-color', to ? to : '' );
      });
  });

// Alert Button Hover Color
wp.customize('alert_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.alert:hover,a.button.alert:focus').css('background-color', to ? to : '' );
      });
  });

// Alert Button Font Color
wp.customize('alert_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button.alert').css('color', to ? to : '' );
      });
  });

// Alert Button Font Hover Color
wp.customize('alert_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.alert:hover,a.button.alert:focus').css('color', to ? to : '' );
      });
  });

// Alert Button Font Weight
wp.customize('alert_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button.alert').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Information Button Options
///////////////////////////////////

// Info Button Color
wp.customize('info_button_color',function( value ) {
      value.bind(function(to) {
          $('a.button.info').css('background-color', to ? to : '' );
      });
  });

// Info Button Hover Color
wp.customize('info_button_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.info:hover,a.button.info:focus').css('background-color', to ? to : '' );
      });
  });

// Info Button Font Color
wp.customize('info_button_font_color',function( value ) {
      value.bind(function(to) {
          $('a.button.info').css('color', to ? to : '' );
      });
  });

// Info Button Font Hover Color
wp.customize('info_button_font_hover_color',function( value ) {
      value.bind(function(to) {
          $('a.button.info:hover,a.button.info:focus').css('color', to ? to : '' );
      });
  });

// Info Button Font Weight
wp.customize('info_button_font_weight',function( value ) {
      value.bind(function(to) {
          $('a.button.info').css('font-weight', to ? to : '' );
      });
  });

///////////////////////////////////
// Pagination Colors
///////////////////////////////////

// Active Background Color
wp.customize('pagination_current_color',function( value ) {
	value.bind(function(to) {
			$('#content ul.pagination .current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a').css('background-color', to ? to : '' );
	});
});

// Active Font Color
wp.customize('pagination_current_font_color',function( value ) {
	value.bind(function(to) {
			$('#content ul.pagination .current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a').css('color', to ? to : '' );
	});
});

// Pagination Link Color
wp.customize('pagination_link_color',function( value ) {
	value.bind(function(to) {
			$('#content ul.pagination li a,#content ul.pagination li button').css('color', to ? to : '' );
	});
});

// Pagination Link Hover Color
wp.customize('pagination_link_hover_color',function( value ) {
	value.bind(function(to) {
			$('#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus').css('color', to ? to : '' );
	});
});

// Pagination Background Hover Color
wp.customize('pagination_hover_color',function( value ) {
	value.bind(function(to) {
			$('#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus').css('background-color', to ? to : '' );
	});
});


///////////////////////////////////
// Social Colors
///////////////////////////////////

/* end adding */

} )( jQuery );
