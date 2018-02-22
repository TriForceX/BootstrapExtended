<?php
if ( class_exists('WP_Admin_bar') ) {

	class ameDummyAdminBar extends WP_Admin_Bar {
		public function render() {
			//Set up internal data structures in case some plugin wants to use them.
			$this->_bind();
			//Don't actually render anything.
		}
	}

}
