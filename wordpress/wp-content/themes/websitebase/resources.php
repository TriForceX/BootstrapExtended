<?php
/*
 * PHP Main Resources
 * TriForce - Matías Silva
 *
 * This file calls the main PHP utilities and sets the main data (html and rebuild pass)
 * Don't add functions here, You can add your own in functions.php
 * 
 */

// Set Main Website Base Data
$websitebase = array(
	// Fields
	'lang' 				=> get_bloginfo('language'),
	'charset' 			=> get_option('blog_charset'),
	'title' 			=> get_option('blogname'),
	'description' 		=> get_option('blogdescription'),
	'keywords' 			=> get_option('blogkeywords'),
	'author' 			=> get_option('blogauthor'),
	'mobile-capable' 	=> 'yes',
	'viewport' 			=> 'width=device-width, initial-scale=1, user-scalable=no',
	'nav-color' 		=> get_option('blognavcolor'),
	'nav-color-apple' 	=> get_option('blognavcolorapple'),
	'timezone' 			=> get_option('timezone_string'),
	'rebuild_pass'		=> 'mypassword',
	'minify'			=> true,
	'mix'				=> true,
	'css_file'			=> array('css/extras/example.css',
								 /*'css/extras/example-2.css',*/
								 /*'css/extras/example-3.css',*/),
	'css_vars'			=> array('$color-custom'	=> '#FF0000',
								 /*'$color-custom-2'	=> '#FFFFFF',*/
								 /*'$color-custom-3'	=> '#FFFFFF',*/),
	'js_file'			=> array('js/extras/example.js',
								 /*'js/extras/example-2.js',*/
								 /*'js/extras/example-3.js',*/),
	'js_vars'			=> array('$color-custom'	=> '#FF0000',
								 /*'$color-custom-2'	=> '#FFFFFF',*/
								 /*'$color-custom-3'	=> '#FFFFFF',*/),
);

// Get the main PHP utilities
require_once('resources/php/utilities.php');

// Enable main PHP utilities
class php extends utilities\php { }

// Rebuild CSS & JS redirect clean
if(isset($_GET['rebuild']) && $_GET['rebuild'] == $websitebase['rebuild_pass'])
{
	header('Expires: Tue, 01 Jan 2000 00:00:00 GMT');
	header('Last-Modified: '.gmdate("D, d M Y H:i:s").' GMT');
	header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
	header('Cache-Control: post-check=0, pre-check=0', false);
	header('Pragma: no-cache');
	header('Location: '.get_bloginfo('url').'?lastbuild');
}
if(isset($_GET['lastbuild']))
{
	header('Location: '.get_bloginfo('url'));
}

/*
 * Wordpress Base Stuff
 * 
 * Base functions to load on template
 * More resources in https://codex.wordpress.org
 * 
 */

// Load theme language
load_theme_textdomain('websitebase');

// Prevent .htaccess to be modified by permalink rules
add_filter('flush_rewrite_rules_hard','__return_false');

// Custom login logo URL
add_filter('login_headerurl', 'login_logo_url');
add_filter('login_headertitle', 'login_logo_url');

// Add custom CSS & JS to admin
add_action('admin_footer', 'add_custom_admin');
add_action('login_footer', 'add_custom_admin');

// Disable specific plugin update check 
add_filter('site_transient_update_plugins', 'disable_plugin_updates');

// Custom customize register functions
add_action('customize_register', 'custom_customize_register', 50);

// Set template modifications
add_action('customize_register', 'custom_theme_settings');

// Add custom CSS & JS to admin
if(is_user_logged_in())
{
	add_action('wp_footer', 'add_custom_admin');
}

// Don't execute custom jpg quality if an image resizer is enabled
if(!check_plugin('resize-image-after-upload/resize-image-after-upload.php'))
{
	add_filter('jpeg_quality', 'custom_jpeg_quality');
}

// Add custom CSS & JS to admin
function add_custom_admin() 
{
	echo '<link href="'.get_bloginfo('template_url').'/css/admin/style-base.css" rel="stylesheet">';
	echo '<link href="'.get_bloginfo('template_url').'/css/admin/style-theme.css" rel="stylesheet">';
	echo '<script src="'.get_bloginfo('template_url').'/js/admin/app-base.js"></script>';
	echo '<script src="'.get_bloginfo('template_url').'/js/admin/app-theme.js"></script>';
}

// Custom login logo URL
function login_logo_url()
{
    return home_url();
}

// Get the slug inside post
function get_the_slug($id = null)
{
	if(empty($id))
	{
		global $post;
		if(empty($post))
		{
			return ''; // No global $post var available.
		}
		$id = $post->ID;
	}
	$slug = basename(get_permalink($id));
	return $slug;
}

// Get the id by slug
function get_id_by_slug($slug)
{
	global $wpdb;
	$id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$slug."'");
	return $id;
}

// Get post_type data (label, name, description, etc...)
function get_post_type_data($type, $name = null)
{
	$post_type = empty($name) ? get_query_var('post_type') : $name;
	$data = get_post_type_object($post_type);
	return $data->$type;
}

