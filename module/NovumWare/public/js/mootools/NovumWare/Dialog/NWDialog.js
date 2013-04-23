var NWDialog = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		htmlDialog: $j("<div id='nw-dialog' style='display:none' title='Dialog Title'><span class='nw-dialog-messageReplace' /></div>"),

		classMessageReplace: 'nw-dialog-messageReplace',

		dataTitle: 'data-nwDialog-title',
		dataContent: 'data-nwDialog-html',
		dataPreDCB: 'data-nwDialog-preDCB',

		options: {
			defaultTitle: 'Confirm',
			defaultHTML: 'Are you sure?'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
			this.htmlDialog.appendTo(document.body); // put the dialog HTML in the DOM
		},

		handleClick: function(elmt) {
			if ($NW.callCB(elmt.get(this.dataPreDCB), elmt)) { this.show(elmt); } // show dialog if preDispatchCallback returns exactly true
		},


		// ======================================================== PUBLIC METHODS ======================================
		/**
		 * Displays a dialog for an element.
		 *
		 * @param Object elmt The element to show the dialog for.
		 * @param string confirmBtnCallback The function to call when the dialog confirm button is clicked.
		 * @return void
		 */
		show: function(elmt) {
			var dialogTitle = elmt.get(this.dataTitle) || this.options.defaultTitle; // get dialog title
			var dialogHTML = elmt.get(this.dataContent) || this.options.defaultHTML; // get dialog html
			this.showMessage(dialogTitle, dialogHTML, function(){$NW.callNextPlugin();}); // delegate to other method
		},

		showMessage: function(dialogTitle, dialogHTML, confirmBtnCallback) {
			this.htmlDialog.find('.nw-dialog-messageReplace').replaceWith(dialogHTML); // insert the message
			this.htmlDialog.dialog({
				resizable: false,
				modal: true,
				title: dialogTitle,
				zIndex: 6000,
				buttons: {
					Yes : function() {
						$j(this).dialog('close');
						if (confirmBtnCallback) {
							try{ confirmBtnCallback(); }
							catch(err){ $NW.throwError(err); }
						}
					},
					Cancel: function() { $j(this).dialog('close'); }
				}
			});
		}

	});
})();
