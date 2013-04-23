var NWInit = (function() {
	'use strict';

	return new Class({

		Implements: [Options],

		initCBAttr: 'data-nwInitCB',

		options: {},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt) {
			if ($NW.callCB(elmt.get(this.initCBAttr), elmt)) { $NW.callNextPlugin(); }
		}

	});

})();