// Get taxonomy data (term_id, name, slug, term_group, term_taxonomy_id, taxonomy, description, parent, count, etc...)
function get_taxonomy_data($type, $taxonomy, $id = null)
{
	$post_id = empty($id) ? get_the_ID() : $id;
	$post_terms = array_reverse(get_terms($taxonomy));
	$current_terms = wp_get_post_terms($post_id, $taxonomy, array('fields' => 'slugs')); 

	foreach($post_terms as $post_term)
	{
		if(in_array($post_term->slug, $current_terms))
		{
			return $post_term->$type;
		}
	} 
}

// Featured image
function featuredImg($post, $size = 'full')
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post), $size, false); //$post->ID
    return $src[0];
}

// Featured image size
function featuredImgSize($post, $prop)
{
    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post), 'full', false); //$post->ID
    return $prop == 'width' ? $src[1] : $src[2];
}

// Featured image field
function featuredImgField($post, $field)
{
    $value = get_post_meta(get_post_thumbnail_id($post), $field, true);
    return $value;
}

// Small function to check plugin without using is_plugin_active (due to it requires plugin.php)
function check_plugin($plugin)
{
	return in_array($plugin, apply_filters('active_plugins', get_option('active_plugins')));
}

// Custom JPEG quality on upload
function custom_jpeg_quality()
{
    return 100;
}

// Custom general fields
new new_general_setting();

class new_general_setting 
{
    function new_general_setting() 
	{
        add_filter('admin_init', array(&$this, 'new_register_fields'));
    }
    function new_register_fields() 
	{
		$fields = array('blogkeywords' 		=> array(__('Site keywords', 'websitebase'), __('Words to let search engines to found this site', 'websitebase')),
						'bloganalytics' 	=> array(__('Analytics code', 'websitebase'), __('Code placed in the HTML head to track site analytics', 'websitebase')),
						'blogauthor'	 	=> array(__('Site author', 'websitebase'), __('Defines the site author', 'websitebase')),
						'blognavcolor' 		=> array(__('Nav color', 'websitebase'), __('Navigator bar color for most devices (use hexadecimal format)', 'websitebase')),
						'blognavcolorapple' => array(__('Nav color (Apple)', 'websitebase'), __('Navigator bar color for Apple devices (use black or black-translucent)', 'websitebase')));
		
		foreach($fields as $key => $value)
		{
			$args = array(
				'slug' 			=> $key,
				'title'			=> $value[0],
				'description'	=> $value[1],
			);
			register_setting('general', $args['slug'], 'esc_attr');
			add_settings_field($args['slug'], '<label for="'.$args['slug'].'">'.$args['title'].'</label>', array(&$this, 'new_fields_html'), 'general', 'default', $args);
		}
    }
	function new_fields_html(array $args)
	{
		switch($args['slug'])
		{
			case 'blogkeywords':
			case 'bloganalytics':
				echo '<div class="new_fields_html">
						  <textarea id="'.$args['slug'].'" name="'.$args['slug'].'">'.get_option($args['slug'], '').'</textarea>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
			case 'blogauthor':
			case 'blognavcolor':
			case 'blognavcolorapple':
				echo '<div class="new_fields_html">
						  <input type="text" id="'.$args['slug'].'" name="'.$$args['slug'].'" value="'.get_option($args['slug'], '').'"/>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
			default:
				echo '<div class="new_fields_html">
						  <input type="text" id="'.$args['slug'].'" name="'.$$args['slug'].'" value="'.get_option($args['slug'], '').'"/>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
		}
	}
}

// Custom customize register functions
function custom_customize_register($wp_customize)
{
	$wp_customize->remove_panel('themes');
	$wp_customize->remove_panel('widgets');
	$wp_customize->remove_panel('nav_menus');
	$wp_customize->remove_section('title_tagline');
	$wp_customize->remove_section('colors');
	$wp_customize->remove_section('header_image');
	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('static_front_page');
	$wp_customize->remove_section('custom_css');
}

