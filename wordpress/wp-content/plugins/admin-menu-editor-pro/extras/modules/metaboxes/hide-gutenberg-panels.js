'use strict';

(
	/**
	 * @param {Object} data
	 * @param {Array} data.panelsToRemove List of Gutenberg panels to remove.
	 */
	function (data) {
		if (typeof data['panelsToRemove'] === 'undefined') {
			return;
		}

		for (var i = 0; i < data.panelsToRemove.length; i++) {
			// noinspection JSUnresolvedFunction
			wp.data.dispatch('core/edit-post').removeEditorPanel(data.panelsToRemove[i]);
		}
	}
)(window['wsAmeGutenbergPanelData'] || {});