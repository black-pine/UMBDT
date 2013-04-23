var NWExample = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWExample',

		// options: {},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			// this.setOptions(options); // override default options
		},

		setupContainer: function(container) {
			container.getElements('[class*="'+this.classPlugin+'"]').each(function(elmt) { // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		setup: function(elmt) {
			console.log(elmt);
//			var elmtOptions = {};
//			var params = $NW.getClassParams(elmt, this.classPlugin);
//			elmtOptions.type = params[this.paramPosType] || this.options.defaultType;
//			return new NWExampleElmt(elmt, elmtOptions);
		},

		handleClick: function(elmt, params) {
//			this.getNWExampleElmt(elmt).handleClick(elmt, params);
		}


		// ======================================================== PUBLIC METHODS ======================================

		// ======================================================== PRIVATE METHODS ======================================
//		getNWExampleElmt: function(elmt) {
//			var exampleElmt = elmt.retrieve('NWExampleElmt');
//			if (!exampleElmt) exampleElmt = this.setup(elmt);
//			return exampleElmt;
//		}

		// ======================================================== EVENT HANDLERS ======================================

	});
})();
