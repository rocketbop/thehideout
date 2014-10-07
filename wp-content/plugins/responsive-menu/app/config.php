<?php


/*
|--------------------------------------------------------------------------
| Configuration Settings
|--------------------------------------------------------------------------
|
| Although some people aren't fans of array configurations, here we have one!
| This is where we set paths and our version number among other things.
|
*/

$config = array( 
    
    
    'current_version' => 2.1,
    
    
    'is_beta' => false,
    
    
    'plugins_dir' => plugin_dir_path( __FILE__ ),
        
    
    'plugins_base_uri' => plugin_dir_url( dirname( __FILE__ ) ),
    
    
    'plugin_base_dir' => dirname( plugin_dir_path( __FILE__ ) ),
    
    
    'plugin_base_uri' => plugin_dir_url( dirname( __FILE__ ) ),
    
    
    'plugin_data_uri' => plugin_dir_url( dirname( dirname( __FILE__ ) ) ) . 'responsive-menu-data/',
    
    
    'plugin_data_dir' => dirname( dirname( plugin_dir_path( __FILE__ ) ) ) . '/responsive-menu-data/',
    
    
);


/*
|--------------------------------------------------------------------------
| Save Config to the Registry
|--------------------------------------------------------------------------
|
| Again, some people don't like Registry's in PHP Applications, but here we
| have one and it is very useful for retrieving our settings throughout the app
|
*/

RM_Registry::set( 'config', $config );


/*
|--------------------------------------------------------------------------
| Responsive Menu Defaults
|--------------------------------------------------------------------------
|
| Another configuration array of type, this time we hold all the application
| default options.
|
*/

$defaults = array( 
    
    
    'RM' => '',
    
    
    'RMBreak' => 800,
    
    
    'RMDepth' => 2,
    
    
    'RMTop' => 10,
    
    
    'RMRight' => 5,
    
    
    'RMCss' => '',
    
    
    'RMTitle' => __( 'Menu Title', 'responsive-menu' ),
    
    
    'RMLineCol' => '#FFFFFF',
    
    
    'RMClickBkg' => '#000000',
    
    
    'RMClickTitle' => '',
    
    
    'RMBkgTran' => 'checked',
    
    
    'RMFont' => '',
    
    
    'RMPos' => '',
    
    
    'RMImage' => '',
    
    
    'RMWidth' => '75',
    
    
    'RMBkg' => '#43494C',
    
    
    'RMBkgHov' => '#3C3C3C',
    
    
    'RMTitleCol' => '#FFFFFF',
    
    
    'RMTextCol' => '#FFFFFF',
    
    
    'RMBorCol' => '#3C3C3C',
    
    
    'RMTextColHov' => '#FFFFFF',
    
    
    'RMTitleColHov' => '#FFFFFF',

    
    /* Added in 1.6 */
    
    
    'RMAnim' => 'overlay',
    
    
    'RMPushCSS' => '',
    
    
    'RMTitleBkg' => '#43494C',
    
    
    'RMFontSize' => 13,
    
    
    'RMTitleSize' => 14,
    
    
    'RMBtnSize' => 13,
    
    
    'RMCurBkg' => '#43494C',
    
    
    'RMCurCol' => '#FFFFFF',
    
    
    'RMAnimSpd' => 0.5,

    
    /* Added in 1.7 */
    
    
    'RMTranSpd' => 1,
    
    
    'RMTxtAlign' => 'left',
    
    
    'RMSearch' => false,
    
    
    'RMExpand' => false,
    
    
    'RMLinkHeight' => 20,

    
    /* Added in 1.8 */
    
    
    'RMExternal' => false,
    
    
    'RMSide' => 'left',

    
    /* Added in 1.9 */
    
    
    'RMFooter' => true,
    
    
    'RMClickImg' => false,
    
    
    'RMMinify' => true,
    
    
    'RMClickClose' => false,
    
    
    'RMRemImp' => false,
    
    
    'RMX' => false,
    
    
    'RMMinWidth' => null,

    
    /* Added in 2.0 */
    
    
    'RMMaxWidth' => null,
    
    
    'RMExpandPar' => true,
    
    
    'RMIgnParCli' => false,

    
    'RMCliToClo' => false,
    
    
    'RMSearchPos' => 'below',
    
    
    'RMTitleLink' => null,
    
    
    'RMTitleLoc' => '_self',
    
    
    'RMHtml' => null,
    
    
    'RMHtmlLoc' => 'bottom',
    
    /* Added in 2.1 */
    
    'RMShortcode' => false
    
    
);


/*
|--------------------------------------------------------------------------
| Save Defaults to the Registry
|--------------------------------------------------------------------------
|
| Again, some people don't like Registry's in PHP Applications, but here we
| have it again and it is very useful for retrieving our default values
| throughout the app
|
*/

RM_Registry::set( 'defaults', $defaults );