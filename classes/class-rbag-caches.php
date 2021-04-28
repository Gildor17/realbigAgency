<?php

if (!defined("ABSPATH")) {exit;}

if (!class_exists('RBAG_Caches')) {
    class RBAG_Caches {
        private static $pluginList;

        public static function cacheClear() {
            $allowCacheClear = get_option('rb_cacheClearAllow');
            if (!empty($allowCacheClear)&&$allowCacheClear=='enabled') {
                self::$pluginList = self::getCachePluginList();
                if (!empty(self::$pluginList)) {
                    foreach (self::$pluginList as $item) {
                        try {
                            self::$item();
                        } catch (Exception $ex) {
                            $messageFLog = 'Some error in RFWP_Caches->cacheClear : '.$ex->getMessage().';';
                            RBAG_Logs::saveLogs('errorsLog', $messageFLog);
                        } catch (Error $er) {
                            $messageFLog = 'Some error in RFWP_Caches->cacheClear : '.$er->getMessage().';';
                            RBAG_Logs::saveLogs('errorsLog', $messageFLog);
                        }
                    }
                    unset($item);
                }
            }
        }

        private static function getCachePluginList() {
            $list = [
                'autoptimizeCacheClear',
                'wpSuperCacheCacheClear',
                'wpFastestCacheCacheClear',
                'w3TotalCacheCacheClear',
                'liteSpeedCacheCacheClear',
            ];
            return $list;
        }

        /** Function for cache plugins */
        public static function autoptimizeCacheClearExecute() {
            if (class_exists('autoptimizeCache')&&method_exists(autoptimizeCache::class, 'clearall')) {
                autoptimizeCache::clearall();
                if (empty(apply_filters('wp_doing_cron',defined('DOING_CRON')&&DOING_CRON))) {
                    header("Refresh:0");  # Refresh the page so that autoptimize can create new cache files and it does breaks the page after clearall.
                }
            }
        }

        private static function autoptimizeCacheClear() {
            add_action('plugins_loaded', array(get_called_class(), 'autoptimizeCacheClearExecute'));
            return true;
        }

        public static function wpSuperCacheCacheClearExecute() {
            if (function_exists('wp_cache_clean_cache')) {
                wp_cache_clear_cache();
            }
        }

        private static function wpSuperCacheCacheClear() {
            add_action('plugins_loaded', array(get_called_class(), 'wpSuperCacheCacheClearExecute'));
            return true;
        }

        public static function wpFastestCacheCacheClearExecute() {
            if (class_exists('WpFastestCache')&&method_exists(WpFastestCache::class, 'deleteCache')) {
                $wpfc = new WpFastestCache();
                $wpfc->deleteCache();
            }
        }

        private static function wpFastestCacheCacheClear() {
            add_action('plugins_loaded', array(get_called_class(), 'wpFastestCacheCacheClearExecute'));
            return true;
        }

        public static function w3TotalCacheCacheClearExecute() {
            if (function_exists('w3tc_flush_all')) {
                w3tc_flush_all();
            }
        }

        private static function w3TotalCacheCacheClear() {
            add_action('plugins_loaded', array(get_called_class(), 'w3TotalCacheCacheClearExecute'));
            return true;
        }

        public static function liteSpeedCacheCacheClearExecute() {
            do_action('litespeed_purge_all');
        }

        private static function liteSpeedCacheCacheClear() {
            add_action('plugins_loaded', array(get_called_class(), 'liteSpeedCacheCacheClearExecute'));
            return true;
        }
        /** End of Function for cache plugins */
    }
}