<?php

/*
  WPFront User Role Editor Plugin
  Copyright (C) 2014, WPFront.com
  Website: wpfront.com
  Contact: syam@wpfront.com

  WPFront User Role Editor Plugin is distributed under the GNU General Public License, Version 3,
  June 2007. Copyright (C) 2007 Free Software Foundation, Inc., 51 Franklin
  St, Fifth Floor, Boston, MA 02110, USA

  THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
  ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
  WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
  DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
  ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
  (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
  LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
  ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
  (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
  SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

if (!defined('ABSPATH')) {
    exit();
}

require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

if (!class_exists('WPFront_User_Role_Editor_Nav_Menu_Walker')) {

    /**
     * Create HTML list of nav menu input items.
     *
     * Copied from nav-menu.php
     */
    class WPFront_User_Role_Editor_Nav_Menu_Walker extends Walker_Nav_Menu_Edit {
	
        /**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el()
	 * @since 3.0.0
	 *
	 * @global int $_wp_nav_menu_max_depth
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   Not used.
	 * @param int    $id     Not used.
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
            //controls
            $item_id = esc_attr( $item->ID );
            ob_start();
            do_action( 'wp_nav_menu_item_custom_fields', $item_id, $item, $depth, $args );
            $custom = ob_get_clean();
            
            $parent_output = '';
            parent::start_el($parent_output, $item, $depth, $args, $id);
            
            $divider = '<fieldset class="field-move';
            $parts = explode($divider, $parent_output);
            $merge = implode($custom . $divider, $parts);
            $parent_output = $merge;
            
            //title
            $divider = '<span class="item-controls">';
            $parts = explode($divider, $parent_output);
            //remove last </span>
            $index = strrpos($parts[0], '</span>');
            $parts[0] = substr($parts[0], 0, $index);
            
            ob_start();
            do_action( 'wp_nav_menu_item_title_user_restriction_type', $item_id, $item, $depth, $args );
            $title = ob_get_clean();
            
            $merge = implode($title . '</span>' . $divider, $parts);
            
            $output .= $merge;
	}

    } // Walker_Nav_Menu_Edit

}