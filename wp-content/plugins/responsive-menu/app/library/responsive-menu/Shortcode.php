<?php

class RM_Shortcode {
    
    /**
     * Function to set a new status in the system
     *
     * @param  string  $type
     * @param string $text
     * @return null
     * @added 2.0
     */
    
    static function prepare() {
        
        
        if( ResponsiveMenu::getOption( 'RMShortcode' ) )
            add_shortcode( 'responsive-menu', array( 'RM_HTMLController', 'display' ) );

        
    }
    
    
}