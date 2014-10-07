<?php


class RM_CSSController extends RM_BaseController {
    
    
    /**
     * Prepare our CSS Outputs
     *
     * @return null
     * @added 2.0
     */
    
    static function prepare() {
        
        
        if( ResponsiveMenu::getOption( 'RMExternal' ) ) :

            
            add_action( 'wp_enqueue_scripts', array( 'RM_CSSController', 'addExternal' ) );
            
            
        else :
                
            
            add_action( 'wp_head', array( 'RM_CSSController', 'addInline' ) ); 

        
        endif;   


    }
    
    
    /**
     * Create and echos the Inline Styles
     *
     * @return string
     * @added 2.0
     */
    
    static function addInline() {
        
        
        echo ResponsiveMenu::getOption( 'RMMinify' ) == 'minify' ? RM_CSSModel::Minify( RM_CSSModel::getCSS() ) : RM_CSSModel::getCSS(); 
        
        
    }
    
    
    /**
     * Adds External Styles to Header
     *
     * @return null
     * @added 2.0
     */
    
    static function addExternal() {
        
        
        wp_enqueue_style( 
            'responsive-menu', 
            RM_Registry::get( 'config', 'plugin_data_uri' ) . 'css/responsive-menu-' . get_current_blog_id() . '.css', 
            array(), 
            '1.0', 
            'all' 
        ); 
               
        
    }
    

}