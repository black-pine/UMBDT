var NWPopup = (function(){
	// TODO MARK: make our own popup plugin instead of using a jQuery one
	// TODO MARK: remove the url bar from popup windows
	'use strict';

	return new Class({

		Implements: [Options],

		paramPosType: 0,
		paramTypeWindow: 'window',
		paramPosWindowName: 1,

		dataPreDCB: 'data-nwPopup-preDCB',

		options: {},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt, params) {
			var preDCB = elmt.get(this.dataPreDCB); // get predispatch callback
			if (!$NW.callCB(preDCB, elmt)) { return false; } // perform a predispatch call

			var url = elmt.get('href'); // get the url to load

			if (params[this.paramPosType] == this.paramTypeWindow) {
				var windowName = params[this.paramPosWindowName];
				this.showWindow(url, windowName);
			} else { this.show(url); }
		},

		/**
		 * Popup a url in a javscript popup. (delegates to jQuery fancybox).
		 *
		 * @param string url The url to load into the popup.
		 * @param function onComplete The function to call once the content has been loaded.
		 * @return void
		 */
		show: function(url) {
			if (!url) { $NW.throwError('No url was provided'); return; } // make sure a url was passed

			var fancyboxObject = {
				href: url
			};

			var options = {
				type: 'ajax',
				scrolling: 'no',
				afterShow: function(){ // open fancybox with the url
					$NW.getPlugin('NWPlugins').setupContainer($$('fancybox-inner'));
					$NW.getPlugin('NWLoadReplaces').load($$('.fancybox-inner')[0], true); // start loading the replaces
				}
			};
			$j.fancybox.open(fancyboxObject, options);
			$NW.callNextPlugin();
		},

		// close the popup
		close: function() {
			$j.fancybox.close();
		},

		// create a new popup window
		showWindow: function(url, windowName) {
			if (!url) { $NW.throwError('No url was provided'); return; } // make sure a url was passed
			windowName = windowName || 'Popup';
			var options = 'width=1080,height=700,resizable=0,scrollbars=1,toolbar=0,status=0';
			var popWindow = window.open(url, windowName, options);
			popWindow.focus();
			$NW.callNextPlugin();
		}

	});
})();
