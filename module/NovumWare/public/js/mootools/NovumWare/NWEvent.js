var NWEvent = (function(){
	'use strict';

	return new Class({

		toCall: [], // an array of plugins to call
		elmt: null, // the plugin elmt that fired the NWEvent
		originalEvent: null, // the event that was used to create the NWEvent
		clickedElmt: null, // the elmt that was actually clicked

		initialize: function(event, fireElmt){
			if (event) {
				this.originalEvent = event;
				this.clickedElmt = event.target;
			}
			this.elmt = fireElmt;
		},


		// ======================================================== PUBLIC METHODS ======================================
		getNextPlugin: function() {
			if (this.toCall.length) { return this.toCall.shift(); }
			else { return null; }
		}

	});

})();
