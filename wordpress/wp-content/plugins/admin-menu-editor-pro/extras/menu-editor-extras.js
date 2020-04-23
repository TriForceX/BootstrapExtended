'use strict';
jQuery(function ($) {
	$(document).on('filterMenuFields.adminMenuEditor', function(event, knownMenuFields, baseField) {
		var scrollCheckboxField = $.extend({}, baseField, {
			caption: 'Hide the frame scrollbar',
			advanced: true,
			type: 'checkbox',
			standardCaption: false,

			visible: function(menuItem) {
				return wsEditorData.wsMenuEditorPro && (AmeEditorApi.getFieldValue(menuItem, 'open_in') === 'iframe');
			},

			display: function(menuItem, displayValue) {
				if (displayValue === 0 || displayValue === '0') {
					displayValue = false;
				}
				return displayValue;
			}
		});

		//Insert this field after the "iframe_height" field.
		//To do that, we back up and delete all properties.
		var backup = $.extend({}, knownMenuFields);
		$.each(backup, function(key) {
			delete knownMenuFields[key];
		});
		//Then re-insert all of the properties in the desired order.
		$.each(backup, function(key, value) {
			knownMenuFields[key] = value;
			if (key === 'iframe_height') {
				knownMenuFields['is_iframe_scroll_disabled'] = scrollCheckboxField;
			}
		});
	});
});