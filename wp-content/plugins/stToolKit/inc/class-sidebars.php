<?php  if (  ! defined( 'ABSPATH' ) ) exit( 'No direct script access allowed' );

/**
 * ST Sidebars
 * A simple class that adds a "add sidebar area" form to the widget page and allows to create widgets on the right
 *
 */

if( ! class_exists( 'ST_Sidebar' ) )
{
    class ST_Sidebar
    {
        var $paths     = array();
        var $sidebars  = array();
        var $stored    = "st_sidebars";

        //constructor, makes sure that we only load most of the stuff on the widget page, except for the register sidebar function
        function __construct()
        {
            $this->paths['css']   = ST_PAGEBUILDER_URL.'assets/css/';
            $this->paths['js']    = ST_PAGEBUILDER_URL.'assets/js/';
            $this->nonce = wp_create_nonce ('st-delete-custom-sidebar-nonce');
            $this->title          = __('ST Custom Widget Area','avia_framework');

            if(is_admin()){
                add_action('load-widgets.php', array(&$this, 'load_assets') , 5 );
                add_action('wp_ajax_st_ajax_delete_custom_sidebar', array(&$this, 'delete_sidebar_area') , 1000 );
            }

            add_action('widgets_init', array(&$this, 'register_custom_sidebars') , 1000 );

        }

        //load backend css, js and add hooks to the widget page
        function load_assets()
        {
            add_action('admin_print_scripts', array(&$this, 'template_add_widget_field') );
            add_action('load-widgets.php', array(&$this, 'add_sidebar_area'), 100);
            wp_enqueue_script('jquery');
            wp_enqueue_script('st_sidebars' , $this->paths['js'] . 'sidebars.js', array('jquery'));
            wp_enqueue_style( 'st_sidebars' , $this->paths['css'] . 'sidebars.css');
            wp_localize_script('jquery','st_sidebar_nonce', $this->nonce);
        }



        //js template that gets attached to the widget area so the user can add widget names
        function template_add_widget_field()
        {

            $nonce = '<input type="hidden" name="st-delete-custom-sidebar-nonce" value="'.$this->nonce.'" />';

            echo "\n<script type='text/html' id='st-tmpl-add-widget'>";
            echo "\n  <form class='st-add-widget' method='POST'>";
            echo "\n  <h3>". $this->title ."</h3>";
            echo "\n    <span class='input'><input type='text' value='' placeholder = '".__('Enter Name of the new Widget here','smooththemes')."' name='st-add-widget' /></span>";
            echo "\n    <input class='button-primary button button-large' type='submit' value='".__('Add Widget Area','smooththemes')."' />";
            echo "\n    ".$nonce;
            echo "\n  </form>";
            echo "\n</script>\n";
        }




        //adds a sidebar area to the database
        function add_sidebar_area()
        {

           // update_option($this->stored, array());

            if(!empty($_POST['st-add-widget']))
            {
                $this->sidebars = get_option($this->stored);

                $name           =  $this->get_name($_POST['st-add-widget']);
                $id = 'sidebar-'.uniqid().'-'.rand(10,99);

                if(empty($this->sidebars))
                {
                    $this->sidebars = array($id => $name);
                }
                else
                {
                    $this->sidebars = array_merge($this->sidebars, array($id=>$name));
                }

                update_option($this->stored, $this->sidebars);
                wp_redirect( admin_url('widgets.php') );
                die();
            }
        }

        //delete a sidebar area from the database
        function delete_sidebar_area()
        {
            check_ajax_referer('st-delete-custom-sidebar-nonce');

            if(!empty($_POST['name']))
            {
                $name = stripslashes($_POST['name']);
                $this->sidebars = get_option($this->stored);

                if(($key = array_search($name, $this->sidebars)) !== false)
                {
                    unset($this->sidebars[$key]);
                    update_option($this->stored, $this->sidebars);
                    echo "sidebar-deleted";
                }
            }

            die();
        }



        //checks the user submitted name and makes sure that there are no colitions
        function get_name($name)
        {
            if(empty($GLOBALS['wp_registered_sidebars'])) return $name;

            $taken = array();
            foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar )
            {
                $taken[] = $sidebar['name'];
            }

            if(empty($this->sidebars)) $this->sidebars = array();
            $taken = array_merge($taken, $this->sidebars);

            if(in_array($name, $taken))
            {
                $counter  = substr($name, -1);
                $new_name = "";

                if(!is_numeric($counter))
                {
                    $new_name = $name . " 1";
                }
                else
                {
                    $new_name = substr($name, 0, -1) . ((int) $counter + 1);
                }

                $name = $this->get_name($new_name);
            }

            return $name;
        }



        //register custom sidebar areas
        function register_custom_sidebars()
        {
            if(empty($this->sidebars)) $this->sidebars = get_option($this->stored);

            $args = array(
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title' => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            );

            $args = apply_filters('st_custom_widget_args', $args);



            if(is_array($this->sidebars))
            {
                foreach ($this->sidebars as $id => $sidebar)
                {
                    $args['id']  = $id;
                    $args['name']  = $sidebar;
                    $args['class'] = 'st-custom';
                    register_sidebar($args);
                }
            }
        }
    }

    new ST_Sidebar();
}









