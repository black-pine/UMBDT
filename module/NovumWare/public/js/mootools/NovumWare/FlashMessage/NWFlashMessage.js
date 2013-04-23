// TODO make lots of flash messages call in succession, not overwrite
var NWFlashMessage = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		dataMessage: 'data-nwFlashMessage-message',

		classFlashMessage: 'nw-flashMessage',
		flashMessageElmt: Elements.from("<div class='nw-flashMessage'></div>")[0],

		classSuccess: 'alert-success',
		classError: 'alert-error',

		options: {
			errorMessage: 'Something went wrong!'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
			this.flashMessageElmt.fade('hide').inject(document.body); // put the flash message HTML in the DOM
		},

		handleClick: function(elmt) {
			var message = elmt.get(this.dataMessage);
			if (message) { this.show(message); }
		},


		// ======================================================== PUBLIC METHODS ======================================
		show: function(message) {
			this.flashMessageElmt.set('html', message);
			(function(){this.flashMessageElmt.fade('in').pauseFx(2000).fade('out');}.bind(this)).delay(500); // add image to parent and show
		},

		showSuccessMessage: function(message) {
			this.flashMessageElmt.removeClass(this.classError).addClass(this.classSuccess);
			this.show(message);
		},

		showErrorMessage: function(message) {
			this.flashMessageElmt.removeClass(this.classSuccess).addClass(this.classError);
			this.show(message);
		},

		/**
		 * Flashes a generic error message to the screen. (delegates to self.show());
		 *
		 * @return void
		 */
		showError: function() { this.show(this.options.errorMessage); } // flash a generic error message

	});
})();
