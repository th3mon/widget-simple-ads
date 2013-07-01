<?php
/*
Plugin Name: Simple ads widget
Plugin URI: https://github.com/th3mon/widget-simple-ads
Description: Widget with adding url to image and link to page whom you whant promote.
Version: 1.0
Author: Przemysław "th3mon" Szelenberger
Author URI: https://github.com/th3mon
Author Email: p.szelenberger@gmail.com
Text Domain: simple-ads-locale
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2012 Przemysław "th3mon" Szelenberger (p.szelenberger@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// TODO: change 'Widget_Name' to the name of your plugin
class WP_Widget_SimpleAds extends WP_Widget {

    /*--------------------------------------------------*/
    /* Constructor
    /*--------------------------------------------------*/

    /**
     * Specifies the classname and description, instantiates the widget,
     * loads localization files, and includes necessary stylesheets and JavaScript.
     */
    public function __construct() {
        $widget_ops = array('classname' => 'WP_Widget_SimpleAds', 'description' => 'Widget with adding url to image and link to page whom you whant promote.');
        $this->WP_Widget('WP_Widget_SimpleAds', 'SimpleAds', $widget_ops);
    } // end constructor

    /*--------------------------------------------------*/
    /* Widget API Functions
    /*--------------------------------------------------*/

    /**
     * Outputs the content of the widget.
     *
     * @param   array   args        The array of form elements
     * @param   array   instance    The current instance of the widget
     */
    public function widget( $args, $instance ) {

        extract( $args, EXTR_SKIP );

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $link_url = apply_filters( 'widget_text', empty( $instance['link_url'] ) ? '' : $instance['link_url'], $instance );
        $image_url = apply_filters( 'widget_text', empty( $instance['image_url'] ) ? '' : $instance['image_url'], $instance );

        echo $before_widget;

        if (!empty($title)) {
?>
        <h2><?php echo $title; ?></h2>
<?php
        }

        if (!empty($link_url) && !empty($image_url)) {
?>
        <a href="<?php echo $link_url; ?>"><img src="<?php echo $image_url; ?>" /></a>
<?php
        }

        echo $after_widget;

    } // end widget

    /**
     * Processes the widget's options to be saved.
     *
     * @param   array   new_instance    The previous instance of values before the update.
     * @param   array   old_instance    The new instance of values to be generated via the update.
     */
    public function update( $new_instance, $old_instance ) {

        $instance = $old_instance;

        // TODO:    Here is where you update your widget's old values with the new, incoming values
        $instance['title'] = $new_instance['title'];
        $instance['image_url'] = $new_instance['image_url'];
        $instance['link_url'] = $new_instance['link_url'];

        return $instance;

    } // end widget

    /**
     * Generates the administration form for the widget.
     *
     * @param   array   instance    The array of keys and values for the widget.
     */
    public function form( $instance ) {

        // TODO:    Define default values for your variables
        $instance = wp_parse_args((array) $instance, array('title' => '', 'image_url' => '', 'link_url' => '') );

        // TODO:    Store the values of the widget in their own variable
        $title = attribute_escape($instance['title']);
        $image_url = $instance['image_url'];
        $link_url = $instance['link_url'];

        // Display the admin form
        ?>
            <p>
                <label for="<?php echo $this->get_field_name('title'); ?>">
                    Title: <input class="widefat" id="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_name('image_url'); ?>">
                    Image URL: <input class="widefat" id="<?php echo $this->get_field_name('image_url'); ?>" name="<?php echo $this->get_field_name('image_url'); ?>" type="text" value="<?php echo $image_url; ?>" />
                </label>
            </p>

            <p>
                <label for="<?php echo $this->get_field_name('link_url'); ?>">
                    Link URL: <input class="widefat" id="<?php echo $this->get_field_name('link_url'); ?>" name="<?php echo $this->get_field_name('link_url'); ?>" type="text" value="<?php echo $link_url; ?>" />
                </label>
            </p>

        <?php

    } // end form

    /*--------------------------------------------------*/
    /* Public Functions
    /*--------------------------------------------------*/

    /**
     * Loads the Widget's text domain for localization and translation.
     */
    public function widget_textdomain() {

        load_plugin_textdomain( 'simple-ads-locale', false, plugin_dir_path( __FILE__ ) . '/lang/' );

    } // end widget_textdomain

} // end class

// TODO:    Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("WP_Widget_SimpleAds");' ) );
