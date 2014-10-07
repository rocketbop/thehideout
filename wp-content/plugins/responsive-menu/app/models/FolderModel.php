<?php

class RM_FolderModel extends RM_BaseModel {
    
    /**
     * Function to create the data folders
     *
     * @return null
     * @added 1.6
     */
    
    static function create() {

        
        $mainFolder = RM_Registry::get( 'config', 'plugin_data_dir' );
        $cssFolder  = RM_Registry::get( 'config', 'plugin_data_dir' ) . '/css';
        $jsFolder   = RM_Registry::get( 'config', 'plugin_data_dir' ) . '/js';
        

        if( !file_exists( $mainFolder ) ) mkdir( $mainFolder, 0777 );
        if( !file_exists( $cssFolder ) ) mkdir( $cssFolder, 0777 );
        if( !file_exists( $jsFolder ) ) mkdir( $jsFolder, 0777 ); 

        
        if( !file_exists( $mainFolder ) )
            RM_Status::set( 'error', __( 'Unable to create data folders', 'responsive-menu' ) );
        
        if( !file_exists( $cssFolder ) )
            RM_Status::set( 'error', __( 'Unable to create CSS folders', 'responsive-menu' ) );
        
        if( !file_exists( $cssFolder ) )
            RM_Status::set( 'error', __( 'Unable to create JS folders', 'responsive-menu' ) );
        
        
    }
    

}