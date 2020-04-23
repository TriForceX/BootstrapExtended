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

if (!class_exists('WPFront_User_Role_Editor_Shortcodes')) {

    /**
     * Main class of WPFront User Role Editor Shortcodes
     *
     * @author Syam Mohan <syam@wpfront.com>
     * @copyright 2014 WPFront.com
     */
    class WPFront_User_Role_Editor_Shortcodes extends WPFront_User_Role_Editor_Controller_Base {
        
        const CURRENT_USER_ROLES = 'wpfront_ure_current_user_roles';
        
        public function __construct($main) {
            parent::__construct($main);
            
            add_action('plugins_loaded', array($this, 'plugins_loaded'));
        }
        
        public function plugins_loaded() {
            add_shortcode(self::CURRENT_USER_ROLES, array($this, 'process_current_user_roles'));
        }
        
        public function process_current_user_roles($atts, $content, $shortcode) {
            if(!is_user_logged_in()) {
                return '';
            }
            
            $atts = shortcode_atts(array('label' => $this->__('Current Roles: ')), $atts, $shortcode);
            $label = $atts['label'];
            
            $user = wp_get_current_user();
            if(empty($user->roles)) {
                $roles_text = $this->__('None');
            } else {
                $roles = $user->roles;
                global $wp_roles;
                $role_names = $wp_roles->role_names;
                
                $names = array();
                foreach ($roles as $r) {
                    if(!empty($role_names[$r])) {
                        $names[] = $role_names[$r];
                    }
                }
                
                $roles_text = implode(', ', $names);
            }
            
            return $label . $roles_text;
        }

    }

}
