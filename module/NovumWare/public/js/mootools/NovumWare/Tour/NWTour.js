var NWTour = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWTour',

		dataNextClickSelector: 'data-nwTour-next',
		dataAppendToURL: 'data-nwTour-appendToURL',

		options: {
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== SETUP METHODS ======================================
		handleClick: function(elmt) {
			if (elmt.nodeName == 'A' && elmt.get(this.dataAppendToURL)) {
				elmt.set('href', elmt.get('href')+elmt.get(this.dataAppendToURL));
				elmt.removeClass(this.classPlugin);
				elmt.addClass('NWLink');
				$NW.clickElmt(elmt);
			} else {
				var nextClickSelector = elmt.get(this.dataNextClickSelector);
				if (!nextClickSelector) { $NW.throwError('No selector was provided to click'); }
				$NW.clickElmt($$(nextClickSelector));
				$NW.callNextPlugin();
			}
		}


		// ======================================================== PUBLIC METHODS ======================================

	});

})();
