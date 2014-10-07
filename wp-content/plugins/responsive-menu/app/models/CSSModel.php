<?php

class RM_CSSModel extends RM_BaseModel {
    
    
    /**
     * Function to create the file to hold the CSS file
     *
     * @param string $css
     * @return file
     * @added 1.6
     */
    
    static function createCSSFile( $css ) {
        
        
        $file = fopen( RM_Registry::get( 'config', 'plugin_data_dir' ) . '/css/responsive-menu-' . get_current_blog_id() . '.css', 'w' );
        
        $cssFile = fwrite( $file, $css );
        
        fclose( $file );
        
        if( !$file ) 
            RM_Status::set( 'error', __( 'Unable to create CSS file', 'responsive-menu' ) );
                
        return $cssFile;
        
        
    }
    
    /**
     * Function to format, create and get the CSS itself
     *
     * @param string $args
     * @return string
     * @added 1.0
     */
    
    static function getCSS( $args = null ) {

        
        $options = ResponsiveMenu::getOptions();

        $important = empty( $options['RMRemImp'] ) ? ' !important;' : ';';
        
        $position = $options['RMPos'] == 'fixed' ? 'fixed' : 'absolute';
        $overflowy = $options['RMPos'] == 'fixed' ? 'overflow-y: auto;' : '';
        $bottom = $options['RMPos'] == 'fixed' ? 'bottom: 0px;' : '';

        $right = empty($options['RMRight']) ? '0' : $options['RMRight'];
        
        $top = empty( $options['RMTop']) ? '0' : $options['RMTop'];
        
        $width = empty($options['RMWidth']) ? '75' : $options['RMWidth'];
        $mainBkg = empty($options['RMBkg']) ? "#43494C" : $options['RMBkg'];
        $mainBkgH = empty($options['RMBkgHov']) ? "#3C3C3C" : $options['RMBkgHov'];
        $font = empty($options['RMFont']) ? '' : 'font-family: ' . $options['RMFont'] . $important;
        $titleCol = empty($options['RMTitleCol']) ? '#FFFFFF' : $options['RMTitleCol'];
        $titleColH = empty($options['RMTitleColHov']) ? '#FFFFFF' : $options['RMTitleColHov'];
        $txtCol = empty($options['RMTextCol']) ? "#FFFFFF" : $options['RMTextCol'];
        $txtColH = empty($options['RMTextColHov']) ? "#FFFFFF" : $options['RMTextColHov'];
        $clickCol = empty($options['RMLineCol']) ? "#FFFFFF" : $options['RMLineCol'];
        $clickBkg = empty($options['RMBkgTran']) ? "background: {$options['RMClickBkg']};" : '';
        $borCol = empty($options['RMBorCol']) ? "#3C3C3C" : $options['RMBorCol'];
        $breakpoint = empty($options['RMBreak']) ? "600" : $options['RMBreak'];
        $titleBkg = empty($options['RMTitleBkg']) ? "#43494C" : $options['RMTitleBkg'];
        
        $fontSize = empty($options['RMFontSize']) ? 13 : $options['RMFontSize'];
        $titleSize = empty($options['RMTitleSize']) ? 14 : $options['RMTitleSize'];                        
        $btnSize = empty($options['RMBtnSize']) ? 13 : $options['RMBtnSize'];
        
        $curBkg = empty($options['RMCurBkg']) ? $mainBkg : $options['RMCurBkg'];
        $curCol = empty($options['RMCurCol']) ? $txtCol : $options['RMCurCol'];
        
        /* Added 1.7 */
        $trans = empty( $options['RMTranSpd'] ) ? 1 : $options['RMTranSpd'];
        $align = empty( $options['RMTxtAlign'] ) ? 'left' : $options['RMTxtAlign'];
        $linkPadding = $options['RMTxtAlign'] == 'right' ? '12px 5% 12px 0px' : '12px 0px 12px 5%';
        $titlePadding = $options['RMTxtAlign'] == 'right' ? '20px 5% 20px 0px' : '20px 0px 20px 5%';
        $paddingAlign = $align == 'center' ? 'left' : $align;
        $height = empty( $options['RMLinkHeight'] ) ? 19 : $options['RMLinkHeight'];
        $subBtnAlign =   $align == 'right' ? 'left' : 'right';
        
        /* Added 1.8 */
        $side = empty( $options['RMSide'] ) ? 'left' : $options['RMSide'];
        
        /* Added 1.9 */
        $minWidth = empty( $options['RMMinWidth'] ) ? '' : 'min-width: ' . $options['RMMinWidth'] . 'px' . $important;
        
        /* Added 2.0 */
        $maxWidth = empty( $options['RMMaxWidth'] ) ? '' : 'max-width: ' . $options['RMMaxWidth'] . 'px' . $important;
        
        switch( $options['RMSide'] ) :
            case 'left' : $topRM = 'top: 0px'; $botRM = ''; break;
            case 'right' : $topRM = 'top: 0px'; $botRM = ''; break;
            case 'top' : $topRM = 'top: -100%'; $botRM = ''; break;
            case 'bottom' : $topRM = 'top: 100%'; $botRM = 'bottom: 0px'; break;
        endswitch;
        
        switch( $side ) :
            case 'left' : $pushSide = $side; $pushWidth = $width; $pushPos = 'relative'; break;
            case 'right' : $pushSide = $side; $pushWidth = $width; $pushPos = 'relative'; break;
            case 'top' : $pushSide = 'top'; $pushWidth = '100'; $pushPos = 'absolute'; break;
            case 'bottom' : $pushSide = 'bottom'; $pushWidth = '-100'; $pushPos = 'absolute'; break;
            default : $pushSide = $side; $pushWidth = $width; break;
        endswitch;
  
        $css = '';
        
        if( $args != 'strip_tags' ) : 

            $css .= "<style> ";
        
        endif;
        
        $css .= "

            #responsive-menu .appendLink, 
            #responsive-menu .responsive-menu li a, 
            #responsive-menu #responsive-menu-title a,
            #responsive-menu .responsive-menu, 
            #responsive-menu div, 
            #responsive-menu .responsive-menu li, 
            #responsive-menu 
            {
                box-sizing: content-box{$important}
                -moz-box-sizing: content-box{$important}
                -webkit-box-sizing: content-box{$important}
                -o-box-sizing: content-box{$important}
            }

            #click-menu #RMX {

                display: none;
                font-size: 24px;
                line-height: 30px;
                color: $clickCol{$important}
            }

