<?php
/*
Plugin Name: Enhanced Contextual Help
Plugin URI: https://github.com/TriForceX/WPEnhancedHelp
Description: Extend your Dashboard displaying custom help for multiple user roles, pages and post types.
Version: 2.5
Author: TriForceX
Author URI: https://github.com/TriForceX
Slug: enhanced-contextual-help
License: GPL2
*/

class enhanced_contextual_help
{
	public function __construct()
	{
		load_plugin_textdomain('ech', false, basename(dirname(__FILE__)).'/languages');
		
		//https://codex.wordpress.org/Plugin_API/Admin_Screen_Reference
		$this->all_screens = array(
									'dashboard' 		=> __('Dashboard', 'ech'),
									'update-core' 		=> __('&rarr; Update', 'ech'),
									'edit-post' 		=> __('Post', 'ech'),
									'post' 				=> __('&rarr; Edit post', 'ech'),
									'edit-category' 	=> __('&rarr; Categories', 'ech'),
									'edit-post_tag' 	=> __('&rarr; Tags', 'ech'),
									'edit-page' 		=> __('Pages', 'ech'),
									'page' 				=> __('&rarr; Edit page', 'ech'),
									'upload' 			=> __('Media', 'ech'),
									'themes' 			=> __('Themes', 'ech'),
									'widgets' 			=> __('&rarr; Widgets', 'ech'),
									'nav-menus' 		=> __('&rarr; Menus', 'ech'),
									'theme-editor' 		=> __('Theme editor', 'ech'),
									'plugins' 			=> __('Plugins', 'ech'),
									'plugin-install' 	=> __('&rarr; Plugin install', 'ech'),
									'plugin-editor' 	=> __('&rarr; Plugin editor', 'ech'),
									'users' 			=> __('Users', 'ech'),
									'user' 				=> __('&rarr; Add user', 'ech'),
									'user-edit' 		=> __('&rarr; Edit user', 'ech'),
									'profile' 			=> __('&rarr; Profile', 'ech'),
									'tools' 			=> __('Tools', 'ech'),
									'import' 			=> __('&rarr; Import', 'ech'),
									'export' 			=> __('&rarr; Export', 'ech'),
									'options-general' 	=> __('Settings', 'ech'),
									'edit-wp_help' 		=> __('&rarr; Contextual help', 'ech')
								);
		
		add_filter('contextual_help', array($this, 'helper'), 1, 3);
		add_action('init', array($this, 'register_post_type'));
		add_action('add_meta_boxes', array($this, 'meta_boxes'));
		add_action('save_post_wp_help', array($this, 'save_post_meta'), 10);
		add_filter('manage_wp_help_posts_columns', array($this, 'add_column'), 5);
		add_action('manage_wp_help_posts_custom_column', array($this, 'column_wrap'), 5, 2);
		add_action('admin_menu', array($this, 'remove_meta_boxes'));
		add_action('admin_head', array($this, 'remove_tabs'));
		add_action('admin_footer', array($this, 'css_js_settings'));
		add_filter('plugin_action_links_'.plugin_basename(__FILE__), array($this, 'plugin_links'));
		
		register_activation_hook(__FILE__, array($this, 'wp_help_setup_install'));
		register_deactivation_hook(__FILE__, array($this, 'wp_help_setup_remove'));
	}
	
	function wp_help_setup_install()
	{
		add_option('wp_help_sidebar', 'true', '', 'yes');
		add_option('wp_help_mobile', 'true', '', 'yes');
		add_option('wp_help_menu', 'false', '', 'yes');
		add_option('wp_help_hidden', '', '', 'yes');
	}

	function wp_help_setup_remove()
	{
		delete_option('wp_help_sidebar');
		delete_option('wp_help_mobile');
		delete_option('wp_help_menu');
		delete_option('wp_help_hidden');
	}
	
	function plugin_links($links)
	{
		$settings_links = array('<a href="'.get_admin_url().'options-general.php?page=contextual-help-menu">'.__('Settings', 'ech').'</a>');
		return array_merge($settings_links, $links);
	}
	
	public function remove_meta_boxes()
	{
		add_options_page(__('Contextual help', 'ech'), __('Contextual help', 'ech'), 'administrator', 'contextual-help-menu', array($this, 'settings_page'));
		remove_meta_box('slugdiv', 'wp_help', 'normal');
	}
	
