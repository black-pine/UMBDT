var NWUpload = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWUpload',

		// options: {},


		// ======================================================== SETUP METHODS ======================================
		// initialize: function(options) {
			// this.setOptions(options); // override default options
		// },

		setupContainer: function(container) {
			container.getElements('.'+this.classPlugin).each(function(elmt) { // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		setup: function(form) {
			return new NWUploadElmt(form);
		}

		// handleClick: function(elmt) {
			// handle a click
		// }


		// ======================================================== PUBLIC METHODS ======================================

		// ======================================================== PRIVATE METHODS ======================================

		// ======================================================== EVENT HANDLERS ======================================

	});
})();