            .RMPushOpen
            {
                width: 100%{$important}
                overflow-x: hidden{$important}
                height: 100%{$important}
            }

            .RMPushSlide
            {
                position: $pushPos;
                $pushSide: $pushWidth%;
            }

            #responsive-menu								
            { 
                position: $position;
                $overflowy
                $bottom
                width: $width%;
                $side: -$width%;
                $topRM;
                background: $mainBkg;
                z-index: 9999;  
                box-shadow: 0px 1px 8px #333333; 
                font-size: {$fontSize}px{$important}
                max-width: 999px;
                display: none;
                $minWidth
                $maxWidth
            }
            
            #responsive-menu.admin-bar-showing
            {
                padding-top: 32px;
            }
            
            #click-menu.admin-bar-showing
            {
                margin-top: 32px;
            }
                
            #responsive-menu #rm-additional-content
            {
                padding: 10px 5%{$important}
                width: 90%{$important}
                color: $txtCol;
            }
            
            #responsive-menu .appendLink
            {
                $subBtnAlign: 0px{$important}
                position: absolute{$important}
                border: 1px solid $borCol{$important}
                padding: 12px 10px{$important}
                color: $txtCol{$important}
                background: $mainBkg{$important}
                height: {$height}px{$important}
                line-height: {$height}px{$important}
                border-right: 0px{$important}
            }
            
            #responsive-menu .appendLink:hover
            {
                cursor: pointer;
                background: $mainBkgH{$important}
                color: $txtColH{$important}
            }

            #responsive-menu .responsive-menu, 
            #responsive-menu div, 
            #responsive-menu .responsive-menu li,
            #responsive-menu
            {
                text-align: $align{$important}
            }
                    
            #responsive-menu .RMImage
            {
                vertical-align: middle;
                margin-right: 10px;
                display: inline-block;
            }

            #responsive-menu.RMOpened
            {
                $botRM;
            }
            
