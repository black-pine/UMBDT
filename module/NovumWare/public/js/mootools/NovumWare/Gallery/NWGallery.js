var NWGallery = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWGallery',

		paramPosType: 0,

		options: {
			defaultType: 'popup'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		setupContainer: function(container) {
			container.getElements('[class*="'+this.classPlugin+'"]').each(function(elmt) { // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		setup: function(elmt) {
			var galleryOptions = {};
			var params = $NW.getClassParams(elmt, this.classPlugin);
			galleryOptions.type = params[this.paramPosType] || this.options.defaultType;
			return new NWGalleryElmt(elmt, galleryOptions);
		}

		// ======================================================== PUBLIC METHODS ======================================

		// ======================================================== PRIVATE METHODS ======================================

		// ======================================================== EVENT HANDLERS ======================================

	});
})();
