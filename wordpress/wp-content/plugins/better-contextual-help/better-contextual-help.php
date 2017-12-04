<?php
/**
 * Plugin Name: Better Contextual Help
 * Description: Extend your Dashboard Help. Display help for multiple screens and user roles.
 * Version: 1.1
 * Author: Piotr Potrebka
 * Author URI: http://potrebka.pl
 * License: GPL2
 */
class better_contextual_help {
	
	public function __construct() {
		load_plugin_textdomain('bch', false, basename( dirname( __FILE__ ) ) . '/languages' );
		
		//https://codex.wordpress.org/Plugin_API/Admin_Screen_Reference
		$this->all_screens = array(
									'dashboard' 		=> __('Dashboard', 'bch'),
									'update-core' 		=> __('&rarr; Update', 'bch'),
									'edit-post' 		=> __('Post', 'bch'),
									'post' 				=> __('&rarr; Edit Post', 'bch'),
									'edit-category' 	=> __('&rarr; Categories', 'bch'),
									'edit-post_tag' 	=> __('&rarr; Tags', 'bch'),
									'edit-page' 		=> __('Pages', 'bch'),
									'page' 				=> __('&rarr; Edit Page', 'bch'),
									'themes' 			=> __('Themes', 'bch'),
									'widgets' 			=> __('&rarr; Widgets', 'bch'),
									'nav-menus' 		=> __('&rarr; Menus', 'bch'),
									'theme-editor' 		=> __('Theme editor', 'bch'),
									'plugins' 			=> __('Plugins', 'bch'),
									'plugin-install' 	=> __('&rarr; Plugin Install', 'bch'),
									'plugin-editor' 	=> __('&rarr; Plugin Editor', 'bch'),
									'users' 			=> __('Users', 'bch'),
									'user' 				=> __('&rarr; Add User', 'bch'),
									'user-edit' 		=> __('&rarr; Edit User', 'bch'),
									'profile' 			=> __('&rarr; Profile', 'bch'),
									'tools' 			=> __('Tools', 'bch'),
									'import' 			=> __('&rarr; Import', 'bch'),
									'export' 			=> __('&rarr; Export', 'bch'),
									'options-general' 	=> __('Settings', 'bch'),
									'edit-wp_help' 		=> __('&rarr; Contextual Help', 'bch')
								);
		
		add_filter( 'contextual_help', array( $this, 'helper' ), 1, 3 );
		add_action( 'init', array( $this, 'register_post_type' ) );
		add_action( 'add_meta_boxes', array( $this, 'meta_boxes' ) );
		add_action( 'save_post_wp_help', array( $this, 'save_post_meta' ), 10 );
		add_filter( 'manage_wp_help_posts_columns', array( $this, 'add_column' ), 5 );
		add_action( 'manage_wp_help_posts_custom_column', array( $this, 'column_wrap' ), 5, 2 );
		add_action( 'admin_menu', array( $this, 'remove_meta_boxes' ) );
	}
	
	public function remove_meta_boxes() {
		remove_meta_box('slugdiv', 'wp_help', 'normal');
	}

