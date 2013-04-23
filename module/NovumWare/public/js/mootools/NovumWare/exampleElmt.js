var NWExampleElmt = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWExampleElmt',

		elmt: null,


		// ======================================================== SETUP METHODS ======================================
		initialize: function(elmt, options) {
			this.setOptions(options);
			this.elmt = elmt;
			this.elmt.store(this.classPlugin, this);
		}


		// ======================================================== PUBLIC METHODS ======================================


		// ======================================================== PRIVATE METHODS ======================================


		// ======================================================== EVENT HANDLERS ======================================

	});
})();