<?php

class RM_BaseModel {
    
    
    /**
     * Basic Function to filter Input
     *
     * @param string $input
     * @return string
     * @added 1.0
     */
    
    static function Filter( $input ) {

        
        return stripslashes( strip_tags( trim( $input ) ) );
        
        
    }
    
    /**
     * Basic Function to filter HTML allowed Input
     *
     * @param string $input
     * @return string
     * @added 1.0
     */
    
    static function FilterHtml( $input ) {

        
        return trim( stripslashes( $input ) );
        
        
    }
    
    
    /**
     * Function to minify the Js and CSS files if required
     * 
     * Parts taken from
     * http://castlesblog.com/2010/august/14/php-javascript-css-minification
     * 
     * @param string $input
     * @return string
     * @added 1.9
     */
        
    static function Minify( $input ) {

        
        /* remove comments */
        $output = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $input);
        
        /* remove tabs, spaces, newlines, etc. */
        $output = str_replace(array("\r\n","\r","\n","\t",'  ','    ','     '), '', $output);
        
        /* remove other spaces before/after ; */
        $output = preg_replace(array('(( )+{)','({( )+)'), '{', $output);
        $output = preg_replace(array('(( )+})','(}( )+)','(;( )*})'), '}', $output);
        $output = preg_replace(array('(;( )+)','(( )+;)'), ';', $output);

        return $output;
        
        
    }
    
    
}