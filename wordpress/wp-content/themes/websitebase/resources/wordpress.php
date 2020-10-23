<?php

/*
 * Website Base WordPress
 * 
 * Main custom WordPress functions
 * More info at https://github.com/TriForceX/WebsiteBase/wiki
 * 
 */

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

// Load theme language
if(stripos(get_bloginfo('language'), 'es') !== false)
{
	load_textdomain('websitebase', WP_LANG_DIR . '/themes/websitebase-es_ES.mo'); 
}

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

// Force http/https on input URL field
if(check_plugin('wp-migrate-db-pro/wp-migrate-db-pro.php') || check_plugin('wp-migrate-db/wp-migrate-db.php'))
{
	add_filter('admin_footer', 'wp_migrate_db_js');
    
    function wp_migrate_db_js() 
    { ?>
	<script type="text/javascript">
	jQuery(function($){
		if($('#wpmdb-main #migrate-form').length > 0)
		{
			var wpmigrateForm 		= $('#wpmdb-main #migrate-form');
			var wpmigrateOptions 	= wpmigrateForm.find('.option-section .migrate-selection input[type=radio]');
			var wpmigrateSave 		= wpmigrateForm.find('.option-section #savefile');
			var wpmigrateGZip 		= wpmigrateForm.find('.option-section #gzip_file');
			var wpmigrateOldUrl 	= wpmigrateForm.find('.step-two #find-and-replace-sort #old-url');
			var wpmigrateNewUrl 	= wpmigrateForm.find('.step-two #find-and-replace-sort #new-url');
			var wpmigrateContent	= wpmigrateForm.find('.step-two');
			var wpmigrateAlert 		= '<?php _e('Due to you are using <strong>Website Base</strong> theme, remember to prepend <strong>http</strong> or <strong>https</strong> to your <i>Local & Production</i> URL', 'websitebase'); ?>';

			wpmigrateContent.prepend('<div class="notification-message warning-notice inline-message">'+wpmigrateAlert+'</div>');
			
			var wpmigrateEdit = function()
			{
				if(!(wpmigrateOldUrl.val().indexOf('http://') >= 0 || wpmigrateOldUrl.val().indexOf('https://') >= 0))
				{
					wpmigrateOldUrl.val(window.location.protocol+((wpmigrateOldUrl.val().indexOf('//') >= 0) ? '' : '//')+wpmigrateOldUrl.val());
				}

				if(!(wpmigrateNewUrl.val().indexOf('http://') >= 0 || wpmigrateNewUrl.val().indexOf('https://') >= 0))
				{
					wpmigrateNewUrl.val(window.location.protocol+((wpmigrateNewUrl.val().indexOf('//') >= 0) ? '' : '//')+wpmigrateNewUrl.val());
				}
			}
			
			var wpmigrateCheck = function()
			{
				if(wpmigrateSave.is(':checked'))
				{
					wpmigrateGZip.prop('checked', false);
					wpmigrateEdit();
					wpmigrateOldUrl.blur(function(e){ wpmigrateEdit() });
					wpmigrateNewUrl.blur(function(e){ wpmigrateEdit() });
				}
				else
				{
					wpmigrateOldUrl.unbind();
					wpmigrateNewUrl.unbind();
				}
			}
			
			wpmigrateOptions.each(function(){ wpmigrateCheck() });
			wpmigrateOptions.change(function(){ wpmigrateCheck() });
		}
	});
	</script>
	<?php }
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
	if(is_tax()){
		$tax_current = get_query_var('taxonomy');
		$tax_obj = get_taxonomy($tax_current);
		$post_type = $tax_obj->object_type[0];
	}
	else{
		$post_type = !empty($name) ? $name : !empty(get_post_type()) ? get_post_type() : get_query_var('post_type');
	}
	
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

// Retrieves the attachment ID from the file URL
function get_file_id($url)
{
	global $wpdb;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE guid='%s';", $url));
	return $attachment[0];
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
class custom_settings
{
    public function __construct()
	{
        add_filter('admin_init', array(&$this, 'new_register_fields'));
    }
    public function new_register_fields() 
	{
		$fields = array('blogkeywords' 		=> array(__('Site keywords', 'websitebase'), __('Words to let search engines to found this site.', 'websitebase')),
						'bloganalytics' 	=> array(__('Analytics code', 'websitebase'), __('Code placed in the HTML head to track site analytics.', 'websitebase')),
						'blogauthor'	 	=> array(__('Site author', 'websitebase'), __('Defines the site author.', 'websitebase')),
						'blognavcolor' 		=> array(__('Nav color', 'websitebase'), __('Navigator bar color for most devices (use hexadecimal format).', 'websitebase')),
						'blognavcolorapple' => array(__('Nav color (Apple)', 'websitebase'), __('Navigator bar color for Apple devices.', 'websitebase')));
		
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
	public function new_fields_html(array $args)
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
				echo '<div class="new_fields_html">
						  <input type="text" id="'.$args['slug'].'" name="'.$args['slug'].'" value="'.get_option($args['slug'], get_option('blogname')).'"/>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
			case 'blognavcolor':
				echo '<div class="new_fields_html">
						  <input type="color" id="'.$args['slug'].'" name="'.$args['slug'].'" value="'.get_option($args['slug'], '#7840a2').'"/>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
			case 'blognavcolorapple':
				echo '<div class="new_fields_html">
						  <select type="text" id="'.$args['slug'].'" name="'.$args['slug'].'">
						  	  <option value="default" '.(get_option($args['slug'], '') == 'default' ? 'selected' : '').'>'.__('Default', 'websitebase').'</option>
							  <option value="black" '.(get_option($args['slug'], '') == 'black' ? 'selected' : '').'>'.__('Black', 'websitebase').'</option>
							  <option value="black-translucent" '.(get_option($args['slug'], '') == 'black-translucent' ? 'selected' : '').'>'.__('Black translucent', 'websitebase').'</option>
						  </select>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
			default:
				echo '<div class="new_fields_html">
						  <input type="text" id="'.$args['slug'].'" name="'.$args['slug'].'" value="'.get_option($args['slug'], '').'"/>
						  <p class="description" id="'.$args['slug'].'-description">'.$args['description'].'</p>
					  </div>';
				break;
		}
	}
}
$custom_settings = new custom_settings();

// Custom customize register functions
function custom_customize_register($wp_customize)
{
	$wp_customize->remove_panel('themes');
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
	
	if(!empty($customize_theme_panels))
	{
		foreach($customize_theme_panels as $key => $value)
		{
			$wp_customize->add_panel($key, array('priority'       => $value['priority'],
												 'capability'     => $value['capability'],
												 'theme_supports' => $value['theme_supports'],
												 'title'          => $value['title'],
												 'description'    => $value['description']));
		}
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

	// Set custom WYSIWYG text editor
	class WP_Customize_WYSIWYG_Text_Editor_Control extends WP_Customize_Control
	{
		public $type = 'wysiwyg-text';
		
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
	
	if(!empty($customize_theme_fields))
	{
		foreach ($customize_theme_fields as $key => $value)
		{
			$wp_customize->add_section($key,
				array(
					'title' 		=> $value['title'],
					'description' 	=> $value['desc'],
					'panel'			=> $value['panel'],
					'priority'		=> $value['priority'],
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
				case 'wysiwyg':
					$wp_customize->add_control( 
						new WP_Customize_WYSIWYG_Text_Editor_Control($wp_customize, $key,
							array(
								'label'   	=> $value['label'],
								'section' 	=> $key,
								'settings'	=> $key,
								'type' 		=> 'wysiwyg-text', //improved text editor
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
							'advanced-custom-fields-pro/acf.php', // Manually updated from GitHub repositories
							'admin-menu-editor-pro/menu-editor.php', // Manually updated from GitHub repositories
							'enhanced-contextual-help/enhanced-contextual-help.php', // Manually updated from https://github.com/TriForceX/WPEnhancedHelp
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

// Returns the timezone string for a site, even if it's set to a UTC offset
function wp_get_timezone_string() 
{
    // if site timezone string exists, return it
    if ( $timezone = get_option( 'timezone_string' ) )
        return $timezone;
    // get UTC offset, if it isn't set then return UTC
    if ( 0 === ( $utc_offset = get_option( 'gmt_offset', 0 ) ) )
        return 'UTC';
    // adjust UTC offset from hours to seconds
    $utc_offset *= 3600;
    // attempt to guess the timezone string from the UTC offset
    if ( $timezone = timezone_name_from_abbr( '', $utc_offset, 0 ) ) {
        return $timezone;
    }
    // last try, guess timezone string manually
    $is_dst = date( 'I' );

    foreach ( timezone_abbreviations_list() as $abbr ) {
        foreach ( $abbr as $city ) {
            if ( $city['dst'] == $is_dst && $city['offset'] == $utc_offset )
                return $city['timezone_id'];
        }
    }
    // fallback to UTC
    return 'UTC';
}
