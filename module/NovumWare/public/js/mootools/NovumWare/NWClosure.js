var NWClosure = (function() {
	'use strict';

	return new Class({

		Implements: [Options],

		closureCBAttr: 'data-nwClosureCB',

		options: {
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt) {
			if ($NW.callCB(elmt.get(this.closureCBAttr), elmt)) { $NW.callNextPlugin(); }
		}

	});

})();