	public function register_post_type() {
		
		$labels = array(
			'name'                => __( 'Contextual Help', 'bch' ),
			'singular_name'       => __( 'Contextual Help', 'bch' ),
			'menu_name'           => __( 'Contextual Help', 'bch' )
		);
		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => false,
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => array( 'title', 'editor', 'author', 'revisions' ),
			'show_in_menu'  	 => 'options-general.php',
			'show_in_nav_menus'  => false,
			'menu_position'		 => 10,
			'can_export'         => true,
			'exclude_from_search'=> true,
		);
		register_post_type( 'wp_help', $args );
	}
	
	public function add_column( $columns ){
		$columns['page'] = __( 'Page', 'bch' );
		$columns['roles'] = __( 'Roles', 'bch' );
		return $columns;
	}
	
	public function column_wrap( $column_name, $id ){
		$get_cpt_args = array(
			'public'   => true,
			'_builtin' => false
		);
		$get_post_types = get_post_types( $get_cpt_args, 'object' ); 

		if ($get_post_types){
			foreach ($get_post_types as $cpt_key => $cpt_val){
				$this->all_screens['edit-'.$cpt_key] = __($cpt_val->label, 'bch');
				$this->all_screens[$cpt_key] = __('&rarr; Edit '.$cpt_val->label, 'bch');
			}
		}
		if( $column_name === 'page' ){
			global $post;
			$wh_screen_id = (array) get_post_meta( $post->ID, 'wh_screen_id', true );
			$screens = '';
			foreach( $wh_screen_id as $screen ) {
				$screens .= $this->all_screens[$screen] . ', ';
				
			}
			echo rtrim( $screens, ', ' );
		}
		if( $column_name === 'roles' ){
			global $post;
			$wh_roles = (array) get_post_meta( $post->ID, 'wh_roles', true );
			$roles = '';
			foreach( $wh_roles as $role ) {
				$roles .= $role == 'all' ? __('All Roles', 'bch') : translate_user_role( ucfirst( $role ) ) . ', ';
				
			}
			echo rtrim( $roles, ', ' );
		}
	}
	
	public function meta_boxes() {
		add_meta_box('contextual-help-option', __('Settings', 'bch'), array( $this, 'meta_box_options' ), 'wp_help', 'side', 'default');
	}
	
	public function meta_box_options( $post, $post_id ) {
		$get_cpt_args = array(
			'public'   => true,
			'_builtin' => false
		);
		$get_post_types = get_post_types( $get_cpt_args, 'object' ); 

		if ($get_post_types){
			foreach ($get_post_types as $cpt_key => $cpt_val){
				$this->all_screens['edit-'.$cpt_key] = __($cpt_val->label, 'bch');
				$this->all_screens[$cpt_key] = __('&rarr; Edit '.$cpt_val->label, 'bch');
			}
		}
		$screens = (array) get_post_meta( $post->ID, 'wh_screen_id', true );
		$wh_roles = get_post_meta( $post->ID, 'wh_roles', true );
	?>
	
		<p><i><?php _e("Then press Cmd (Mac) or Ctrl (Win) to choose multiple options", 'bch'); ?></i></p>
		
		<p><label for="wh-select-screen"><?php _e('Choose a screen', 'bch'); ?></label><br/>
		<select style="width:100%" name="wh_screen_id[]" id="wh-select-screen" multiple>
		<?php foreach( $this->all_screens as $screen_id=>$name ): ?>
			<option value="<?php echo $screen_id; ?>" <?php echo in_array($screen_id, $screens) ? 'selected' : ''; ?>><?php echo $name; ?></option>
		<?php endforeach; ?>
		</select>
		</p>
		
		<p><label for="wh_roles"><?php _e('Display for', 'bch'); ?></label><br/>
		<?php if( !$wh_roles ) $wh_roles = array('all'); ?>
		
		<select style="width:100%" id="wh_roles" name="wh_roles[]" multiple>
		<option value="all" <?php echo in_array('all', $wh_roles) ? 'selected' : ''; ?>><?php _e('All Roles', 'bch'); ?></option>
		<?php 
		$editable_roles = get_editable_roles();
		foreach ( $editable_roles as $role => $details ) {
			$name = translate_user_role($details['name'] );
		?>
		<option <?php echo in_array($role, $wh_roles) ? 'selected' : ''; ?> value="<?php echo esc_attr($role); ?>"><?php echo $name; ?></option>
		<?php  } ?>
		</select></p>
		
		<p><label for="wh_post_name"><?php _e('Slug'); ?></label><br/>
		<input style="width:100%" id="wh_post_name" type="text" value="<?php echo $post->post_name; ?>" size="20" name="post_name"></input></p>
		<p class="description"><?php _e("Paste here ID tab you want to replace or leave blank", 'bch'); ?></p>
	<?php
	}
	
	public function save_post_meta( $post_id ) {
		if ( $post_id === null || ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ) return;
		if ( !current_user_can( 'edit_post', $post_id ) ) return;
		
		if( isset( $_POST['wh_screen_id'] ) ) {
			$wh_screen_id = $_POST['wh_screen_id'];
			add_post_meta( $post_id, 'wh_screen_id', $wh_screen_id, true ) || update_post_meta( $post_id, 'wh_screen_id', $wh_screen_id );
		}
		
		if( isset( $_POST['wh_roles'] ) ) {
			$wh_roles = $_POST['wh_roles'];
			if( in_array( 'all', $wh_roles ) ) $wh_roles = array('all');
			add_post_meta( $post_id, 'wh_roles', $wh_roles, true ) || update_post_meta( $post_id, 'wh_roles', $wh_roles );
		}
	}

	public function helper( $old_help, $screen_id, $screen )
	{
		global $current_user;
		
		$args = array( 'posts_per_page' => -1, 'post_type'=> 'wp_help' );
		$posts = get_posts( $args );
		$screen->remove_help_tab('inserting-media');
		$screen->remove_help_tab('discussion-settings');
		foreach($posts as $row ) {
			$post_screens = (array) get_post_meta( $row->ID, 'wh_screen_id', true );
			$wh_roles = (array) get_post_meta( $row->ID, 'wh_roles', true );
			if( in_array( $current_user->roles[0], $wh_roles ) OR in_array( 'all', $wh_roles ) ) {
				$new_screen_id = sanitize_title( $row->post_name );
				$row->post_content = str_replace( array('{{', '}}'), array('[', ']'), $row->post_content);
				if( in_array( $screen_id, $post_screens ) ) {
					$screen->add_help_tab( array('id' => $new_screen_id, 'title' => $row->post_title, 'content' => wpautop($row->post_content) ) );
					//$screen->set_help_sidebar( null );
				}
			}
		}
		return $old_help;
	}

}
new better_contextual_help();