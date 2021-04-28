<?php

if (!defined("ABSPATH")) {exit;}

try {
    define('RBAG_PLUGIN_PATH', dirname(__FILE__));
    define('RBAG_PLUGIN_URL', plugin_dir_url(__FILE__));
    define('RBAG_AGENCY_DOMAIN', 'https://realbig.agency');
//    define('RBAG_AGENCY_DOMAIN', 'http://rb-agency.web');
    define('RBAG_PLUGIN_DEV_MODE', false);
//    define('RBAG_PLUGIN_DEV_MODE', true);
    define('RBAG_STAT_TABLE_NAME', "rbag_stat");

    RBAG_Logs::generateFilePaths();
    RBAG_Utils::$mediaFolderDir = wp_upload_dir();
//    RBAG_Utils::$customPagePath = RBAG_PLUGIN_PATH.'/views/'.RBAG_Utils::$customPageSlug.'.php';
    RBAG_Utils::$customPagePath = RBAG_Utils::$mediaFolderDir['basedir'].'/'.RBAG_Utils::$customPageSlug.'/'.RBAG_Utils::$customPageSlug.'.php';
//    RBAG_Utils::$customPageUrl = RBAG_PLUGIN_URL.'views/'.RBAG_Utils::$customPageSlug.'.php';
    RBAG_Utils::$customPageUrl = RBAG_Utils::$mediaFolderDir['baseurl'].'/'.RBAG_Utils::$customPageSlug.'/'.RBAG_Utils::$customPageSlug.'.php';
    // initiate plugin's global values
    if (!isset($GLOBALS['rbag_globals'])) {
        $GLOBALS['rbag_globals'] = [];
        $GLOBALS['rbag_globals']['testWidgetPlaces'] = [];
    }
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