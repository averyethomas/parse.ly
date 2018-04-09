<?php
/*
Plugin Name: TM Top Posts
Description: This is a plugin testing a top post widget from Texas Monthly 
Author: Avery Thomas
Version: 1.0
Author URI: http://averyethomas.com/
*/



function load_plugin_files() {
    wp_enqueue_script( 'jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.map', array('jquery'), '1.0', false);
    wp_enqueue_script( 'angular-core', 'https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.7/angular.min.js', array( 'jquery' ), '1.0', false );
    wp_enqueue_script( 'ngScripts', plugin_dir_url(__FILE__) . '/scripts/app.js', array( ), '1.0', false );
    wp_enqueue_style( 'style', plugin_dir_url(__FILE__) . 'style.css' );
}
add_action( 'wp_enqueue_scripts', 'load_plugin_files' );


function tm_load_widget() {
    register_widget( 'tm_top_posts' );
}

add_action( 'widgets_init', 'tm_load_widget' );
 
 
class tm_top_posts extends WP_Widget {
 
    function __construct() {
        parent::__construct(
            'tm_top_posts', 
            __('Texas Monthly Top Posts', 'wpb_widget_domain'), 
            array( 'description' => __( 'Widget displaying the top posts from Texas Monthly', 'wpb_widget_domain' ), )
        );
    }
  
    public function widget( $args, $instance ) {
        echo $args['before_widget'];
        
        ?>
        
        <div class="trending" ng-cloak data-ng-app="angularApp" data-ng-controller="parselyCtrl">
            <h4>Trending</h4>
            <div class="post" data-ng-repeat="post in topPosts track by $index">
                <a data-ng-href="{{ post.link }}">
                    <div class="number">
                        <h6>{{ ("0"+ ($index + 1)).slice(-2) }}</h6>
                    </div>
                    <div class="postsInfo">
                        <h5>{{ post.title }}</h5>
                        <p>By {{ post.author }}</p>
                    </div>
                </a>
            </div>
        </div>
        
        <?php
        
        echo $args['after_widget'];
    }
         
    public function form( $instance ) { }
     
    public function update( $new_instance, $old_instance ) {
        return $instance;
    }
} 

?>