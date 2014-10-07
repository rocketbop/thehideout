<?php

class RM_InstallController extends RM_BaseController {
    
    
    /**
     * Prepare our Installation Options
     *
     * @return null
     * @added 2.0
     */
    
    static function prepare() {
        
        
        register_activation_hook( __FILE__, array( 'RM_InstallController', 'install' ) );
        
        
    }
    
        
    /**
     * Sets our initial default options when menu
     * is first installed
     *
     * @return null
     * @added 1.0
     */
    
    static function install() {

        
        add_option( 'RMVer', RM_Registry::get( 'config', 'current_version' ) );
        add_option( 'RMOptions', RM_Registry::get( 'defaults' ) );

        
    }
    
    
}