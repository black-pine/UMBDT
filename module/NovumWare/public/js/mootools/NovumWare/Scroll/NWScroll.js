var NWScroll = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		paramPosTarget: 0,

		options: {},

		scrollTween: { // scroll tween options
			duration: 200,
			link: 'cancel',
			transition: 'sine:out'
		},

		windowScroll: null, // the window scroll Fx.Scroll object (setup in this.initialize())


		initialize: function(options) {
			this.setOptions(options); // override default options
			this.windowScroll = new Fx.Scroll(window, this.scrollTween); // set up the windows Fx.Scroll object
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt, params) {
			this.scrollWindow(params[this.paramPosTarget]);
			$NW.callNextPlugin();
		},

		scrollWindow: function(target) {
			if (!target) { $NW.throwError('No target was provided to scroll to'); return; }
			if (target == 'top') { this.windowScroll.toTop(); }
			else if (target == 'bottom') { this.windowScroll.toBottom(); }
			else { this.windowScroll.toElement(target); } // scroll to an element ID
		}

	});
})();
