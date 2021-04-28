<?php

if (!defined("ABSPATH")) {exit;}

if (!class_exists('RBAG_Widget')) {
    class RBAG_Widget extends WP_Widget
    {
        private $layout;
        private $pageUrl;
// The construct part
        function __construct() {
            parent::__construct(
                'rbag_widget',
                'RB Agency Widget',
                ['description' => 'RB Agency widget']
            );
        }

        // Creating widget front-end
        public function widget($args, $instance) {
	        try {
		        $layouts = RBAG_Utils::getWidgetLayouts();
		        $settings = RBAG_Utils::getSettings();

		        if (!empty(RBAG_PLUGIN_DEV_MODE)) {
			        RBAG_Test::checkWidgetPlaces($args);
		        }

		        if (!empty($settings['widgetLayout'])&&isset($layouts[intval($settings['widgetLayout'])])) {
			        $this->layout = $layouts[intval($settings['widgetLayout'])];
		        } else {
			        $this->layout = $layouts[1];
		        }

		        if (empty($this->layout)) {
			        $errorText = "empty widget layout";
			        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        return false;
		        }

		        if (!empty(is_page(RBAG_Utils::$customPageSlug))) {
			        return false;
		        }

		        $agencyPage = RBAG_Utils::getCustomPage();
		        if (empty($agencyPage)) {
			        $errorText = "empty custom page in db";
			        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        return false;
		        }
		        $this->pageUrl = $agencyPage->guid;

		        $agencyPageFile = RBAG_Utils::checkFileContent(RBAG_Utils::$customPagePath);
		        if (empty($agencyPageFile)) {
			        $errorText = "empty custom page";
			        RBAG_Logs::saveLogs('errorsLog', $errorText);
			        return false;
		        }

		        $title = $this->layout['title'];

		        echo $args['before_widget'];
		        if (!empty($args)&&!empty($args['id'])&&strpos($args['id'], 'sidebar')!==false) {
			        $widget = self::constructWidget($this->layout, $args, $this->pageUrl);
			        echo $widget;
		        } else {
			        $widget = '<style>'
			                 .'.rbag-span-link {'
			                 .'cursor: pointer;'
			                 .'transition: .2s;'
			                 .'}'
			                 .'.rbag-span-link:hover {'
			                 .'text-decoration: underline;'
			                 .'}'
			                 .'</style>';
//			        echo $style;
			        $widget .= '<div class="rbag-widget rbag-footer-link">';
			        if (!empty($title)) {
				        $widget .= '<span onclick="rbagWidgetButtonClicked();" data-href="'.$this->pageUrl.'" class="rbag-widget-button1 rbag-span-link">'.$title.'</span>';
			        } else {
				        $widget .= '<span onclick="rbagWidgetButtonClicked();" data-href="'.$this->pageUrl.'" class="rbag-widget-button1 rbag-span-link">'.$this->layout['buttonText'].'</span>';
			        }
			        $widget .= '</div>';
			        echo $widget;
		        }
		        echo $args['after_widget'];

		        return true;
            }
	        catch (Exception $ex) {
		        $errorText = "widget show error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = "widget show error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        return false;
        }

        public static function constructWidget($layout, $args = null, $pageUrl = '', $preview = false, $wCounter = null) {
	        try {
		        $widget = '';
		        if (!empty($preview)&&!empty($wCounter)) {
			        $bonusClass = 'widget-preview-'.$wCounter;
		        }

		        if (!empty($layout['image'])) {
			        $topImagePath = RBAG_PLUGIN_PATH.'/'.$layout['image'];
			        if (file_exists($topImagePath)) {
				        $topImageUrl = RBAG_PLUGIN_URL.$layout['image'];
			        }

			        $topImageAltPath = RBAG_PLUGIN_PATH.'/assets/images/layout_image_default.jpg';
			        if (file_exists($topImageAltPath)) {
				        $topImageAltUrl = RBAG_PLUGIN_URL.'assets/images/layout_image_default.jpg';
			        } else {
				        $topImageAltUrl = '';
			        }
		        }

		        if (!empty($bonusClass)) {
			        $widgetStyle = RBAG_Utils::getWidgetStyle($layout, '.'.$bonusClass);
		        } else {
			        $widgetStyle = RBAG_Utils::getWidgetStyle($layout);
		        }
		        // before and after widget arguments are defined by themes
		        $widget .= $widgetStyle;
		        if (!empty($bonusClass)) {
			        $widget .= '<div class="rbag-widget '.$bonusClass.'">';
		        } else {
			        $widget .= '<div class="rbag-widget">';
		        }
		        if (!empty($topImageUrl)&&!empty($topImageAltUrl)) {
			        $image = '<img class="rbag-widget-image" alt="'.$topImageAltUrl.'" src="'.$topImageUrl.'">';
			        $widget .= $image;
		        }
		        if (!empty($layout['title'])) {
			        if (!empty($args)&&empty($preview)) {
				        $widget .= $args['before_title'] . $layout['title'] . $args['after_title'];
			        } else {
				        $widget .= '<div class="widget-title">'.$layout['title'].'</div>';
			        }
		        }

		        switch ($layout['buttonType']) {
			        case 'shadowed':
				        $additionalButtonClasses = 'rbag-widget-button-shadowed';
				        break;
			        case 'bordered':
				        $additionalButtonClasses = 'rbag-widget-button-bordered';
				        break;
			        default:
				        $additionalButtonClasses = '';
				        break;
		        }

		        // This is where you run the code and display the output
		        if (empty($preview)) {
			        $widget .= '<button onclick="rbagWidgetButtonClicked();" data-href="'.$pageUrl.'" class="rbag-widget-button1 '.$additionalButtonClasses.'">'.$layout['buttonText'].'</button>';
		        } else {
			        $widget .= '<button class="rbag-widget-button1 '.$additionalButtonClasses.'">'.$layout['buttonText'].'</button>';
		        }
		        $widget .= '</div>';

		        return $widget;
            }
	        catch (Exception $ex) {
		        $errorText = "widget creation error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
	        catch (Error $ex) {
		        $errorText = "widget creation error: ".$ex->getMessage();
		        RBAG_Logs::saveLogs('errorsLog', $errorText);
	        }
            return '';
        }

        // Creating widget Backend
        public function form($instance) {
            if (isset($instance[ 'title' ])) {
                $title = $instance['title'];
            } else {
                $title = __('New title');
            }
            // Widget admin form
            ?>
            <p>
                <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
            </p>
            <?php
        }

        // Updating widget replacing old instances with new
        public function update($new_instance, $old_instance) {
            $instance = array();
            $instance['title'] = (!empty($new_instance['title']))?strip_tags($new_instance['title']):'';
            return $instance;
        }
    }

    if (!function_exists('rbag_load_widget')) {
        function rbag_load_widget() {
            register_widget('RBAG_Widget');
        }
    }
}