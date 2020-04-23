<?php
/**
 * @var string $moduleTabUrl Fully qualified URL of the tab.
 */

?>
<div id="ame-tweak-manager">
	<?php require AME_ROOT_DIR . '/modules/actor-selector/actor-selector-template.php'; ?>

	<div data-bind="foreach: sections">
		<div class="ame-twm-section" data-bind="css: { 'ws-ame-closed-postbox': !isOpen() }">
			<div class="ws-ame-postbox-header">
				<h3 data-bind="text: label"></h3>
				<button class="ws-ame-postbox-toggle" data-bind="click: toggle"></button>
			</div>
			<div class="ws-ame-postbox-content">
				<div data-bind="template: {name: 'ame-tweak-item-template', foreach: tweaks}"></div>
			</div>
		</div>
	</div>

	<form method="post" data-bind="submit: saveChanges" class="ame-twm-save-form" action="<?php
	echo esc_attr(add_query_arg(array('noheader' => '1'), $moduleTabUrl));
	?>">

		<?php
		submit_button(
			'Save Changes',
			'primary',
			'submit',
			true,
			array(
				'data-bind' => 'disable: isSaving',
				'disabled'  => 'disabled',
			)
		);
		?>

		<input type="hidden" name="action" value="ame-save-tweak-settings">
		<?php wp_nonce_field('ame-save-tweak-settings'); ?>

		<input type="hidden" name="settings" value="" data-bind="value: settingsData">
		<input type="hidden" name="selected_actor" value="" data-bind="value: selectedActorId">
	</form>
</div>

<div style="display: none;">
	<template id="ame-tweak-item-template">
		<div class="ame-twm-tweak">
			<label class="ame-twm-tweak-label">
				<input type="checkbox" data-bind="checked: isChecked, indeterminate: isIndeterminate">
				<span data-bind="text: label"></span>
			</label>

			<!-- ko if: (children.length > 0) -->
			<div class="ame-twm-tweak-children"
			     data-bind="template: {name: 'ame-tweak-item-template', foreach: children}"></div>
			<!-- /ko -->
		</div>
	</template>
</div>