	public function settings_page()
	{
		?>
		<div class="wrap">
			<h1 class="wp-heading-inline"><?php echo __('Contextual help', 'ech'); ?></h1>
			<a href="<?php echo get_admin_url(); ?>post-new.php?post_type=wp_help" class="page-title-action"><?php _e('Add new', 'ech') ?></a>
			<h2 class="nav-tab-wrapper">
				<a href="<?php echo get_admin_url(); ?>options-general.php?page=contextual-help-menu" class="nav-tab nav-tab-active"><?php echo __('Settings', 'ech'); ?></a>
				<a href="<?php echo get_admin_url(); ?>edit.php?post_type=wp_help" class="nav-tab"><?php echo __('Help list', 'ech'); ?></a>
			</h2>
			<form method="post" action="options.php">
				<?php wp_nonce_field('update-options'); ?>

				<table class="form-table">
					<tr valign="top">
						<th scope="row"><?php _e('Hide &quot;more info&quot; sidebar', 'ech'); ?></th>
						<td>
							<label for="wp_help_sidebar_1">
								<input name="wp_help_sidebar" id="wp_help_sidebar_1" autocomplete="off" value="true" type="radio" <?php echo get_option('wp_help_sidebar') == 'true' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Enabled' , 'ech') ?>
							</label>
							<br>
							<label for="wp_help_sidebar_2">
								<input name="wp_help_sidebar" id="wp_help_sidebar_2" autocomplete="off" value="false" type="radio" <?php echo get_option('wp_help_sidebar') == 'false' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Disabled' , 'ech') ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Show &quot;help&quot; tab on mobile', 'ech'); ?></th>
						<td>
							<label for="wp_help_mobile_1">
								<input name="wp_help_mobile" id="wp_help_mobile_1" autocomplete="off" value="true" type="radio" <?php echo get_option('wp_help_mobile') == 'true' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Enabled' , 'ech') ?>
							</label>
							<br>
							<label for="wp_help_mobile_2">
								<input name="wp_help_mobile" id="wp_help_mobile_2" autocomplete="off" value="false" type="radio" <?php echo get_option('wp_help_mobile') == 'false' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Disabled' , 'ech') ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Show help list in menu', 'ech'); ?></th>
						<td>
							<label for="wp_help_menu_1">
								<input name="wp_help_menu" id="wp_help_menu_1" autocomplete="off" value="true" type="radio" <?php echo get_option('wp_help_menu') == 'true' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Enabled' , 'ech') ?>
							</label>
							<br>
							<label for="wp_help_menu_2">
								<input name="wp_help_menu" id="wp_help_menu_2" autocomplete="off" value="false" type="radio" <?php echo get_option('wp_help_menu') == 'false' ? 'checked="checked"' : ''; ?>> 
								<?php _e('Disabled' , 'ech') ?>
							</label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><?php _e('Hide tabs by slug', 'ech'); ?></th>
						<td>
							<textarea id="wp_help_hidden" name="wp_help_hidden" style="max-width: 350px;min-height: 100px;width: 100%;"><?php echo get_option('wp_help_hidden'); ?></textarea>
							<p class="description">
								<?php _e('Items must be separated by breaklines', 'ech'); ?>.
								<?php add_thickbox(); ?>
								<a href="#TB_inline?width=auto&height=auto&inlineId=wp_menu_slug_modal" name="<?php _e('Hide tabs by slug', 'ech'); ?>" class="thickbox"><?php _e('Read instructions', 'ech'); ?></a>
								<div id="wp_menu_slug_modal" style="display:none">
									<h4><?php _e('Usage', 'ech'); ?>:</h4>
									<p>
										<?php _e('Items must be separated by breaklines', 'ech'); ?> <?php _e('and need to be divided by an -> for example', 'ech'); ?> <b style="color:red"><i><?php _e('page->tab', 'ech'); ?></i></b><br>
									</p>
									<table class="widefat striped" cellpadding="0" cellspacing="0">
										<tbody>
											<tr>
												<td>dashboard->overview</td>
											</tr>
											<tr>
												<td>upload->overview</td>
											</tr>
										</tbody>
									</table>
									
									<h4><?php _e('Some tabs', 'ech'); ?>:</h4>
									<table class="widefat striped" cellpadding="0" cellspacing="0">
										<thead>
											<tr>
												<td colspan="2"><?php _e('Name'); ?></td>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>overview</td>
												<td>help-navigation</td>
											</tr>
											<tr>
												<td>help-layout</td>
												<td>help-content</td>
											</tr>
											<tr>
												<td>managing-pages</td>
												<td>screen-content</td>
											</tr>
											<tr>
												<td>action-links</td>
												<td>bulk-actions</td>
											</tr>
										</tbody>
									</table>
									<h4><?php _e('Screen list', 'ech'); ?>:</h4>
									<table class="widefat striped" cellpadding="0" cellspacing="0">
										<thead>
											<tr>
												<td><?php _e('Screen'); ?></td>
												<td><?php _e('Page'); ?></td>
											</tr>
										</thead>
										<tbody>
											<?php
											$get_cpt_args = array(
												'public'   => true,
												'_builtin' => false
											);

											$get_post_types = get_post_types($get_cpt_args, 'object'); 

											if($get_post_types)
											{
												foreach ($get_post_types as $cpt_key => $cpt_val)
												{
													$this->all_screens['edit-'.$cpt_key] = __($cpt_val->label, 'ech');
													$this->all_screens[$cpt_key] = __('Edit '.$cpt_val->label, 'ech');
												}
											}

											$screens = (array)get_post_meta($post->ID, 'wh_screen_id', true);
											?>
											<?php foreach($this->all_screens as $screen_id => $name): ?>
											<tr>
												<td><?php echo $screen_id; ?></td>
												<td><?php echo str_replace('&rarr; ','',$name); ?></td>
											</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<style type="text/css">
									body.modal-open{
										overflow-y: auto !important;
									}
									#TB_window{
										width: 90% !important;
										max-width: 600px !important;
										height: auto !important;
										position: absolute !important;
										display: inline-block !important;
										top: 30px !important;
										left: 0px !important;
										right: 0px !important;
										margin-top: 0px !important;
										margin-left: auto !important;
										margin-right: auto !important;
									}
									#TB_ajaxContent{
										width: 100% !important;
										height: auto !important;
										box-sizing: border-box !important;
									}
								</style>
							</p>
						</td>
					</tr>
				</table>
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="wp_help_sidebar,wp_help_mobile,wp_help_menu,wp_help_hidden" />
				<p>
					<input type="submit" value="<?php _e('Save Changes') ?>" class="button button-primary"/>
				</p>
			</form>
		</div>
		<?php
	}
	
	public function css_js_settings()
	{
		global $typenow;
		global $pagenow;
		
		?>
		<style type="text/css">
			<?php if(get_option('wp_help_sidebar')=='true'): ?>
			#contextual-help-back{
				right: 0px !important;
			}
			.contextual-help-sidebar{
				display: none !important;
			}
			.help-tab-content{
				margin-right: 0px !important;
			}
			<?php endif; ?>
			<?php if(get_option('wp_help_sidebar')=='true'): ?>
			@media (max-width: 782px){
				#screen-meta, 
				#screen-meta-links{
					display: block !important;
				}
				#screen-meta-links .screen-meta-toggle:not(#contextual-help-link-wrap){
					display: none !important;
				}
			}
			<?php endif; ?>
		</style>
		<script type="text/javascript">
			<?php if($typenow == 'wp_help' && $pagenow == 'edit.php'): ?>
			var wp_help_tabs = '<h2 class="nav-tab-wrapper">'+
								'	<a href="<?php echo get_admin_url(); ?>options-general.php?page=contextual-help-menu" class="nav-tab"><?php echo __('Settings', 'ech'); ?></a>'+
								'	<a href="<?php echo get_admin_url(); ?>edit.php?post_type=wp_help" class="nav-tab nav-tab-active"><?php echo __('Help list', 'ech'); ?></a>'+
								'</h2>';
			jQuery('.wrap h1.wp-heading-inline').next().after(wp_help_tabs);
			<?php endif; ?>
		</script>
		<?php
	}
	
	public function remove_tabs()
	{
		$screen = get_current_screen();
		$wp_help_hidden = str_replace(' ','',get_option('wp_help_hidden'));
		$wp_help_hidden_list = preg_split('/\r\n|\r|\n/',$wp_help_hidden);
		
		foreach($wp_help_hidden_list as $wp_help_hidden_item)
		{
			$wp_help_hidden_data = explode('->', $wp_help_hidden_item);
			
			if($screen->id == $wp_help_hidden_data[0]){
				$screen->remove_help_tab($wp_help_hidden_data[1]);
			}
		} 
	}

	public function register_post_type()
	{
		$labels = array(
			'name'                => __( 'Contextual help', 'ech' ),
			'singular_name'       => __( 'Contextual help', 'ech' ),
			'menu_name'           => __( 'Contextual help', 'ech' ),
            'parent_item_colon'   => __( 'Parent help', 'ech' ),
            'all_items'           => __( 'All help', 'ech' ),
            'view_item'           => __( 'View help', 'ech' ),
            'add_new_item'        => __( 'Add new help', 'ech' ),
            'add_new'             => __( 'Add new', 'ech' ),
            'edit_item'           => __( 'Edit help', 'ech' ),
            'update_item'         => __( 'Update help', 'ech' ),
            'search_items'        => __( 'Search help', 'ech' ),
            'not_found'           => __( 'Not found', 'ech' ),
            'not_found_in_trash'  => __( 'Not found in trash', 'ech' ),
		);
		
		$args = array(
			'labels'              	=> $labels,
			'public'              	=> false,
			'publicly_queryable'  	=> false,
			'show_ui'             	=> true,
			'show_in_menu'        	=> true,
			'query_var'           	=> true,
			'rewrite'             	=> false,
			'has_archive'         	=> false,
			'hierarchical'        	=> false,
			'supports'            	=> array( 'title', 'editor', 'author', 'revisions' ),
			'show_in_menu'  	  	=> get_option('wp_help_menu') == 'true' ? true : false,
			'show_in_nav_menus'   	=> false,
			'menu_position'		  	=> 10,
			'can_export'          	=> true,
			'exclude_from_search' 	=> true,
		);
		
		register_post_type('wp_help', $args);
	}
	
	public function add_column($columns)
	{
		$columns['page'] = __('Page', 'ech');
		$columns['roles'] = __('Roles', 'ech');
		return $columns;
	}
	
	public function column_wrap($column_name, $id)
	{
		$get_cpt_args = array(
			'public'   => true,
			'_builtin' => false
		);
		
		$get_post_types = get_post_types($get_cpt_args, 'object'); 

		if($get_post_types)
		{
			foreach ($get_post_types as $cpt_key => $cpt_val)
			{
				$this->all_screens['edit-'.$cpt_key] = __($cpt_val->label, 'ech');
				$this->all_screens[$cpt_key] = __('&rarr; Edit '.$cpt_val->label, 'ech');
			}
		}
		if($column_name === 'page')
		{
			global $post;
			
			$wh_screen_id = (array)get_post_meta($post->ID, 'wh_screen_id', true);
			$screens = '';
			
			foreach($wh_screen_id as $screen)
			{
				$screens .= $this->all_screens[$screen].', ';
			}
			
			echo rtrim($screens, ', ');
		}
		if($column_name === 'roles'){
			global $post;
			
			$wh_roles = (array)get_post_meta($post->ID, 'wh_roles', true);
			$roles = '';
			
			foreach($wh_roles as $role)
			{
				$roles .= $role == 'all' ? __('All Roles', 'ech') : translate_user_role(ucfirst($role)).', ';
			}
			echo rtrim($roles, ', ');
		}
	}
	
	public function meta_boxes()
	{
		add_meta_box('contextual-help-option', __('Settings', 'ech'), array($this, 'meta_box_options'), 'wp_help', 'side', 'default');
	}
	
	public function meta_box_options($post, $post_id)
	{
		$get_cpt_args = array(
			'public'   => true,
			'_builtin' => false
		);
		
		$get_post_types = get_post_types($get_cpt_args, 'object'); 

		if($get_post_types)
		{
			foreach ($get_post_types as $cpt_key => $cpt_val)
			{
				$this->all_screens['edit-'.$cpt_key] = __($cpt_val->label, 'ech');
				$this->all_screens[$cpt_key] = __('&rarr; Edit '.$cpt_val->label, 'ech');
			}
		}
		
		$screens = (array)get_post_meta($post->ID, 'wh_screen_id', true);
		$wh_roles = get_post_meta($post->ID, 'wh_roles', true);
		
		?>
		<p>
			<i><?php _e("Then press Cmd (Mac) or Ctrl (Win) to choose multiple options", 'ech'); ?></i>
		</p>
		
		<p>
			<label for="wh-select-screen"><?php _e('Choose a screen', 'ech'); ?>:</label>
			<br>
			<select style="width:100%" name="wh_screen_id[]" id="wh-select-screen" multiple>
				<?php foreach($this->all_screens as $screen_id => $name): ?>
				<option value="<?php echo $screen_id; ?>" <?php echo in_array($screen_id, $screens) ? 'selected' : ''; ?>><?php echo $name; ?></option>
				<?php endforeach; ?>
			</select>
		</p>
		
		<p>
			<label for="wh_roles"><?php _e('Display for', 'ech'); ?>:</label>
			<br>
			<?php if( !$wh_roles ) $wh_roles = array('all'); ?>
			<select style="width:100%" id="wh_roles" name="wh_roles[]" multiple>
				<option value="all" <?php echo in_array('all', $wh_roles) ? 'selected' : ''; ?>><?php _e('All Roles', 'ech'); ?></option>
				<?php 
				$editable_roles = get_editable_roles();
				foreach ($editable_roles as $role => $details): $name = translate_user_role($details['name'] ); ?>
				<option <?php echo in_array($role, $wh_roles) ? 'selected' : ''; ?> value="<?php echo esc_attr($role); ?>"><?php echo $name; ?></option>
				<?php  endforeach; ?>
			</select>
		</p>
		
		<p>
			<label for="wh_post_name"><?php _e('Slug'); ?>:</label>
			<br>
			<input style="width:100%" id="wh_post_name" type="text" value="<?php echo $post->post_name; ?>" size="20" name="post_name"></input>
		</p>
		<p class="description">
			<?php _e('Paste here ID tab you want to replace or leave blank to create a new one', 'ech'); ?>
		</p>
		<?php
	}
	
	public function save_post_meta($post_id)
	{
		if ($post_id === null || (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)) return;
		if (!current_user_can('edit_post', $post_id)) return;
		
		if(isset($_POST['wh_screen_id']))
		{
			$wh_screen_id = $_POST['wh_screen_id'];
			add_post_meta($post_id, 'wh_screen_id', $wh_screen_id, true) || update_post_meta($post_id, 'wh_screen_id', $wh_screen_id);
		}
		
		if(isset($_POST['wh_roles']))
		{
			$wh_roles = $_POST['wh_roles'];
			if(in_array('all', $wh_roles)) $wh_roles = array('all');
			add_post_meta($post_id, 'wh_roles', $wh_roles, true) || update_post_meta($post_id, 'wh_roles', $wh_roles);
		}
	}

	public function helper($old_help, $screen_id, $screen)
	{
		global $current_user;
		
		$args = array('posts_per_page' => -1, 'post_type' => 'wp_help');
		$posts = get_posts( $args );
		$screen->remove_help_tab('inserting-media');
		$screen->remove_help_tab('discussion-settings');
		
		foreach($posts as $row)
		{
			$post_screens = (array)get_post_meta($row->ID, 'wh_screen_id', true);
			$wh_roles = (array)get_post_meta($row->ID, 'wh_roles', true);
			if(in_array( $current_user->roles[0], $wh_roles) OR in_array('all', $wh_roles ))
			{
				$new_screen_id = sanitize_title($row->post_name);
				$row->post_content = str_replace(array('{{', '}}'), array('[', ']'), $row->post_content);
				if(in_array($screen_id, $post_screens))
				{
					$screen->add_help_tab(array('id' => $new_screen_id, 'title' => $row->post_title, 'content' => wpautop($row->post_content)));
					//$screen->set_help_sidebar( null );
				}
			}
		}
		
		return $old_help;
	}
}
new enhanced_contextual_help();
