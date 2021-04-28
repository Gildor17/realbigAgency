<?php

if (!defined("ABSPATH")) {exit;}

if (!class_exists('RBAG_Utils')) {
    class RBAG_Utils {
        public static $customPageSlug = 'agency-page';
        public static $customPageTitle = 'Realbig Agency';
	    public static $customPageTemplateSlug = 'agency-page-template';
	    public static $customPageTimeoutOptionName = 'rbag_customPageDownloadTimeout';
//	    public static $statServerUrl = 'https://realbig.web/api/wp-agency-get-stat';     // orig web
//	    public static $statServerUrl = 'https://beta.realbig.media/api/wp-agency-get-stat';     // beta
	    public static $statServerUrl = 'https://realbig.media/api/wp-agency-get-stat';     // orig
        public static $sendStatTimeoutOptionName = 'rbag_sendStatTimeout';
        public static $sendStatLastDateOptionName = 'rbag_sendStatLastDate';
        public static $statTokenName = 'rbag_statToken';
        public static $mediaFolderDir;
        public static $customPageUrl;
        public static $customPagePath;
        public static $agencyPagePostIdOptionName = 'rbag_agencyPagePostId';

        public static function widgetLayoutsJsonGenerate($forced=false) {
	        try {
		        $layoutsJson = get_option('rbag_layouts-json');
		        if (empty($layoutsJson)||!empty($forced)) {
			        if (!empty($forced)) {
				        delete_option('rbag_layouts-json');
			        }
			        $layouts = array(
				        1 => [
					        'title' => 'Хотите разместить здесь рекламу?',
					        'buttonText' => 'Обращайтесь',
					        'buttonTextColor' => '#27AE60',
					        'buttonType' => 'shadowed',
					        'image' => 'assets/images/layouts/layout_image_1.png',
				        ],
				        2 => [
					        'title' => 'Разместить рекламу на сайте',
					        'buttonText' => 'Узнать как',
					        'buttonTextColor' => '#27AE60',
					        'buttonType' => 'shadowed',
					        'image' => 'assets/images/layouts/layout_image_2.png',
				        ],
				        3 => [
					        'title' => 'Здесь может быть ваша реклама',
					        'buttonText' => 'Жми',
					        'buttonTextColor' => '#27AE60',
					        'buttonType' => 'shadowed',
					        'image' => 'assets/images/layouts/layout_image_3.png',
				        ],
				        4 => [
					        'title' => 'Разместить рекламу на сайте',
					        'buttonText' => 'Узнать как',
					        'buttonTextColor' => '#27AE60',
					        'buttonType' => 'shadowed',
					        'image' => 'assets/images/layouts/layout_image_4.png',
				        ],
				        5 => [
					        'title' => 'Разместить рекламу на сайте',
					        'buttonText' => 'Узнать как',
					        'buttonTextColor' => '#3761EA',
					        'buttonType' => 'bordered',
					        'image' => '',
				        ],
			        );
			        $layoutsJson = json_encode($layouts);
			        $addingResult = add_option('rbag_layouts-json', $layoutsJson);
			        if (!empty($addingResult)) {
				        return $layoutsJson;
			        }
		        } else {
			        return $layoutsJson;
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        return false;
        }

        public static function getWidgetStyle($layout, $bonusClass = '') {
	        try {
		        $result = '<style>'
                          .'.widget_rbag_widget {'
		                  .'box-shadow: 0px 9px 28px 8px rgba(103, 119, 134, 0.05), 0px 6px 16px rgba(103, 119, 134, 0.08), 0px 3px 6px -4px rgba(103, 119, 134, 0.12) !important;'
		                  .'width: auto !important;'
						  .'}'
						  .'.footer-wrapper .widget_rbag_widget, .footer-widget.widget_rbag_widget {'
		                  .'background-color: transparent !important;'
		                  .'padding: 0px !important;'
		                  .'box-shadow: none !important;'
		                  .'width: auto !important;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget:not(.rbag-footer-link) {'
		                  .'display: flex;'
		                  .'flex-direction: column;'
		                  .'overflow: hidden;'
		                  .'background: #FFFFFF;'
		                  .'border-radius: 10px;'
		                  .'color: black;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget .section-header {'
		                  .'background-color: transparent;'
		                  .'padding: 0;'
		                  .'border: 0;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget .widget-title, '.$bonusClass.'.rbag-widget .widget-header, '.$bonusClass.'.rbag-widget .sidebar-widget-title {'
		                  .'color: black !important;'
		                  .'margin: 15px !important;'
		                  .'font-style: normal;'
		                  .'font-weight: 600;'
		                  .'font-size: 18px;'
		                  .'line-height: 23px;'
		                  .'background: white;'
		                  .'padding: 0 !important;'
		                  .'text-align: left;'
		                  .'text-transform: none;'
		                  .'border: none !important;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget .widget-title:before, '.$bonusClass.'.rbag-widget .widget-title:after {'
		                  .'display: none !important;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget .rbag-widget-image {'
		                  .'width: 100%;'
		                  .'display: block;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget:not(.rbag-footer-link) .rbag-widget-button1 {'
		                  .'margin: 15px !important;'
		                  .'margin-top: 0px !important;'
		                  .'font-weight: 600;'
		                  .'text-decoration: none;'
		                  .'line-height: 29px;'
		                  .'background: #FFFFFF;'
		                  .'border-radius: 5px;'
		                  .'outline: 0;'
		                  .'border: 0;'
		                  .'min-height: 40px;'
		                  .'padding: 0;'
		                  .'color: '.$layout['buttonTextColor'].';'
		                  .'display: block;'
		                  .'transition: .2s;'
		                  .'text-shadow: none;'
		                  .'cursor: pointer;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget:not(.rbag-footer-link) .rbag-widget-button1.rbag-widget-button-bordered {'
		                  .'border: 1px solid #3761EA;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget:not(.rbag-footer-link) .rbag-widget-button1.rbag-widget-button-shadowed {'
		                  .'box-shadow: 0px 0px 10px rgba(205, 212, 222, 0.5);'
		                  .'white-space: nowrap;'
		                  .'}'
		                  .$bonusClass.'.rbag-widget:not(.rbag-footer-link) .rbag-widget-button1:hover {'
		                  .'background: '.$layout['buttonTextColor'].';'
		                  .'color: #ffffff;'
		                  .'}'
		                  .'</style>';

		        return $result;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
            return '';
        }

        public static function getWidgetLayouts() {
	        $layouts = null;
	        try {
		        $layoutsJson = get_option('rbag_layouts-json');
		        if (empty($layoutsJson)) {
			        $layoutsJson = self::widgetLayoutsJsonGenerate();
		        }
		        if (!empty($layoutsJson)) {
			        if (is_array($layoutsJson)) {
				        $layouts = $layoutsJson;
			        } else {
				        $layouts = json_decode($layoutsJson, true);
			        }
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return $layouts;
        }

        public static function getWpPrefix() {
	        $wpPrefix = '';
	        try {
		        if (!empty($GLOBALS['wpPrefix'])) {
			        $wpPrefix = $GLOBALS['wpPrefix'];
		        } elseif (!empty($GLOBALS['table_prefix'])) {
			        $wpPrefix = $GLOBALS['table_prefix'];
		        }

		        if (empty($wpPrefix)) {
			        $errorText = "wpdb prefix missing";
			        RBAG_Logs::saveLogs('errorsLog', $errorText);
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return $wpPrefix;
        }

        public static function fileGenerator($pathToFile) {
	        try {
		        $fileExists = file_exists($pathToFile);
		        if (empty($fileExists)) {
			        $createdFile = fopen($pathToFile, 'w');
			        fclose($createdFile);

			        $fileExists = file_exists($pathToFile);
			        if (empty($fileExists)) {
				        $errorText = basename($pathToFile)." file generation error";
				        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        }
		        }
		        return $fileExists;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function checkFileContent($path) {
	        try {
		        $fileExists = file_exists($path);
		        if (!empty($fileExists)) {
			        $fileContent = file_get_contents($path);
			        if (!empty($fileContent)) {
				        return true;
			        }
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function pluginActivated() {
	        try {
		        self::languageLoader();
		        RBAG_Logs::generateFilePaths();
		        self::createDbTables();
		        self::widgetLayoutsJsonGenerate();
		        self::downloadPage();
		        self::setCustomPage();
		        self::sendStatToServer();
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function pluginDeactivated() {
            // here
        }

        public static function getDefaultSettings() {
            $settings = [
                'enabledWidget' => false,
                'cacheClear' => 'checked',
                'widgetLayout' => 1,
            ];
            return $settings;
        }

        public static function saveSettings() {
	        try {
		        $settings = get_option('rbag_settings');
		        if (!empty($settings)&&!is_array($settings)&&is_string($settings)) {
			        $settings = json_decode($settings, true);
		        }
		        if (empty($settings)) {
			        $newSettings = true;
			        $settings = self::getDefaultSettings();
		        }

		        if (!empty($_POST['widget-layout'])) {
			        $settings['widgetLayout'] = intval($_POST['widget-layout']);
			        if ($settings['widgetLayout'] < 1) {
				        $settings['widgetLayout'] = 1;
			        }
		        }
		        if (!empty($_POST['enabled-widget'])) {
			        $settings['enabledWidget'] = true;
		        } else {
			        $settings['enabledWidget'] = false;
		        }
		        if (!empty($_POST['cache-clear'])) {
			        $settings['cacheClear'] = true;
		        } else {
			        $settings['cacheClear'] = false;
		        }
		        $settings = json_encode($settings);
		        if (!empty($newSettings)) {
			        add_option('rbag_settings', $settings);
		        } else {
			        update_option('rbag_settings', $settings);
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
            return false;
        }

        public static function getSettings() {
	        try {
		        if (!empty($GLOBALS['rbag_globals']['settings'])) {
			        $settings = $GLOBALS['rbag_globals']['settings'];
		        } else {
			        $settingsJson = get_option('rbag_settings');
			        if (!empty($settingsJson)) {
				        if (is_string($settingsJson)) {
					        $settingsJson = json_decode($settingsJson, true);
					        if (is_array($settingsJson)) {
						        $settings = $settingsJson;
					        }
				        } elseif (is_array($settingsJson)) {
					        $settings = $settingsJson;
				        }
			        }
		        }

		        if (empty($settings)) {
			        $settings = self::getDefaultSettings();
		        }

		        return $settings;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function registerWidget() {
	        try {
		        $settings = self::getSettings();
		        if (is_array($settings)&&!empty($settings['enabledWidget'])) {
			        add_action('widgets_init', 'rbag_load_widget');
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function getPageTemplate($page_template) {
	        try {
		        if (is_page(self::$customPageSlug)) {
			        $agencyPageContent = self::checkFileContent(self::$customPagePath);
			        if (!empty($agencyPageContent)) {
				        $page_template = RBAG_PLUGIN_PATH.'/views/'.self::$customPageTemplateSlug.'.php';
			        }
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return $page_template;
        }

        public static function getCustomPage() {
            $customPage = null;
	        try {
//		        $customPage = get_page_by_path(self::$customPageSlug);
//		        $customPage = get_page_by_title(self::$customPageTitle);
                $agencyPagePostId = get_option(self::$agencyPagePostIdOptionName);
                if (!empty($agencyPagePostId)) {
                    $customPage = get_post($agencyPagePostId);
                }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return $customPage;
        }

        public static function checkCustomPage() {
	        try {
		        $customPage = self::getCustomPage();
		        if (!empty($customPage)) {
		            $guid = $customPage->guid;
		            if (empty($guid)||
                        (get_option('permalink_structure')&&strpos($guid, '/?')!=false)||
                        ((!get_option('permalink_structure'))&&strpos($guid, '/?')==false))
		            {
		                self::resetCustomPage();
                    }
                } else {
		            self::setCustomPage();
                }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function resetCustomPage() {
	        try {
		        $deleteResult = self::removeCustomPage();
		        if (!empty($deleteResult)) {
			        self::setCustomPage();
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function removeCustomPage() {
	        $result = null;
	        try {
		        $customPage = get_page_by_title(self::$customPageTitle);
                $customPageOptionId = get_option(self::$agencyPagePostIdOptionName);
		        while (!empty($customPage)) {
			        if (!empty($customPage)) {
				        $result = wp_delete_post($customPage->ID, true);
			        }
			        $customPage = get_page_by_title(self::$customPageTitle);
			        if (empty($customPage)) {
                        $customPage = get_page_by_path(self::$customPageSlug);
                        if (empty($customPage)&&!empty($customPageOptionId)) {
                            $customPage = get_post($customPageOptionId);
                        }
                    }
                }
                delete_option(self::$agencyPagePostIdOptionName);
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return $result;
        }

        public static function setCustomPage() {
	        try {
		        $customPage = self::getCustomPage();
		        $agencyPageContent = self::checkFileContent(self::$customPagePath);
		        if (empty($customPage)&&!empty($agencyPageContent)) {
			        $post_details = array(
				        'post_title'    => self::$customPageTitle,
				        'post_content'  => '',
				        'post_status'   => 'publish',
				        'post_author'   => 1,
				        'post_type' => 'page',
				        'post_name' => self::$customPageSlug
			        );
			        require_once(ABSPATH."/wp-includes/pluggable.php");
			        if (empty($GLOBALS['wp_rewrite'])) {
				        $GLOBALS['wp_rewrite'] = new WP_Rewrite();
			        }
			        $insertResult = wp_insert_post($post_details);
			        if (is_wp_error($insertResult)) {
				        $errorText = "custom page db save error: ".$insertResult->get_error_message();
				        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        } elseif (!empty($insertResult)&&is_integer($insertResult)) {
                        delete_option(self::$agencyPagePostIdOptionName);
			            add_option(self::$agencyPagePostIdOptionName, $insertResult);
                    }
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function saveAjaxStat($tunnelData) {
	        try {
		        if (!empty($_POST['type'])&&$_POST['type']=='saveStat'&&!empty($_POST['data'])) {
			        global $wpdb;
			        $wpPrefix = self::getWpPrefix();
			        $data = wp_kses($_POST['data'], []);
//			        $data = $_POST['data'];
			        $data = preg_replace("~\\\'~", "'", $data);
			        $data = preg_replace('~\\\"~', '"', $data);
			        $data = json_decode($data);
			        if (!is_object($data)||empty($data->name)) {
				        return false;
			        }
			        $date = date('Y-m-d');
			        $name = sanitize_text_field($data->name);
			        $value = 1;

			        $checkStatTable = $wpdb->get_var('SHOW TABLES LIKE "'.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).'"');
			        if (empty($checkStatTable)) {
				        return false;
			        }

			        $queryString = $wpdb->prepare('SELECT * FROM '.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).' RS WHERE RS.`name` = %s AND RS.`date` = %s', [ $name, $date]);
			        $checkLine = $wpdb->get_row($queryString, ARRAY_A);
			        if (empty($checkLine)) {
				        $rowChangeResult = $wpdb->insert(esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME), ['name' => $name, 'count' => $value, 'date' => $date]);
			        } else {
				        $value = intval($checkLine['count'])+1;
				        $rowChangeResult = $wpdb->update(esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME), ['count' => $value], ['id' => $checkLine['id']]);
			        }
			        if (!empty($rowChangeResult)) {
				        $tunnelData = 'saved';
			        }
		        }
		        wp_die($tunnelData);
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

        	return false;
        }

        public static function downloadPage($forced = false) {
	        try {
		        $pathToFile = self::$customPagePath;
		        $downloadTimeout = get_transient(self::$customPageTimeoutOptionName);
                $customFolderPath = self::$mediaFolderDir['basedir'].'/'.self::$customPageSlug.'/';
                if (!file_exists($customFolderPath)) {
                    mkdir($customFolderPath, 0750, true);
                }
		        $pageFileExists = file_exists($pathToFile);

		        if (!empty($forced) || empty($pageFileExists) || empty($downloadTimeout)) {
			        if (!empty(RBAG_AGENCY_DOMAIN)) {
				        $pathAgencyPage = RBAG_AGENCY_DOMAIN.'/'.self::$customPageSlug.'.html';
			        } else {
				        $pathAgencyPage = RBAG_PLUGIN_PATH.'/views/'.self::$customPageTemplateSlug.'.php';
			        }

			        $agencyPageExists = @get_headers($pathAgencyPage);
			        if(empty($agencyPageExists) || empty($agencyPageExists[0]) || $agencyPageExists[0] == 'HTTP/1.1 404 Not Found') {
				        return false;
			        }

			        $pageFile = fopen($pathToFile, 'w');
			        if ($pageFile!==false) {
				        try {
					        $agencyPageContent = file_get_contents($pathAgencyPage);
				        }  catch (Exception $ex) {
					        $fileGetContentError = $ex;
				        } catch (Error $ex) {
					        $fileGetContentError = $ex;
				        }

				        if (!empty($agencyPageContent)) {
//					        $imageFolderPath = RBAG_PLUGIN_PATH.'/assets/images/custom-page/';
					        $imageFolderPath = $customFolderPath.'images/';
					        if (!file_exists($imageFolderPath)) {
						        mkdir($imageFolderPath, 0750, true);
					        }
//					        $imageFolderUrl = RBAG_PLUGIN_URL.'assets/images/custom-page';
                            $imageFolderUrl = self::$mediaFolderDir['baseurl'].'/'.self::$customPageSlug.'/images/';
                            $imageSaver = new RBAG_FileActions($imageFolderPath, $imageFolderUrl, 'images', RBAG_FileActions::PURPOSE_CUSTOM_PAGE);
					        $agencyPageContent = $imageSaver->image_search($agencyPageContent);
					        $fileSaveResult = file_put_contents($pathToFile, $agencyPageContent);
					        if (!empty($fileSaveResult)) {
						        set_transient(self::$customPageTimeoutOptionName, 'exists', (60*60*24));
					        }
				        }
				        fclose($pageFile);
				        unset($pageFile);
			        } else {
				        $errorText = "custom page file problem";
				        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        }
		        }

		        return true;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function registerJs() {
	        try {
		        $pluginVersion = self::getPluginVersion();

		        wp_enqueue_script(
			        'js-functions',
			        RBAG_PLUGIN_URL.'assets/js/js-functions.js',
			        array('jquery'),
			        $pluginVersion
		        );
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function registerAjaxUrl() {
	        try {
		        $ajaxurl = admin_url('admin-ajax.php');
		        ?><script>if (typeof rbag_ajaxurl==='undefined') {var rbag_ajaxurl = '<?php echo $ajaxurl ?>';}</script><?php
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function getPluginVersion() {
	        $plugin_version = false;
	        try {
		        $plugin_data = get_plugin_data(RBAG_PLUGIN_PATH.'/realbig-agency.php');
		        if (!empty($plugin_data)&&!empty($plugin_data['Version'])) {
			        $plugin_version = $plugin_data['Version'];
		        }
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return $plugin_version;
        }

        public static function createDbTables() {
	        try {
		        global $wpdb;
		        $wpPrefix = self::getWpPrefix();

		        if (empty($wpdb)) {
			        $errorText = "global wpdb missing";
			        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        return false;
		        }

		        $checkStatTable = $wpdb->get_var('SHOW TABLES LIKE "'.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).'"');
		        if (empty($checkStatTable)) {
			        $createStatTableResult = self::createStatTable($wpdb);
			        if (empty($createStatTableResult)) {
				        $errorText = "stat table creation error";
				        RBAG_Logs::saveLogs('errorsLog', $errorText);
				        return false;
			        }
		        }

		        return true;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function createStatTable($wpdb) {
	        $wpPrefix = self::getWpPrefix();

	        try {
	            if (empty($wpPrefix)) {
	                return false;
	            }

		        require_once (ABSPATH."/wp-admin/includes/upgrade.php");
	            $createQuery =
"CREATE TABLE `".esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME)."` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8mb4_general_ci',
	`count` INT(10) NOT NULL,
	`date` DATE NOT NULL,
	PRIMARY KEY (`id`) USING BTREE
)
COLLATE='utf8mb4_general_ci'
ENGINE=InnoDB;";

		        $tableCreateResult = dbDelta($createQuery, true);
		        if (!empty($tableCreateResult)) {
		            return true;
		        }
            }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

        public static function getStatToken() {
	        try {
		        $statToken = get_option(self::$statTokenName);
		        if (empty($statToken)) {
			        $tokenLength = 32;
			        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			        $charactersLength = strlen($characters);
			        $statToken = '';
			        for ($i = 0; $i < $tokenLength; $i++) {
				        $statToken .= $characters[rand(0, $charactersLength - 1)];
			        }
			        add_option(self::$statTokenName, $statToken);
		        }

		        return $statToken;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

            return false;
        }

		public static function sendStatAfteraction($prevDate, $transient = true, $option = true) {
			try {
				if (!empty($transient)) {
					$summaryTime = time()+(60*60*6);
//	            $today = new DateTime('now');
//	            $tomorrow = new DateTime('tomorrow');
//	            $timeDif = $today->diff($tomorrow);
//	            $summaryTime = 0;
//	            $summaryTime = $summaryTime + $timeDif->s;
//	            $summaryTime = $summaryTime + ($timeDif->i * 60);
//	            $summaryTime = $summaryTime + ($timeDif->h * 60 * 60);
					set_transient(self::$sendStatTimeoutOptionName, 'sended', $summaryTime);
				}
				if (!empty($option)) {
                    $optionExists = get_option(self::$sendStatLastDateOptionName);
					if (empty($optionExists)) {
					    update_option(self::$sendStatLastDateOptionName, $prevDate);
					} else {
						add_option(self::$sendStatLastDateOptionName, $prevDate);
					}
				}

				return true;
			}
			catch (Exception $ex) {
				$errorText = __FUNCTION__." error: ".$ex->getMessage();
				RBAG_Logs::saveLogs('errorsLog', $errorText);
			}
			catch (Error $ex) {
				$errorText = __FUNCTION__." error: ".$ex->getMessage();
				RBAG_Logs::saveLogs('errorsLog', $errorText);
			}

            return false;
		}

        public static function sendStatToServer($forced = false) {
	        try {
		        $dateFormat = 'Y-m-d';
		        $curDate = date($dateFormat);
		        $prevDate = date($dateFormat, strtotime($curDate.' -1 days'));
//		        $statSendLastDate = get_option(self::$sendStatLastDateOptionName);
		        if (empty($forced)) {
			        $sendTimeout = get_transient(self::$sendStatTimeoutOptionName);
			        if (!empty($sendTimeout)) {
				        return false;
			        }
			        $statSendLastDate = get_option(self::$sendStatLastDateOptionName);
			        if (!empty($statSendLastDate)) {
				        if ($prevDate==$statSendLastDate) {
					        self::sendStatAfteraction($prevDate, true, false);
					        return false;
				        }
			        }
		        }

		        global $wpdb;
		        $wpPrefix = self::getWpPrefix();
		        $tablesCreated = self::createDbTables();
		        if (empty($tablesCreated)) {
                    return false;
                }
		        if (!empty($statSendLastDate)) {
			        $prevDateQuery =  date($dateFormat, strtotime($statSendLastDate.' -1 days'));
//			        $query = $wpdb->prepare('SELECT * FROM '.$wpPrefix.'rbag_stat WRS WHERE WRS.`date` > %s AND WRS.`date` < %s', [$prevDateQuery, $curDate]);
//			        $query = $wpdb->prepare('SELECT * FROM %s WRS WHERE WRS.`date` > %s', [$wpPrefix.RBAG_STAT_TABLE_NAME, $prevDateQuery]);
			        $query = $wpdb->prepare('SELECT * FROM `'.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).'` WRS WHERE WRS.`date` > %s', [$prevDateQuery]);
		        } else {
//			        $query = $wpdb->prepare('SELECT * FROM '.$wpPrefix.'rbag_stat WRS WHERE WRS.`date` < %s', [$curDate]);
			        $query = $wpdb->prepare('SELECT * FROM `'.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).'` WRS', []);
		        }
//		        $query = esc_sql($query);
		        $stat = $wpdb->get_results($query, ARRAY_A);

		        if (empty($stat)) {
			        self::sendStatAfteraction($prevDate, true, false);
			        return false;
		        }

		        $statToken = self::getStatToken();

		        if (!empty($_SERVER['HTTP_HOST'])) {
			        $urlData = $_SERVER['HTTP_HOST'];
		        } elseif (!empty($_SERVER['SERVER_NAME'])) {
			        $urlData = $_SERVER['SERVER_NAME'];
		        } else {
			        $urlData = 'empty';
		        }

		        $dataForSending = [
			        'body'  => [
				        'urlData'   => $urlData,
				        'stat' => json_encode($stat),
                        'statToken' => $statToken
			        ]
		        ];

		        $requestResult= wp_safe_remote_post(self::$statServerUrl, $dataForSending);
//				$requestResult = wp_remote_post(self::$statServerUrl, $dataForSending);

                if (!empty($requestResult)
                    &&!empty($requestResult['response'])
                    &&!empty($requestResult['response']['code'])
                    &&$requestResult['response']['code']==200
                    &&!empty($requestResult['body'])
                ) {
	                $requestResultBody = json_decode($requestResult['body'],true);
	                if (!empty($requestResultBody)&&!empty($requestResultBody['status'])&&$requestResultBody['status']=='success') {
		                self::sendStatAfteraction($prevDate);
	                }
                } else {
                    $errorText = "send stat requers problem";
                    RBAG_Logs::saveLogs('errorsLog', $errorText);
                }

		        return true;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }

        public static function languageLoader() {
	        try {
		        $result = load_plugin_textdomain( 'realbig-agency', false, plugin_basename(RBAG_PLUGIN_PATH) . '/languages/' );
		        return $result;
	        }
	        catch (Exception $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = __FUNCTION__." error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }

	        return false;
        }
    }
}