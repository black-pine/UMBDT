var NWHint = (function(){
	// TODO MARK: add inverted styling
	// TODO MARK: need to build in options for carious positioning
	// TODO MARK: fix the need to add RialtoLink to nw-hint-triggerClosure elmts
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWHint',
		paramPosType: 0,

		options: {
			defaultType: 'hover'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		setup: function(elmt) {
			var elmtOptions = {};
			var params = $NW.getClassParams(elmt, this.classPlugin); // get plugin class params
			elmtOptions.type = params[this.paramPosType] || this.options.defaultType;
			return new NWHintElmt(elmt, elmtOptions);
		},

		setupContainer: function(container) {
			container.getElements('[class*="'+this.classPlugin+'"]').each(function(elmt){ // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		handleClick: function(elmt) {
			this.getNWHintElmt(elmt).onClick();
			$NW.callNextPlugin();
		},


		// ======================================================== PRIVATE METHODS ======================================
		getNWHintElmt: function(elmt) {
			return elmt.retrieve('NWHintElmt');
		}

	});
})();
