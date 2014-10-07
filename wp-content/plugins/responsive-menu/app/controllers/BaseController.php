<?php

class RM_BaseController {
    
    
    /**
     * Determines wether to display scripts in footer
     *
     * @return boolean
     * @added 2.0
     */
    
    static function inFooter() {
           
        
        return ResponsiveMenu::getOption( 'RMFooter' ) && ResponsiveMenu::getOption( 'RMFooter' ) == 'footer' ?  true : false;
        
        
    }
    
    
}