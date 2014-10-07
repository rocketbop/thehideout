<?php

class RM_Input {
    
  
    /**
     * Function to get all Input values
     *
     * @param string $name
     * @return array
     * @added 2.0
     */
    
    static function all( $name = null ) {
        
        
        $arrays = array_merge( $_POST, $_GET );
        
        return $name ? $arrays[$name] : $arrays;
        
        
    }
    
        
    /**
     * Function to get only post values
     *
     * @param  string  $name
     * @return array
     * @added 2.0
     */
    
    static function post( $name = null ) {
        
        
        return $name && isset( $_POST[$name] ) ? $_POST[$name] : $_POST;
        
        
    }
    
    /**
     * Function to get only get values
     *
     * @param  string  $name
     * @return array
     * @added 2.0
     */
    
    static function get( $name = null ) {
        
        
        return $name && isset( $_GET[$name] ) ? $_GET[$name] : $_GET;
        
        
    }
   
    
}