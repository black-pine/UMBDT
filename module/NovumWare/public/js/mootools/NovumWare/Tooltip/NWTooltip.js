var NWTooltip = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWTooltip',
		paramPosType: 0,

		options: {
			defaultType: 'hover'
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		setup: function(elmt) {
			var elmtOptions = {};
			var params = $NW.getClassParams(elmt, this.classPlugin); // get plugin class params
			elmtOptions.type = params[this.paramPosType] || this.options.defaultType; // set type of Tooltip
			return new NWTooltipElmt(elmt, elmtOptions);
		},

		setupContainer: function(container) {
			container.getElements('[class*="'+this.classPlugin+'"]').each(function(elmt){ // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		handleClick: function(elmt) {
			this.getNWTooltipElmt(elmt).onClick();
			$NW.callNextPlugin();
		},


		// ======================================================== PRIVATE METHODS ======================================
		getNWTooltipElmt: function(elmt) {
			return elmt.retrieve('NWTooltipElmt');
		}

	});

})();
