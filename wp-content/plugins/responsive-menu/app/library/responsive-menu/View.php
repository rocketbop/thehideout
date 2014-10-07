<?php

class RM_View {
    
        
    /**
     * Create a new view for display throughout the application
     * Users .phtml files found in the app/views folder
     *
     * @param  string  $page
     * @param mixed $data
     * @return null
     * @added 2.0
     */
    
    static function make( $page, $data ) {
        
        
        $page = str_replace( '.', '/', $page );
        
        require RM_Registry::get( 'config', 'plugin_base_dir' ) . '/app/views/' . $page . '.phtml';
        
        
    }
    
    
    /**
     * Function to Check the current View Port Tag on the site
     *
     * @return string
     * @added 2.0
     */
    
    static function checkViewPortTag() {

        
        if( $metaTags = @get_meta_tags( get_bloginfo( 'url' ) ) ) :

            
            if ( isset( $metaTags['viewport'] ) )
                return $metaTags['viewport'];
            else 
                return false;
        
        endif;
        
        
        return false;
        
        
    }
    
    
    /**
     * Function to format and display the status bar in the admin pages
     *
     * @param  array  $status
     * @return string
     * @added 2.0
     */
    
    static function statusBar( $status ) {

        
        $message = null;        
        
        foreach( $status as $stati ) :
            
            $message .= '<div id="message" class="' . $stati[0] . ' below-h2 cookieBannerSuccess">';
            $message .= '<p>' . $stati[1] . '</p>';
            $message .= '</div>';

        endforeach;

        return $message;
                
        
    }
    
    
    /**
     * Function to format and display the search bar in the main menu
     *
     * @param  array  $status
     * @return string
     * @added 2.0
     */
    
    static function searchBar() { ?>
        

        <form action="<?php echo get_site_url(); ?>" id="responsiveSearch" method="get" role="search">

            <input type="search" name="s" value="" results=5 autosave=responsive-menu placeholder="Search" id="responsiveSearchInput">
            <input type="submit" style="display: none;" />
            
        </form>
                        
                        
   <?php 
   
    }
    
    
    /**
     * Function to format and display the search bar in the main menu
     *
     * @param  array  $status
     * @return string
     * @added 2.0
     */
    
    static function additionalContent() { 
        
        if( ResponsiveMenu::getOption( 'RMHtml' ) ) : ?>
        
            <div id="rm-additional-content"><?php echo ResponsiveMenu::getOption( 'RMHtml' ); ?></div>
                                      
   <?php 
   
        endif;
   
    }
    
    
}