<?php
/**
 * Created by PhpStorm.
 * User: furio
 * Date: 2018-11-06
 * Time: 11:10
 */

if (!defined("ABSPATH")) { exit;}

try {
	if (defined('WP_UNINSTALL_PLUGIN')) {
	    RBAG_Utils::removeCustomPage();
    }
}
catch (Exception $ex) {
    deactivate_plugins(plugin_basename( __FILE__ ));
}
catch (Error $ex) {
    deactivate_plugins(plugin_basename( __FILE__ ));
}