<?php

class RM_Registry {
    
    /**
     * Base array that holds all our further registry key => val pairs
     *
     * @param  array  $registry
     * @added 2.0
     */
    
    static $registry;
    
    
    /**
     * Function to Get Registry values
     *
     * @param  array  $array
     * @param  string $val
     * @return array
     * @added 2.0
     */
    
    public static function get( $array, $val = null ) {
        
        
        return !$val ? self::$registry[$array] : self::$registry[$array][$val];
        
        
    }
    
        
    /**
     * Function to Set Registry values
     *
     * @param  string  $key
     * @param  mixed $val
     * @return null
     * @added 2.0
     */
    
    public static function set( $key, $val ) {
        
        
        self::$registry[$key] = $val;
        
        
    }
   
    
}