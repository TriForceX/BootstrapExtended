<?php
/**
 * Implements the "admin-menu-editor" WP CLI command.
 */
class ameWpCliCommand extends WP_CLI_Command {

	/**
	 * Activate a license key on the site.
	 *
	 * ## OPTIONS
	 *
	 * <license-key>
	 * : The license key to use. This is usually a 32 character code, all uppercase.
	 *
	 * @synopsis <license-key>
	 *
	 * @subcommand activate-license
	 * @param array $args
	 */
	public function activateLicense($args) {
		if (count($args) < 1) {
			WP_CLI::error('You must specify a license key');
			return;
		}

		$licenseManager = $this->getLicenseManager();
		$result = $licenseManager->licenseThisSite($args[0]);
		if ( is_wp_error($result) ) {
			WP_CLI::error(sprintf('%s [%s]', $result->get_error_message(), $result->get_error_code()));
		} else {
			WP_CLI::success('Success! This site is now licensed.');
		}
	}

	/**
	 * Remove the current license from the site.
	 * @subcommand deactivate-license
	 */
	public function deactivateLicense() {
		$licenseManager = $this->getLicenseManager();
		if ( !$licenseManager->hasExistingLicense() ) {
			WP_CLI::error('This site does not have a license, so you can\'t deactivate the license.');
			return;
		}

		$result = $licenseManager->unlicenseThisSite();
		if ( is_wp_error($result) ) {
			WP_CLI::error(sprintf('%s [%s]', $result->get_error_message(), $result->get_error_code()));
		} else {
			WP_CLI::success('Success! The current license has been removed.');
		}
	}

	/**
	 * Display information about the currently active license.
	 * @subcommand license-status
	 */
	public function licenseStatus() {
		$licenseManager = $this->getLicenseManager();

		if ( $licenseManager->hasExistingLicense() ) {
			$license = $licenseManager->getLicense();
			$expiresOn = $license->get('expires_on');
			$licenseKey = $licenseManager->getLicenseKey();
			$token = $licenseManager->getSiteToken();

			$info = array(
				'License found' => 'Yes',
				'Licensed URL' => $license->get('site_url', 'N/A'),
				'Status' => $license->getStatus(),
				'Expires' => empty($expiresOn) ? 'Never' : $expiresOn,
				'License key' => $licenseKey ? $licenseKey : 'Not stored in the WordPress database',
				'Site token' => $token ? $token : 'None',
			);
		} else {
			$info = array(
				'License found' => 'No'
			);
		}

		foreach($info as $name => $value) {
			WP_CLI::line(sprintf(
				'%s: %s',
				str_pad($name, 14, ' '),
				$value
			));
		}
	}

	/**
	 * Export the admin menu configuration as JSON.
	 *
	 * ## OPTIONS
	 *
	 * [<file>]
	 * : Export file name.
	 *
	 * [--output]
	 * : Dump the export data to the console instead of saving it as a file.
	 *
	 * [--file=<file>]
	 * : An alternative way to specify the export file name.
	 *
	 * @param array $args
	 * @param array $assoc_args
	 */
	public function export($args, $assoc_args) {
		if ( empty($assoc_args['file']) && !empty($args[0]) ) {
			$assoc_args['file'] = $args[0];
		}

		if ( empty($assoc_args['file']) && empty($assoc_args['output']) ) {
			WP_CLI::error('You must specify either a file name or the "--output" parameter.');
			return;
		}

		$menuEditor = $this->getMenuEditor();
		$customMenu = $menuEditor->load_custom_menu();

		if ( empty($customMenu) ) {
			WP_CLI::error('Nothing to export. This site is using the default admin menu.');
			return;
		}

		$json = ameMenu::to_json(ameMenu::compress($customMenu));
		if ( !empty($assoc_args['output']) ) {
			WP_CLI::line($json);
		} else {
			$fileName = $assoc_args['file'];
			$bytesWritten = file_put_contents($fileName, $json);
			if ( $bytesWritten > 0 ) {
				WP_CLI::success(sprintf('Export completed. %d bytes written.', $bytesWritten));
			} else {
				WP_CLI::error('Failed to write the file.');
			}
		}
	}

	/**
	 * Import admin menu configuration from a JSON file.
	 *
	 * ## OPTIONS
	 *
	 * <file>
	 * : Import file name.
	 *
	 * @param array $args
	 */
	public function import($args) {
		$fileName = $args[0];
		if ( !is_readable($fileName) ) {
			WP_CLI::error('The file doesn\'t exist or isn\'t readable.');
			return;
		}

		$json = file_get_contents($fileName);
		try {
			$loadedMenu = ameMenu::load_json($json);
		} catch (Exception $ex) {
			WP_CLI::error($ex->getMessage());
			return;
		}

		$menuEditor = $this->getMenuEditor();
		$menuEditor->set_custom_menu($loadedMenu);
		WP_CLI::success('Import completed.');
	}

	/**
	 * @return WPMenuEditor
	 */
	private function getMenuEditor() {
		return $GLOBALS['wp_menu_editor'];
	}

	/**
	 * @return Wslm_LicenseManagerClient
	 */
	private function getLicenseManager() {
		return $GLOBALS['ameProLicenseManager'];
	}
}

WP_CLI::add_command('admin-menu-editor', 'ameWpCliCommand');