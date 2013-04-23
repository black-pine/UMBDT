var NWBubble = (function(){
	'use strict';

	return new Class({

		Implements: [Options],


		// ======================================================== SETUP METHODS ======================================
		// initialize: function(options) {},

		handleClick: function(elmt) {
			$NW.clickElmt(elmt.getParent());
		}

	});
})();
