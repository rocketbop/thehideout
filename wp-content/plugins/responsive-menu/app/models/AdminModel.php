<?php

class RM_AdminModel extends RM_BaseModel {
    
        
    /**
     * Saves all the data from the admin page to the database
     *
     * @param  array  $data
     * @return null
     * @added 1.0
     */
    
    static public function save( $data ) {
        
        // Initialise Variables Correctly
        
        $RM = isset($data['RM']) ? $data['RM'] : RM_Registry::get( 'defaults', 'RM' );
        
        $RMTitle = isset($data['RMTitle']) ? $data['RMTitle'] : RM_Registry::get( 'defaults', 'RMTitle' );
        
        $RMBreak = $data['RMBreak'] ? $data['RMBreak'] : RM_Registry::get( 'defaults', 'RMBreak' );
        
        $RMDepth = isset($data['RMDepth']) ? $data['RMDepth'] : RM_Registry::get( 'defaults', 'RMDepth' );
        
        $RMTop = isset($data['RMTop']) ? $data['RMTop'] : RM_Registry::get( 'defaults', 'RMTop' );
        
        $RMRight = isset($data['RMRight']) ? $data['RMRight'] : RM_Registry::get( 'defaults', 'RMRight' );
        
        $RMCss = isset($data['RMCss']) ? $data['RMCss'] : RM_Registry::get( 'defaults', 'RMCss' );
        
        $RMLineCol = !empty($data['RMLineCol']) ? $data['RMLineCol'] : RM_Registry::get( 'defaults', 'RMLineCol' );
        
        $RMClickBkg = !empty($data['RMClickBkg']) ? $data['RMClickBkg'] : RM_Registry::get( 'defaults', 'RMClickBkg' );
        
        $RMClickTitle = isset($data['RMClickTitle']) ? $data['RMClickTitle'] : RM_Registry::get( 'defaults', 'RMClickTitle' );
        
        $RMBkgTran = isset($data['RMBkgTran']) ? $data['RMBkgTran'] : false;
        
        $RMPos = isset($data['RMPos']) ? $data['RMPos'] : RM_Registry::get( 'defaults', 'RMPos' );
        
        $RMImage = isset($data['RMImage']) ? $data['RMImage'] : RM_Registry::get( 'defaults', 'RMImage' );
        
        $RMWidth = $data['RMWidth'] ? $data['RMWidth'] : RM_Registry::get( 'defaults', 'RMWidth' );
        
        $RMBkg = !empty($data['RMBkg']) ? $data['RMBkg'] : RM_Registry::get( 'defaults', 'RMBkg' );
        
        $RMBkgHov = !empty($data['RMBkgHov']) ? $data['RMBkgHov'] : RM_Registry::get( 'defaults', 'RMBkgHov' );
        
        $RMTitleCol = !empty($data['RMTitleCol']) ? $data['RMTitleCol'] : RM_Registry::get( 'defaults', 'RMTitleCol' );
        
        $RMTextCol = !empty($data['RMTextCol']) ? $data['RMTextCol'] : RM_Registry::get( 'defaults', 'RMTextCol' );
        
        $RMBorCol = !empty($data['RMBorCol']) ? $data['RMBorCol'] : RM_Registry::get( 'defaults', 'RMBorCol' );
        
        $RMTextColHov = !empty($data['RMTextColHov']) ? $data['RMTextColHov'] : RM_Registry::get( 'defaults', 'RMTextColHov' );
        
        $RMTitleColHov = !empty($data['RMTitleColHov']) ? $data['RMTitleColHov'] : RM_Registry::get( 'defaults', 'RMTitleColHov' );

        /* Added in 1.6 */
        
        $RMAnim = isset($data['RMAnim']) ? $data['RMAnim'] : RM_Registry::get( 'defaults', 'RMAnim' );
        
        $RMPushCSS = isset($data['RMPushCSS']) ? $data['RMPushCSS'] : RM_Registry::get( 'defaults', 'RMPushCSS' );
        
        $RMTitleBkg = !empty($data['RMTitleBkg']) ? $data['RMTitleBkg'] : RM_Registry::get( 'defaults', 'RMTitleBkg' );
        
        $RMFont =  isset($data['RMFont']) ? $data['RMFont'] : RM_Registry::get( 'defaults', 'RMFont' );
        
        $RMFontSize = $data['RMFontSize'] ? $data['RMFontSize'] : RM_Registry::get( 'defaults', 'RMFontSize' );
        
        $RMTitleSize = $data['RMTitleSize'] ? $data['RMTitleSize'] : RM_Registry::get( 'defaults', 'RMTitleSize' );
        
        $RMBtnSize = $data['RMBtnSize'] ? $data['RMBtnSize'] : RM_Registry::get( 'defaults', 'RMBtnSize' );
        
        $RMCurBkg = !empty($data['RMCurBkg']) ? $data['RMCurBkg'] : RM_Registry::get( 'defaults', 'RMCurBkg' );
        
        $RMCurCol = !empty($data['RMCurCol']) ? $data['RMCurCol'] : RM_Registry::get( 'defaults', 'RMCurCol' );
 
        $RMAnimSpd = $data['RMAnimSpd'] ? $data['RMAnimSpd'] : RM_Registry::get( 'defaults', 'RMAnimSpd' );

        /* Added in 1.7 */
        
        $RMTranSpd = $data['RMTranSpd'] ? $data['RMTranSpd'] : RM_Registry::get( 'defaults', 'RMTranSpd' );
        
        $RMTxtAlign = isset($data['RMTxtAlign']) ? $data['RMTxtAlign'] : RM_Registry::get( 'defaults', 'RMTxtAlign' );
        
        $RMSearch = isset($data['RMSearch']) ? $data['RMSearch'] : RM_Registry::get( 'defaults', 'RMSearch' );
        
        $RMExpand = isset($data['RMExpand']) ? $data['RMExpand'] : RM_Registry::get( 'defaults', 'RMExpand' );
        
        $RMLinkHeight = $data['RMLinkHeight'] ? $data['RMLinkHeight'] : RM_Registry::get( 'defaults', 'RMLinkHeight' );

        /* Added in 1.8 */
        
        $RMExternal = isset( $data['RMExternal'] ) ? $data['RMExternal'] : RM_Registry::get( 'defaults', 'RMExternal' );
        
        $RMSide = isset( $data['RMSide'] ) ? $data['RMSide'] : RM_Registry::get( 'defaults', 'RMSide' );

        /* Added in 1.9 */
        
        $RMFooter = isset( $data['RMFooter'] ) ? $data['RMFooter'] : RM_Registry::get( 'defaults', 'RMFooter' );
        
        $RMClickImg = isset( $data['RMClickImg'] ) ? $data['RMClickImg'] : RM_Registry::get( 'defaults', 'RMClickImg' );
        
        $RMMinify = isset( $data['RMMinify'] ) ? $data['RMMinify'] : RM_Registry::get( 'defaults', 'RMMinify' );
        
        $RMClickClose = isset( $data['RMClickClose'] ) ? $data['RMClickClose'] : RM_Registry::get( 'defaults', 'RMClickClose' );
        
        $RMRemImp = isset( $data['RMRemImp'] ) ? $data['RMRemImp'] : RM_Registry::get( 'defaults', 'RMRemImp' ); 

        $RMX = isset( $data['RMX'] ) ? $data['RMX'] : RM_Registry::get( 'defaults', 'RMX' );
        
        $RMMinWidth = isset( $data['RMMinWidth'] ) ? $data['RMMinWidth'] : RM_Registry::get( 'defaults', 'RMMinWidthRM' );

        /* Added in 2.0 */
        
        $RMMaxWidth = isset( $data['RMMaxWidth'] ) ? $data['RMMaxWidth'] : RM_Registry::get( 'defaults', 'RMMaxWidth' );
        
        $RMExpandPar = isset( $data['RMExpandPar'] ) ? $data['RMExpandPar'] : false;
        
        $RMIgnParCli = isset( $data['RMIgnParCli'] ) ? $data['RMIgnParCli'] : RM_Registry::get( 'defaults', 'RMIgnParCli' );
        
        $RMCliToClo = isset( $data['RMCliToClo'] ) ? $data['RMCliToClo'] : RM_Registry::get( 'defaults', 'RMCliToClo' );
        
        $RMSearchPos = isset( $data['RMSearchPos'] ) ? $data['RMSearchPos'] : RM_Registry::get( 'defaults', 'RMSearchPos' );
        
        $RMTitleLink = isset( $data['RMTitleLink'] ) ? $data['RMTitleLink'] : RM_Registry::get( 'defaults', 'RMTitleLink' );
        
        $RMTitleLoc = isset( $data['RMTitleLoc'] ) ? $data['RMTitleLoc'] : RM_Registry::get( 'defaults', 'RMTitleLoc' );
        
        $RMHtml = isset( $data['RMHtml'] ) ? $data['RMHtml'] : RM_Registry::get( 'defaults', 'RMHtml' );
        
        $RMHtmlLoc = isset( $data['RMHtmlLoc'] ) ? $data['RMHtmlLoc'] : RM_Registry::get( 'defaults', 'RMHtmlLoc' );
        
        /* Added in 2.1 */
        
        $RMShortcode = isset( $data['RMShortcode'] ) ? $data['RMShortcode'] : RM_Registry::get( 'defaults', 'RMShortcode' );
        
        
        $optionsArray = array(
            
            // Filter Input Correctly
            
            'RM' => self::Filter($RM),
            
            'RMBreak' => intval($RMBreak),
            
            'RMDepth' => intval($RMDepth),
            
            'RMTop' => intval($RMTop),
            
            'RMRight' => intval($RMRight),
            
            'RMCss' => self::Filter($RMCss),
            
            'RMTitle' => self::Filter($RMTitle),
            
            'RMLineCol' => self::Filter($RMLineCol),
            
            'RMClickBkg' => self::Filter($RMClickBkg),
            
            'RMClickTitle' => self::Filter($RMClickTitle),
            
            'RMBkgTran' => self::Filter($RMBkgTran),
            
            'RMFont' => self::Filter($RMFont),
            
            'RMPos' => self::Filter($RMPos),
            
            'RMImage' => self::Filter($RMImage),
            
            'RMWidth' => intval($RMWidth),
            
            'RMBkg' => self::Filter($RMBkg),
            
            'RMBkgHov' => self::Filter($RMBkgHov),
            
            'RMTitleCol' => self::Filter($RMTitleCol),
            
            'RMTextCol' => self::Filter($RMTextCol),
            
            'RMBorCol' => self::Filter($RMBorCol),
            
            'RMTextColHov' => self::Filter($RMTextColHov),
            
            'RMTitleColHov' => self::Filter($RMTitleColHov),

            /* Added in 1.6 */
            
            'RMAnim' => self::Filter($RMAnim),
            
            'RMPushCSS' => self::Filter($RMPushCSS),
            
            'RMTitleBkg' => self::Filter( $RMTitleBkg ),
            
            'RMFontSize' => intval( $RMFontSize ),
            
            'RMTitleSize' => intval( $RMTitleSize ),
            
            'RMBtnSize' => intval( $RMBtnSize ),
            
            'RMCurBkg' => self::Filter( $RMCurBkg ),
            
            'RMCurCol' => self::Filter( $RMCurCol ),
            
            'RMAnimSpd' => floatval( $RMAnimSpd ),

            /* Added in 1.7 */
            
            'RMTranSpd' => floatval( $RMTranSpd ),
            
            'RMTxtAlign' => self::Filter( $RMTxtAlign ),
            
            'RMSearch' => self::Filter( $RMSearch ),
            
            'RMExpand' => self::Filter( $RMExpand ),    
            
            'RMLinkHeight' => intval( $RMLinkHeight ),

            /* Added in 1.8 */
            
            'RMExternal' => self::Filter( $RMExternal ),
            
            'RMSide' => self::Filter( $RMSide ),

            /* Added in 1.9 */
            
            'RMFooter' => self::Filter( $RMFooter ),    
            
            'RMClickImg' => self::Filter( $RMClickImg ),
            
            'RMMinify' => self::Filter( $RMMinify ),
            
            'RMClickClose' => self::Filter( $RMClickClose ),
            
            'RMRemImp' => self::Filter( $RMRemImp ),
            
            'RMX' => self::Filter( $RMX ),
            
            'RMMinWidth' => intval( $RMMinWidth ),

            /* Added in 2.0 */
            
            'RMMaxWidth' => intval( $RMMaxWidth ),
            
            'RMExpandPar' => self::Filter( $RMExpandPar ),
            
            'RMIgnParCli' => self::Filter( $RMIgnParCli ),
            
            'RMCliToClo' => self::Filter( $RMCliToClo ),
            
            'RMSearchPos' => self::Filter( $RMSearchPos ),
            
            'RMTitleLink' => self::Filter( $RMTitleLink ),
                
            'RMTitleLoc' => self::Filter( $RMTitleLoc ),
            
            'RMHtml' => self::FilterHtml( $RMHtml ),
            
            'RMHtmlLoc' => self::Filter( $RMHtmlLoc ),
            
            /* Added in 2.1 */
            
            'RMShortcode' => self::Filter( $RMShortcode )
            
                
        );

        // Update Submitted Options 
        
        update_option( 'RMOptions', $optionsArray );
            
        // And save back to the registry 

        RM_Status::set( 'updated', __( 'You have successfully updated the Responsive Menu options', 'responsive-menu' ) );
        
        
    }
    
    
}