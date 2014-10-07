<?php

class RM_Status {
    
    /**
     * Static Array that holds all the current system statuses
     *
     * @param  array  $status
     * @added 2.0
     */
    
    protected static $status = array();
    
    
    /**
     * Function to set a new status in the system
     *
     * @param  string  $type
     * @param string $text
     * @return null
     * @added 2.0
     */
    
    static function set( $type, $text ) {
        
        
        array_push( self::$status, array( $type, $text ) );

        
    }
    
    /**
     * Function to retrieve all current statuses in the system
     *
     * @return array
     * @added 2.0
     */
    
    static function get() {
        
        
        return self::$status;
        
        
    }
    
    
}