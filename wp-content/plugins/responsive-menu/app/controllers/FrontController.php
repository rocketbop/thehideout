<?php

class RM_FrontController extends RM_BaseController {

    
    /**
     * Prepare our Front End Options
     *
     * @return null
     * @added 2.0
     */
    
    static function prepare() {
        
        // Check that we are in the admin area
        if( !is_admin() ) : 
            
        
            if( ResponsiveMenu::getOption( 'RMCliToClo' ) ) :
            
                add_action( 'wp_enqueue_scripts', array( 'RM_FrontController', 'jQueryMobile' ) );
            
            endif;
            
            
        endif;
        

    }
    
    
    /**
     * Makes sure jQuery Mobile is added to all front pages if the specific option is selected 
     * as it is needed for some of the functions to work
     *
     * @return null
     * @added 2.0
     */
    
    static function jQueryMobile() {
        
        
        wp_register_script( 'touch', RM_Registry::get( 'config', 'plugin_base_uri' ) . 'public/js/touch.js', 'jquery', '', false );
	wp_enqueue_script( 'touch' ); 
        

    }
    
  
}