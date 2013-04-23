var NovumWare = (function() {
	// TODO MARK: create urls that load javascript calls like popups upon page load
	'use strict';

	return new Class({

		Implements: [Options],

		plugins: null,
		fx: null,
		currentEvent: null,

		options: {
			throwErrors: true // set to false for production
		},

		// effectsOptions: { // global effects options
		// 		duration: 300,
		// 		// link: 'cancel',
		//
		// 	},

		initialize: function(options) {
			this.setOptions(options); // override default options
			if (this.options.timing) { this.timing = this.options.timing; } // override timing default
			// Fx.implement({options: this.tweenOptions}); // implement global effects options
		},

		setup: function() {
			this.fx = this.getPlugin('NWFx');
			this.plugins = this.getPlugin('NWPlugins');
		},


		// ======================================================== PUBLIC METHODS ======================================
		getPlugin: function(plugin) {
			if (!this['$'+plugin]) { // lazy instantiation of plugins
				var PluginClass = window[plugin];
				if (typeOf(PluginClass) != 'class') { this.throwError('NovumWare plugin not found: '+plugin); }
				this['$'+plugin] = new PluginClass(this.options[plugin]);
			}
			return this['$'+plugin];
		},

		callNextPlugin: function() {
			if (!this.currentEvent) { return; }
			var pluginString = this.currentEvent.getNextPlugin();
			if (pluginString) { // IF there is a plugin to call
				var pluginInfo = pluginString.split(':'); // split plugin string
				var pluginName = pluginInfo.shift();
				var plugin = $NW.getPlugin(pluginName);
				if (typeOf(plugin.handleClick) != 'function') { $NW.throwError(pluginName+' does not have method: handleClick()'); }
				plugin.handleClick(this.currentEvent.elmt, pluginInfo); // call the next plugin
			} else { this.currentEvent = null; }
		},

		// click an element
		clickElmt: function(elmt) {
			if (typeOf(elmt) == 'array' || typeOf(elmt) == 'elements') { elmt.each(function(oneElmt){ $(document.body).fireEvent('click', {target:oneElmt}); }); }
			else { $(document.body).fireEvent('click', {target: elmt}); }
		},

		injectAndFadeIn: function(elmt, target, where) {
			this.fadeIn(elmt.fade('hide').inject(target, where));
		},


		// ======================================================== PRIVATE METHODS ======================================
		getClassParams: function(elmt, className) {
			var regexp = new RegExp(className+'[:\\w]*', 'g'); // get just the passed class and params from the elmt classes
			var classParts = elmt.get('class').match(regexp)[0].split(':'); // split the class and params into an array
			classParts.shift(); // remove the class from the array
			return classParts; // return just the remaining params in an array
		},

		callCB: function(callback, callbackArguments) {
			if (!callback) { return true; } // return true if no callback given
			if (typeOf(window[callback]) != 'function') { this.throwError('Callback: '+callback+' not found'); return null; } // make sure callback exists
			if (callbackArguments && typeOf(callbackArguments) != 'array') { callbackArguments = [callbackArguments]; } // make sure arguments is an array

			var boundCallback = window[callback].pass(callbackArguments); // bond the callback with optional number of arguments
			try { if (boundCallback() === true) { return true; } } // return true if callback exists and returns true
			catch(err) { this.throwError(err); return null; } // return null if error finding callback function
			return false; // return false by default
		},

		// optionally throw an error that was caught in a try catch block
		throwError: function(error) { if (this.options.throwErrors) { throw error; } },


		// ======================================================== HELPER METHODS ======================================// format URLs in various ways
		// formatURL: function(url, format) { // format urls in various ways
// 			if (format == 'zendPopup') { return this.addURLEnding(url, 'layout=popup'); }
// 			else if (format == 'zendPopupWindow') { return this.addURLEnding(url, 'layout=popupWindow'); }
// 			else if (format == 'zendNoTop') { return this.addURLEnding(url, 'layout=no-top'); }
// 			else if (format == 'zendNoLayout') { return this.addURLEnding(url, 'layout=none'); }
// 			else if (format == 'zendJSON') { return this.addURLEnding(url, 'format=json'); }
// 			else { this.throwError('The URL format: "'+format+'" was not recognized'); return url; }
// 		},

		// add URL ending
		addURLEnding: function(url, ending) {
			var divider = '?';
			if (url.indexOf(ending) != -1) { return url; }
			if (url.indexOf('?') != -1) { divider = '&'; }
			return url + divider + ending;
		}
	});

})();