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

        // load plugin text domain
        add_action( 'init', array( $this, 'widget_textdomain' ) );

        // Hooks fired when the Widget is activated and deactivated
        register_activation_hook( __FILE__, array( $this, 'activate' ) );
        register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );

        parent::__construct(
            'simple-ads',
            __( 'Simple ads widget', 'simple-ads-locale' ),
            array(
                'classname'     =>  'WP_Widget_SimpleAds ',
                'description'   =>  __( 'Widget with adding url to image and link to page whom you whant promote.', 'simple-ads-locale' )
            )
        );

        // Register admin styles and scripts
        add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );

        // Register site styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'register_widget_scripts' ) );

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

        echo $before_widget;

        // TODO:    Here is where you manipulate your widget's values based on their input fields

        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $link_url = apply_filters( 'widget_text', empty( $instance['link_url'] ) ? '' : $instance['link_url'], $instance );
        $image_url = apply_filters( 'widget_text', empty( $instance['image_url'] ) ? '' : $instance['image_url'], $instance );

        include( plugin_dir_path( __FILE__ ) . '/views/widget.php' );

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
        $instance = wp_parse_args(
            (array) $instance,
            array(
                'title' => '',
                'image_url' => '',
                'link_url' => ''
            )
        );

        // TODO:    Store the values of the widget in their own variable
        $title = attribute_escape($instance['title']);
        $image_url = $instance['image_url'];
        $link_url = $instance['link_url'];

        // Display the admin form
        include( plugin_dir_path(__FILE__) . '/views/admin.php' );

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

    /**
     * Fired when the plugin is activated.
     *
     * @param       boolean $network_wide   True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public function activate( $network_wide ) {
        // TODO define activation functionality here
    } // end activate

    /**
     * Fired when the plugin is deactivated.
     *
     * @param   boolean $network_wide   True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog
     */
    public function deactivate( $network_wide ) {
        // TODO define deactivation functionality here
    } // end deactivate

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles() {

        // TODO:    Change 'widget-name' to the name of your plugin
        wp_enqueue_style( 'simple-ads-admin-styles', plugins_url( 'widget-simple-ads/css/admin.css' ) );

    } // end register_admin_styles

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts() {

        // TODO:    Change 'widget-name' to the name of your plugin
        wp_enqueue_script( 'simple-ads-admin-script', plugins_url( 'widget-simple-ads/js/admin.js' ), array('jquery') );

    } // end register_admin_scripts

    /**
     * Registers and enqueues widget-specific styles.
     */
    public function register_widget_styles() {

        // TODO:    Change 'widget-name' to the name of your plugin
        wp_enqueue_style( 'simple-ads-styles', plugins_url( 'widget-simple-ads/css/widget.css' ) );

    } // end register_widget_styles

    /**
     * Registers and enqueues widget-specific scripts.
     */
    public function register_widget_scripts() {

        // TODO:    Change 'widget-name' to the name of your plugin
        wp_enqueue_script( 'simple-ads-script', plugins_url( 'widget-simple-ads/js/widget.js' ), array('jquery') );

    } // end register_widget_scripts

} // end class

// TODO:    Remember to change 'Widget_Name' to match the class name definition
add_action( 'widgets_init', create_function( '', 'register_widget("WP_Widget_SimpleAds");' ) );
