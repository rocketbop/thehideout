<?php

class RM_UpgradeController extends RM_BaseController {
    
      
    /**
     * Script that runs if the menu has been upgraded
     *
     * @return mixed
     * @added 2.0
     */
    
    static function upgrade() {
        
        
        if( self::needsUpgrade() ) :
            

            if( ResponsiveMenu::getOption( 'RMExternal' ) ) : 
                
                
                RM_FolderModel::create();
            
                $js = RM_JSModel::getJs( ResponsiveMenu::getOptions() );        
                $js = ResponsiveMenu::getOption( 'RMMinify' ) == 'minify' ? RM_JSModel::Minify( $js ) : $js = $js; 
                
                RM_JSModel::createJSFile( $js );
                
                $css = RM_CSSModel::getCSS( 'strip_tags' );
                $css = RM_CSSModel::Minify( $css );
                
                RM_CSSModel::createCSSFile( $css );

                
            endif;
            
            /* Update Version */
            update_option( 'RMVer', RM_Registry::get( 'config', 'current_version' ) );
            
            /* Merge Changes */
            update_option( 'RMOptions', array_merge( RM_Registry::get( 'defaults' ), ResponsiveMenu::getOptions() ) );
            
            
        endif;

            
    }
    
        
    /**
     * Determines whether or not the site needs upgrading
     *
     * @return boolean
     * @added 2.0
     */
    
    static function needsUpgrade() {
        
        
        return get_option( 'RMVer' ) != RM_Registry::get( 'config', 'current_version' ) ? true : false;

        
    }
    
    
}