<?php


class ResponsiveMenu {
    
    
    /**
     * Main Construct for the Whole Application
     * Sets Registry and Default Values (if none present)
     *
     * @return null
     * @added 2.0
     */
    
    public function __construct() {
        
        
        if( !get_option( 'RMVer' ) )
                add_option( 'RMVer', RM_Registry::get( 'config', 'current_version' ) );
                
        
        if( !get_option( 'RMOptions' ) )
            add_option( 'RMOptions', RM_Registry::get( 'defaults' ) );
        
        
        RM_Registry::set( 'options', get_option( 'RMOptions' ) );
        RM_Registry::set( 'version', get_option( 'RMVer' ) );

        
    }
    
        
    /**
     * The main application run function, this sets up all the magic and grunt
     * work of the application, firing off all the different controllers.
     *
     * @return null
     * @added 2.0
     */
    
    public function run() {
        

        RM_InstallController::prepare();
        RM_UpgradeController::upgrade();
        RM_GlobalController::prepare();
        RM_FrontController::prepare();
        RM_AdminController::prepare();
        RM_HTMLController::prepare();
        RM_CSSController::prepare();
        RM_JSController::prepare();
     
        RM_Shortcode::prepare();
     
    }
    
  
    /**
     * Function to return all options throughout the site, it also
     * automatically mixes in any default options that don't exist
     * in the current version
     *
     * @return array
     * @added 2.1
     */
    
    static function getOptions() {
        
        return array_merge( (array) RM_Registry::get( 'defaults' ), (array) get_option( 'RMOptions' ) );
        
    }
    
    
    /**
     * Function to return individual options throughout the site, it
     * automatically returns the default option if a current value
     * doesn't exist in the current version
     *
     * @return array
     * @added 2.1
     */
    
    static function getOption( $option ) {
        
        $options = self::getOptions();
        
        if( isset( $options[$option] ) )
            return $options[$option];
        
        return RM_Registry::get( 'defaults', $option );
        
    }
    
    
}