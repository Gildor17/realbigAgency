<?php

if (!defined("ABSPATH")) {exit;}

if (!class_exists('RBAG_Test')) {
    class RBAG_Test
    {
        public static function checkWidgetPlaces($args) {
            if (!empty($args)&&!empty($args['id'])) {
                if (!in_array($args['id'], $GLOBALS['rbag_globals']['testWidgetPlaces'])) {
                    array_push($GLOBALS['rbag_globals']['testWidgetPlaces'], $args['id']);
                }
            }
        }
    }
}