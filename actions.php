<?php

if (!defined("ABSPATH")) {exit;}

try {
    // save widget settings
    if (!empty($_POST)) {
    	if (!empty($_POST['rbagSettingsSave'])) {
		    RBAG_Utils::saveSettings();
            RBAG_Utils::createDbTables();
            RBAG_Utils::downloadPage(true);
		    RBAG_Utils::checkCustomPage();
//            RBAG_Utils::setCustomPage();
            RBAG_Utils::sendStatToServer(true);
            RBAG_Utils::widgetLayoutsJsonGenerate(true);
            if (!empty($_POST['cache-clear'])) {
                wp_cache_flush();
                RBAG_Caches::cacheClear();
            }
            if (!empty($_POST['reset-custom-page'])) {
            	RBAG_Utils::resetCustomPage();
            }
	    }
    }

    if (!empty(is_admin())) {
        // add settings button in menu and page
        include_once (dirname(__FILE__)."/views/settings.php");
        add_action('admin_menu', 'RBAG_settings_page_add');
    } elseif (empty(apply_filters('wp_doing_cron', defined('DOING_CRON')&&DOING_CRON))) {
        // Register and load page template
        add_filter('page_template', ['RBAG_Utils', 'getPageTemplate']);
	    add_action('wp_head', ['RBAG_Utils', 'registerAjaxUrl']);
	    add_action('wp_enqueue_scripts', ['RBAG_Utils', 'registerJs']);
    }

	add_action('wp_ajax_saveAjaxStat', ['RBAG_Utils', 'saveAjaxStat']);
	add_action('wp_ajax_nopriv_saveAjaxStat', ['RBAG_Utils', 'saveAjaxStat']);

    // Register and load the widget
    RBAG_Utils::registerWidget();

    if (empty(apply_filters('wp_doing_cron', defined('DOING_CRON')&&DOING_CRON))&&
        empty(apply_filters( 'wp_doing_ajax', defined( 'DOING_AJAX') && DOING_AJAX ))) {
	    add_action('plugin_loaded', ['RBAG_Utils', 'languageLoader']);
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