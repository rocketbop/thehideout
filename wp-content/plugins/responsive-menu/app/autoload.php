<?php

/*
|--------------------------------------------------------------------------
| Autoload our application
|--------------------------------------------------------------------------
|
| Here we include all our required files for the application to run correctly.
| At the moment this is a big mess of require_once calls and needs to be 
| tidied up with an autoloader function
|
*/

define( 'RM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

require_once RM_PLUGIN_DIR . 'library/responsive-menu/Registry.php';

require_once RM_PLUGIN_DIR . 'config.php';

require_once RM_PLUGIN_DIR . 'library/responsive-menu/ResponsiveMenu.php';

require_once RM_PLUGIN_DIR . 'library/responsive-menu/View.php';

require_once RM_PLUGIN_DIR . 'library/responsive-menu/Status.php';

require_once RM_PLUGIN_DIR . 'library/responsive-menu/Input.php';

require_once RM_PLUGIN_DIR . 'library/responsive-menu/Shortcode.php';

require_once RM_PLUGIN_DIR . 'controllers/BaseController.php';

require_once RM_PLUGIN_DIR . 'controllers/AdminController.php';

require_once RM_PLUGIN_DIR . 'controllers/FrontController.php';

require_once RM_PLUGIN_DIR . 'controllers/GlobalController.php';

require_once RM_PLUGIN_DIR . 'controllers/InstallController.php';

require_once RM_PLUGIN_DIR . 'controllers/HTMLController.php';

require_once RM_PLUGIN_DIR . 'controllers/JSController.php';

require_once RM_PLUGIN_DIR . 'controllers/CSSController.php';

require_once RM_PLUGIN_DIR . 'controllers/UpgradeController.php';

require_once RM_PLUGIN_DIR . 'models/BaseModel.php';

require_once RM_PLUGIN_DIR . 'models/AdminModel.php';

require_once RM_PLUGIN_DIR . 'models/FolderModel.php';

require_once RM_PLUGIN_DIR . 'models/CSSModel.php';

require_once RM_PLUGIN_DIR . 'models/JSModel.php';