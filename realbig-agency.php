<?php

if (!defined("ABSPATH")) { exit;}

/*
Plugin name:  Realbig Agency
Description:  Плагин от RealBig.Agency
Version:      0.5.0
Author:       Realbig Team
Author URI:   https://realbig.media
License:      GPLv2 or later
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain:  realbig-agency
Domain Path:  /languages
*/

require_once (ABSPATH."/wp-admin/includes/plugin.php");

include_once (dirname(__FILE__)."/classes/class-rbag-utils.php");
include_once (dirname(__FILE__)."/classes/class-rbag-logs.php");
include_once (dirname(__FILE__)."/classes/class-rbag-caches.php");
include_once (dirname(__FILE__)."/classes/class-rbag-file-actions.php");
include_once (dirname(__FILE__)."/classes/class-rbag-test.php");
include_once (dirname(__FILE__)."/config.php");
include_once (dirname(__FILE__)."/classes/class-rbag-widget.php");
include_once (dirname(__FILE__)."/actions.php");

try {
    register_activation_hook(__FILE__, ['RBAG_Utils','pluginActivated']);
    register_deactivation_hook(__FILE__, ['RBAG_Utils','pluginDeactivated']);
}
catch (Exception $ex) {
    $errorText = "caught error: ".$ex->getMessage();
    RBAG_Logs::saveLogs('errorsLog', $errorText);
    deactivate_plugins(plugin_basename( __FILE__ ));
}
catch (Error $ex) {
    $errorText = "caught error: ".$ex->getMessage();
    RBAG_Logs::saveLogs('errorsLog', $errorText);
    deactivate_plugins(plugin_basename( __FILE__ ));
}