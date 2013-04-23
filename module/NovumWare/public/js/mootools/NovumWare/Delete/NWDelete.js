var NWDelete = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		paramPosSelector: 0,

		options: {},


		// ======================================================== SETUP METHODS ======================================		
		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		/**
		 * Looks up the DOM tree for the first parent that matches the given selector, and deletes it
		 * 
		 * @param Object elmt The element to delete, or who's parent to delete
		 * @return void
		 */
		handleClick: function(elmt, params) {
			var onComplete = (function(){
				$NW.callNextPlugin();
			});
			var selector = params[this.paramPosSelector]; // get the selector
			if (!selector) { $NW.fx.fadeOut(elmt, {destroy:true, onComplete:onComplete}); } // fade out and delete the elmt
			else { $NW.fx.fadeOut(elmt.getParent(selector), {destroy:true, onComplete:onComplete}); } // fade out and delete the parent elmt
		}

	});
})();