// Set template modifications
function custom_theme_settings($wp_customize)
{
	// Custom panels
	global $customize_theme_panels;
	
	foreach($customize_theme_panels as $key => $value)
	{
		$wp_customize->add_panel($key, array('priority'       => $value['priority'],
											 'capability'     => $value['capability'],
											 'theme_supports' => $value['theme_supports'],
											 'title'          => $value['title'],
											 'description'    => $value['description']));
	}
	
	// Set custom template control for multiple checkbox
	class WP_Customize_Checkbox_Multiple_Control extends WP_Customize_Control 
	{
		public $type = 'checkbox-multiple';

		public function enqueue() 
		{
			wp_enqueue_script('custom_customize_register', get_bloginfo('template_url').'/js/admin/app-base.js', array('jquery'));
		}

		public function render_content() 
		{
			if(empty($this->choices))
				return; ?>

			<?php if(!empty($this->label)): ?>
				<span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
			<?php endif; ?>

			<?php if(!empty($this->description)): ?>
				<span class="description customize-control-description"><?php echo $this->description; ?></span>
			<?php endif; ?>

			<?php $multi_values = !is_array($this->value()) ? explode(',', $this->value()) : $this->value(); ?>

			<ul>
				<?php foreach($this->choices as $value => $label): ?>

					<li>
						<label>
							<input type="checkbox" value="<?php echo esc_attr($value); ?>" <?php checked(in_array($value, $multi_values)); ?> /> 
							<?php echo esc_html($label); ?>
						</label>
					</li>

				<?php endforeach; ?>
			</ul>

			<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $multi_values)); ?>" />
		<?php }
	}

	// Set custom WYSIWIG text editor
	class WP_Customize_WYSIWIG_Text_Editor_Control extends WP_Customize_Control
	{
		public $type = 'wysiwig-text';
		
		function enqueue() 
		{
			wp_enqueue_script('custom_customize_register', get_bloginfo('template_url').'/js/admin/app-base.js', array('jquery'));
		}

		public function render_content()
		{
		?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php
					$settings = array(
									'wpautop'		=> true,
									'textarea_rows' => 10,
									'media_buttons' => false,
									'quicktags' 	=> false,
									);
					$this->filter_editor_setting_link();
					wp_editor($this->value(), $this->id, $settings);
				?>
			</label>
		<?php
			do_action('admin_footer');
			do_action('admin_print_footer_scripts');
		}
		private function filter_editor_setting_link()
		{
			add_filter('the_editor', function($output){ return preg_replace('/<textarea/', '<textarea '.$this->get_link(), $output, 1); });
		}
	}
	
	// Custom fields
	global $customize_theme_fields;
	
	foreach ($customize_theme_fields as $key => $value)
	{
		$wp_customize->add_section($key,
			array(
				'title' 		=> $value['title'],
				'description' 	=> $value['desc'],
				'panel'			=> $value['panel'],
			)
		);
		$wp_customize->add_setting($key,
			array(
				'default' 		=> $value['default'],
			)
		);

		// Control type
		switch($value['type'])
		{
			case 'text':
			case 'textarea':
				$wp_customize->add_control($key,
					array(
						'label' 	=> $value['label'],
						'section' 	=> $key,
						'type' 		=> $value['type'], //text
					)
				);
				break;
			case 'radio':
			case 'select':
				$wp_customize->add_control($key,
					array(
						'label' 	=> $value['label'],
						'section' 	=> $key,
						'settings'	=> $key,
						'type' 		=> $value['type'], //radio/select
						'choices'  	=> $value['choices'],
					)
				);
				break;
			case 'checkbox':
				$wp_customize->add_control( 
					new WP_Customize_Checkbox_Multiple_Control($wp_customize, $key,
						array(
							'label' 	=> $value['label'],
							'section' 	=> $key,
							'settings'	=> $key,
							'type' 		=> 'checkbox-multiple', //improved checkbox
							'choices'  	=> $value['choices'],
						)
					)
				);
				break;
			case 'wysiwig':
				$wp_customize->add_control( 
					new WP_Customize_WYSIWIG_Text_Editor_Control($wp_customize, $key,
						array(
							'label'   	=> $value['label'],
							'section' 	=> $key,
							'settings'	=> $key,
							'type' 		=> 'wysiwig-text', //improved text editor
						)
					)
				);
				break;
			case 'image':
				$wp_customize->add_control( 
					new WP_Customize_Image_Control($wp_customize, $key,
						array(
							'label'   	=> $value['label'],
							'section' 	=> $key,
							'settings'	=> $key,
						)
					)
				);
				break;
			case 'file':
				$wp_customize->add_control( 
					new WP_Customize_Upload_Control($wp_customize, $key,
						array(
							'label'   	=> $value['label'],
							'section' 	=> $key,
							'settings'	=> $key,
						)
					)
				);
				break;
		}
	}
}

// Set template default values
function get_theme_mod2($name)
{
    global $customize_theme_fields;

	foreach($customize_theme_fields as $key => $value)
	{
		if($key == $name)
		{
			$field = get_theme_mod($key);
			return empty($field) ? $value['default'] : get_theme_mod($key);
		}
	}
}

// Disable specific plugin update check 
function disable_plugin_updates($value)
{	
	$disabledPlugins = array(
							'advanced-custom-fields-pro/acf.php', // Updated manually
							'admin-menu-editor-pro/menu-editor.php', // Updated manually (check the comment "//Manual update" in this file before update)
							'enhaced-contextual-help/enhaced-contextual-help.php', // Updated manually (from https://git.io/fAjsr)
							'wp-migrate-db-pro/wp-migrate-db-pro.php', // Updated manually (check the comment "//Manual update" oi this file before update)
							//'plugin-folder/plugin.php',
							//'plugin-folder/plugin.php',
							);
	
	foreach($disabledPlugins as $disabledPlugin)
	{
		if(isset($value) && is_object($value)) 
		{
			if(isset($value->response[$disabledPlugin])) 
			{
				unset($value->response[$disabledPlugin]);
			}
		}
	}
	return $value;
}
