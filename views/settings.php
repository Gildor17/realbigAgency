<?php

if (!defined("ABSPATH")) {exit;}

try {
    if (!function_exists('RBAG_settings_page_add')) {
        function RBAG_settings_page_add() {
            if (strpos($_SERVER['REQUEST_URI'], 'page='.basename(RBAG_PLUGIN_PATH))) {
                $iconUrl = RBAG_PLUGIN_URL.'assets/images/settings_icon_active.svg';
            } else {
                $iconUrl = RBAG_PLUGIN_URL.'assets/images/settings_icon.svg';
            }

            add_menu_page('Settings page', 'RB Agency', 'administrator', __FILE__, 'RBAG_settings_page', $iconUrl);
        }
    }

    if (!function_exists('RBAG_settings_page')) {
        function RBAG_settings_page () {
            try {
	            global $wpdb;
	            $wpPrefix = RBAG_Utils::getWpPrefix();
                $settings = RBAG_Utils::getSettings();
                $finalisedSettings = RBAG_Utils::getDefaultSettings();
                $layouts = RBAG_Utils::getWidgetLayouts();
                $checkStatDbTable = $wpdb->get_var('SHOW TABLES LIKE "'.esc_sql($wpPrefix.RBAG_STAT_TABLE_NAME).'"');

                if (!empty($settings)) {
                    foreach ($settings as $k => $item) {
                        switch ($k) {
                            case 'enabledWidget':
                                if (!empty($item)) {
                                    $finalisedSettings['enabledWidget'] = 'checked';
                                } else {
                                    $finalisedSettings['enabledWidget'] = '';
                                }
                                break;
                            case 'widgetLayout':
                                $finalisedSettings['widgetLayout'] = $item;
                                break;
                            case 'cacheClear':
                                if (!empty($item)) {
                                    $finalisedSettings['cacheClear'] = 'checked';
                                } else {
                                    $finalisedSettings['cacheClear'] = '';
                                }
                                break;
                        }
                    } unset($k,$item);
                }

                ?>
                <h1><?php echo esc_html(__('Settings', 'realbig-agency')) ?></h1>
                <style>
                    .separated-blocks {
                        display: inline-table;
                        margin-right:10px;
                        /*border: 1px solid black;*/
                    }
                    .element-separator {
                        margin: 10px 0;
                    }
                    .success-text-block {
                        color: green;
                    }
                    .fail-text-block {
                        color: red;
                    }
                    .rbag-widget-container {
                        margin: 10px;
                        white-space: normal;
                        max-width: 243px;
                        display: flex;
                    }
                    .rbag-widget-label {
                        margin-top: 5px;
                    }
                </style>
                <div class="wrap">
                    <div class="separated-blocks">
                        <form method="post" name="settings_form" id="settings_form_id">
                            <div class="element-separator">
                                <label for="enabled-widget_id"><?php echo esc_html(__('Enable widget', 'realbig-agency')) ?></label>
                                <input type="checkbox" name="enabled-widget" id="enabled-widget_id" <?php echo $finalisedSettings['enabledWidget']; ?>>
                            </div>
                            <div class="element-separator">
                                <h3><?php echo esc_html(__('Choose widget layout', 'realbig-agency')) ?></h3>
                            </div>
                            <?php if (!empty($layouts)): ?>
                                <div class="element-separator" style="display: flex; flex-wrap: wrap; margin: -5px;white-space: nowrap;">
                                    <?php foreach ($layouts as $k => $item): ?>
                                        <div class="rbag-widget-container">
                                            <?php if ($finalisedSettings['widgetLayout']==$k): ?>
                                                <input type="radio" name="widget-layout" id="widget-layout-<?php echo $k; ?>" value="<?php echo $k; ?>" checked>
                                            <?php else: ?>
                                                <input type="radio" name="widget-layout" id="widget-layout-<?php echo $k; ?>" value="<?php echo $k; ?>">
                                            <?php endif; ?>
                                            <label class="rbag-widget-label" for="widget-layout-<?php echo $k; ?>">
                                                <?php echo RBAG_Widget::constructWidget($item, null, null, true, $k); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; unset($k,$item);?>
                                </div>
                            <?php endif; ?>
                            <div class="element-separator">
                                <label for="cache-clear"><?php echo esc_html(__('Clear cache', 'realbig-agency')) ?></label>
                                <input type="checkbox" name="cache-clear" id="cache-clear_id" <?php echo $finalisedSettings['cacheClear'] ?>>
                            </div>
                            <div class="element-separator">
                                <label for="reset-custom-page"><?php echo esc_html(__('Re-create Agency Page', 'realbig-agency')) ?></label>
                                <input type="checkbox" name="reset-custom-page" id="reset-custom-page_id">
                            </div>
                            <div class="element-separator"></div>
                            <?php submit_button( esc_html(__('Save settings', 'realbig-agency')), 'primary', 'rbagSettingsSave'); ?>
                            <div class="element-separator"></div>
	                        <?php if (empty($checkStatDbTable)): ?>
                                <div class="fail-text-block">Stat table not exists</div>
	                        <?php endif; ?>
                        </form>
                    </div>
                </div>
                <?php
            }
            catch (Exception $ex) {}
            catch (Error $ex) {}
        }
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