            #responsive-menu,
            #responsive-menu input {
                $font
            }      
            
            #responsive-menu #responsive-menu-title			
            {
                width: 95%{$important} 
                font-size: {$titleSize}px{$important} 
                padding: $titlePadding{$important}
                margin-left: 0px{$important}
                background: $titleBkg{$important}
                white-space: nowrap{$important}
            }
      
            #responsive-menu #responsive-menu-title,
            #responsive-menu #responsive-menu-title a 
            {
                color: $titleCol{$important}
                text-decoration: none{$important}
                overflow: hidden{$important}
            }
            
            #responsive-menu #responsive-menu-title a:hover {
                color: $titleColH{$important}
                text-decoration: none{$important}
            }
   
            #responsive-menu .appendLink,
            #responsive-menu .responsive-menu li a,
            #responsive-menu #responsive-menu-title a
            {

                transition: {$trans}s all;
                -webkit-transition: {$trans}s all;
                -moz-transition: {$trans}s all;
                -o-transition: {$trans}s all;

            }
            
            #responsive-menu .responsive-menu			
            { 
                float: left{$important}  
                width: 100%{$important} 
                list-style-type: none{$important}
                margin: 0px{$important}
            }
                        
            #responsive-menu .responsive-menu li.current_page_item > a,
            #responsive-menu .responsive-menu li.current_page_item > .appendLink
            {
                background: $curBkg{$important}
                color: $curCol{$important}
            }
                    
            #responsive-menu  .responsive-menu ul
            {
                margin-left: 0px{$important}
            }

            #responsive-menu .responsive-menu li		
            { 
                list-style-type: none{$important}
            }

            #responsive-menu .responsive-menu ul li:last-child	
            { 
                padding-bottom: 0px{$important} 
            }

            #responsive-menu .responsive-menu li a	
            { 
                padding: $linkPadding{$important}
                width: 95%{$important}
                display: block{$important}
                height: {$height}px{$important}
                line-height: {$height}px{$important}
                overflow: hidden{$important}
                white-space: nowrap{$important}
                color: $txtCol{$important}
                border-top: 1px solid $borCol{$important} 
                text-decoration: none{$important}
            }

            #click-menu						
            { 
                text-align: center;
                cursor: pointer; 
                font-size: {$btnSize}px{$important}
                display: none;
                position: $position;
                right: $right%;
                top: {$top}px;
                color: $clickCol;
                $clickBkg
                padding: 5px;
                border-radius: 5px;
                z-index: 9999;
            }

            #responsive-menu #responsiveSearch
            {
                display: block{$important}
                width: 95%{$important}
                padding-$paddingAlign: 5%{$important}
                border-top: 1px solid $borCol{$important} 
                clear: both{$important}
                padding-top: 10px{$important}
                padding-bottom: 10px{$important}
                height: 40px{$important}
                line-height: 40px{$important}
            }

            #responsive-menu #responsiveSearchInput
            {
                width: 91%{$important}
                padding: 5px 0px 5px 3%{$important}
                -webkit-appearance: none{$important}
                border-radius: 2px{$important}
                border: 1px solid $borCol{$important}
            }
  
            #responsive-menu .responsive-menu,
            #responsive-menu div,
            #responsive-menu .responsive-menu li
            {
                width: 100%{$important}
                float: left{$important}
                margin-left: 0px{$important}
                padding-left: 0px{$important}
            }

            #responsive-menu .responsive-menu li li a
            {
                padding-$paddingAlign: 10%{$important}
                width: 90%{$important}
                overflow: hidden{$important}
            }
 
            #responsive-menu .responsive-menu li li li a
            {
                padding-$paddingAlign: 15%{$important}
                width: 85%{$important}
                overflow: hidden{$important}
            }
            
            #responsive-menu .responsive-menu li li li li a
            {
                padding-$paddingAlign: 20%{$important}
                width: 80%{$important}
                overflow: hidden{$important}
            }
            
            #responsive-menu .responsive-menu li li li li li a
            {
                padding-$paddingAlign: 25%{$important}
                width: 75%{$important}
                overflow: hidden{$important}
            }

            #responsive-menu .responsive-menu li a:hover
            {       
                background: $mainBkgH{$important}
                color: $txtColH{$important}
                list-style-type: none{$important}
                text-decoration: none{$important}
            }
            
            #click-menu .threeLines
            {
                width: 33px{$important}
                height: 33px{$important}
                margin: auto{$important}
            }

            #click-menu .threeLines .line
            {
                height: 5px{$important}
                margin-bottom: 6px{$important}
                background: $clickCol{$important}
                width: 100%{$important}
            }

            @media only screen and ( min-width : 0px ) and ( max-width : {$breakpoint}px ) { 

                #click-menu	
                {
                    display: block;
                }

";

        $css .= $options['RMCss'] ? $options['RMCss'] . " { display: none !important; } " : '';

        if( $options['RMDepth'] == 1 ) :
            
            $css .= "
                
                #responsive-menu .responsive-menu li .appendLink,
                #responsive-menu .responsive-menu li li { display: none !important; }

            ";

        endif;
        
        if( $options['RMDepth'] == 2 ) :
            
            $css .= "
                
                #responsive-menu .responsive-menu li li .appendLink,
                #responsive-menu .responsive-menu li li li { display: none !important; }

            ";
        
        endif;
        
        if( $options['RMDepth'] == 3 ) :
            
            $css .= "
                
                #responsive-menu .responsive-menu li li li .appendLink,
                #responsive-menu .responsive-menu li li li li { display: none !important; }

            ";
        
        endif;
        
        if( $options['RMDepth'] == 4 ) :
            
            $css .= "
                
                #responsive-menu .responsive-menu li li li li .appendLink,
                #responsive-menu .responsive-menu li li li li li { display: none !important; }

            ";

        endif;
        
        if( $options['RMDepth'] == 5 ) :
            
            $css .= "
                
                #responsive-menu .responsive-menu li li li li li .appendLink,
                #responsive-menu .responsive-menu li li li li li li { display: none !important; }

            ";

        endif;

        $css .= " }";

        $css .= $options['RMAnim'] == 'push' && $options['RMPushCSS'] ? $options['RMPushCSS'] . " { position: {$pushPos}{$important} left: 0px; } " : '';
        
        /* Finally Add The tag at the end only if it's an inline style */
        if( $args != 'strip_tags' ) : 

            $css .= "</style> ";
        
        endif;
        
        return $css;
        
        
    }

    
}