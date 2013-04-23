var NWPlugins = (function() {
	'use strict';

	return new Class({

		Implements: [Options],

		selectorString: '[class*="NW"]',
		pluginsRegex: /NW[\w:]*/g,

		// ignoreNextClickEvent: false,

		options: {
			setupPlugins: ['NWDatePicker', 'NWImageBook', 'NWTooltip', 'NWHint', 'NWTabs', 'NWRolloverImage', 'NWUpload', 'NWGallery', 'NWForm'],
			noClickClasses:	['NWUpload', 'NWGallery', 'NWDatePicker'], // classes that shouldn't fire the default rialto click handler'
			clickOnLoadClass: 'nw-clickOnLoad' // class to make elmt auto click on page or partial load
		},

		initialize: function(options) {
			this.setOptions(options);

			var body = $(document.body);
			body.addEvent('click:relay('+this.selectorString+':not(form))', this.handleClick.bind(this)); // setup generic delegated click listener
			body.addEvent('submit:relay('+this.selectorString+')', this.handleClick.bind(this)); // setup generic form submit listener

			$NW.getPlugin('NWLoadingImage'); // get rialtoLoadingImage plugin to initialize it

			this.setupContainer(body);

			// var rialtoLoadReplaces = $Rialto.getPlugin('RialtoLoadReplaces'); // get RialtoLoadReplaces plugin
//			$$('.'+this.options.setupOnLoadClass).each(function(elmt) { this.setupContainer(elmt); }.bind(this)); // setup elmts that need to be setup upon load
		},

		setupContainer: function(container) {
			// if (!this.options.setupPlugins) { return; } // make sure there are classes to set up
			if (!container) { $NW.throwError('No container was passed to setup'); } // make sure a container was passed

			// if (initialSetup) { this.options.oneTimeSetupPlugins.each(function(plugin, index) { // FOR EACH plugin specified needing special setup
				// $NW.getPlugin(plugin).setupContainer(container); // call setupContainer() method
			// }); } else {
				// $NW.getPlugin('NWLoadReplaces').load(container, true);
			// }
			this.options.setupPlugins.each(function(plugin, index) { // FOR EACH plugin specified needing special setup
				$NW.getPlugin(plugin).setupContainer(container); // call setupContainer() method
			});

			if (container.hasClass(this.options.clickOnLoadClass)) { $NW.clickElmt(container); } // possibly auto-click continer
			container.getElements('.'+this.options.clickOnLoadClass).each(function(elmt) { $NW.clickElmt(elmt); }); // possibly auto click elements
		},

		handleClick: function(event, fireElmt, includeAllClasses) {
			// TODO MARK: don't call endingCall for non-click classes
			if (typeOf(event.stop) == 'function') { event.stop(); } // stop the event bubbling
			var nwEvent = new NWEvent(event, fireElmt);
			var toCall = nwEvent.elmt.get('class').match(this.pluginsRegex); // get all NovumWare plugins to call from elmt class names
			toCall.unshift('NWInit'); // add NWInit to beginning of plugins array
			// TODO MARK: handle noClick classes with params (like NWGallery:normal)
			if (!includeAllClasses) { this.options.noClickClasses.each(function(className) { toCall.erase(className); }); } // remove all classes that shouldn't respond to a click
			toCall.push('NWClosure'); // add NWClosure to the end
			nwEvent.toCall = toCall; // set the plugins to call in the event
			$NW.currentEvent = nwEvent;
			$NW.callNextPlugin();
			// return true;

			//console.log('handleClick()');
			// if(this.isIgnoringNextClick()) { // IF ignoring next click
			// 				console.log('NWPlugins ignoring click');
			// 				//this.stopEvent(event); // stop the event
			// 				this.unignoreNextClick(); // reset the ignore flag
			// 				return; // interrupt method execution
			// 			}
		}

		// ignore the next click (optionally only ignor for certain amount of time)
		// ignoreNextClick: function(time) {
// 			this.ignoreNextClickEvent = true; // ignore the next click
// 			if (time) { this.unignoreNextClick.delay(time); } // reset the ignore after time
// 		},
// 		isIgnoringNextClick: function() { return this.ignoreNextClickEvent; }, // will ignore next click?
// 		unignoreNextClick: function() { this.ignoreNextClickEvent = false; }, // don't ignore the next click


		// ======================================================== MAIN PLUGINS ======================================
		/*// click on load
		rialtoClickOnLoad: function() {
			this.callNextPlugin(); // call next plugin
		},

		// dialog
		rialtoDialog: function() {
			//this.stopEvent(); // stop the event
			var rialtoDialog = $Rialto.getPlugin('RialtoDialog'); // get the plugin
			rialtoDialog.start(this.elmt, this.callNextPlugin); // show dialog / possibly call next plugin
		},

		// popup
		rialtoPopup: function() {
			//this.stopEvent(); // stop the event
			var rialtoPopup = $Rialto.getPlugin('RialtoPopup'); // get the plugin

			var rialtoPopupPreDispatchCallback = this.elmt.get('rialtoPopupPreDispatchCallback'); // get predispatch callback
			if($Rialto.callCallback(rialtoPopupPreDispatchCallback, this.elmt) === false) return; // perform a predispatch call.

			var url = this.elmt.get('href'); // get the url to load
			if(this.options.framework == 'zend') url = $Rialto.formatURL(url, 'zendPopup'); // for auto-setting the layout in zend
			rialtoPopup.show(url, function() { // open fancybox with the url
				//this.init($j('#popup-content')); // initialize stuff in the popup
				//this.loadReplaces($$('#fancybox-content')[0]); // load replace content
				this.setup($$('#fancybox-content')[0]); // setup stuff in the popup
				this.loadReplaces($$('#fancybox-content')[0]); // start loading the replaces
			}.bind(this));
			this.callNextPlugin(); // call next plugin
		},

		// popup window
		rialtoPopupWindow: function() {
			//this.stopEvent(); // stop the event
			var rialtoPopup = $Rialto.getPlugin('RialtoPopup'); // get the plugin
			var url = this.elmt.get('href'); // get the url to load
			if(this.options.framework == 'zend') url = $Rialto.formatURL(url, 'zendNoTop'); // for auto-setting the layout in zend
			rialtoPopup.popupWindow(url);
			this.callNextPlugin(); // call next plugin
		},

		// ajax link (up to server what to return) // defaults to html request
		rialtoAjaxLink: function(format) {
			var rialtoAjaxLinkPreDispatchCallback = this.elmt.get('rialtoLinkPreDispatchCallback'); // get predispatch callback
			if($Rialto.callCallback(rialtoAjaxLinkPreDispatchCallback, this.elmt) === true) {
				var rialtoAjax = $Rialto.getPlugin('RialtoAjax'); // get the plugin
				var url = this.elmt.get('href'); // get the url to load
				if(format == 'json') url = $Rialto.formatURL(url, 'zendJSON'); // possibly format url to request json
				else url = $Rialto.formatURL(url, 'zendNoLayout'); // possibly format url to request layout=none
				if(url) {
					var o = { // set ajax options
						url: url,
						onRequest: function() { $Rialto.getPlugin('RialtoLoadingImage').show(); },
						onSuccess: function(responseJSON, responseText) {
							this.ajaxSuccess(this.elmt, responseJSON, responseText);
							this.callNextPlugin(); // call next plugin
						}.bind(this),
						onError: function() { $Rialto.getPlugin('RialtoFlashMessage').showError(); },
						onComplete: function() { $Rialto.getPlugin('RialtoLoadingImage').hide(); }
					};
					if(format == 'json') rialtoAjax.jsonRequest(o); // make the call
					else rialtoAjax.htmlRequest(o); // make the html request call
				}
			}
		},

		// json ajax link (ask server to return JSON)
		rialtoJsonLink: function() {
			this.rialtoAjaxLink('json'); // delegate to existing function
		},

		// tooltips
		rialtoTooltip: function() {
			//this.stopEvent(); // stop the event
			var rialtoTooltip = $Rialto.getPlugin('RialtoTooltip'); // get the plugin
			rialtoTooltip.click(this.elmt); // show the tooltip contents
			this.callNextPlugin(); // call next plugin
		}, // does nothing
		rialtoTooltipClick: function() {
			//this.stopEvent(); // stop the event
			var rialtoTooltip = $Rialto.getPlugin('RialtoTooltip'); // get the plugin
			this.loadReplaces(this.elmt); // start loading the replaces
			rialtoTooltip.click(this.elmt); // show the tooltip contents
			this.callNextPlugin(); // call next plugin
		},
		rialtoTooltipClickAlways: function() {
			this.rialtoTooltipClick(); // delegate to other function
		},

		// image books
		/*rialtoImageBook: function() {
			//this.stopEvent(); // stop the event
			var rialtoImageBook = $Rialto.getPlugin('RialtoImageBook'); // get the plugin
			rialtoImageBook.click(self.clickedElmt); // click the thumbnail
			self.callNextPlugin(); // call next plugin
		},

		// validates a form
		rialtoForm: function() {
			self.callNextPlugin();
			return;
			var rialtoForm = $Rialto.getPlugin('RialtoForm'); // get the plugin
			var result = rialtoForm.validate(self.elmt); // validate the parent form
			//if(result) self.callNextPlugin(); // call next plugin
			if(result) self.elmt.submit();
			//else self.stopEvent(); // stop the event
		},

		// submits a form via ajax (up to server how to respond)
		rialtoAjaxForm: function(format) {
			var rialtoAjaxFormPreDispatchCallback = self.elmt.get('rialtoFormPreDispatchCallback'); // get predispatch callback
			if($Rialto.callCallback(rialtoAjaxFormPreDispatchCallback, self.elmt) === true) {
				var rialtoForm = $Rialto.getPlugin('RialtoForm'); // get the plugin
				var url = $Rialto.formatURL(self.elmt.get('action'), 'zendNoLayout'); // get url
				if(format == 'json') url = $Rialto.formatURL(url, 'zendJSON'); // optionally ask for a JSON response
				self.elmt.set('action', url); // format the form url
				rialtoForm.send(self.elmt, function(data) { self.responseCallback(data); self.callNextPlugin(); }); // send the form / call callbacks and next plugin onSuccess
			}
		},

		// submits a form via ajax (asks server for JSON response)
		rialtoJsonForm: function() {
			self.rialtoAjaxForm('json'); // delegate to previous method
		},

		// tabs
		rialtoTabs: function() {
			//self.stopEvent(); // stop the event
			var rialtoTabs = $Rialto.getPlugin('RialtoTabs'); // get the plugin
			rialtoTabs.click(self.elmt); // do the tab stuff for the clicked elmt
			self.callNextPlugin(); // call next plugin
		},

		// rialto deletes
		rialtoDelete: function() {
			//self.stopEvent(); // stop the event
			var rialtoDelete = $Rialto.getPlugin('RialtoDelete'); // get the plugin
			rialtoDelete.delete(self.elmt); // delete the elmt or a parent elmt
			self.callNextPlugin(); // call next plugin
		},
		// table accordion row
		rialtoTableAccordionRow: function() {
			//self.stopEvent(); // stop the event
			var rialtoTableAccordion = $Rialto.getPlugin('RialtoTableAccordion'); // get the plugin
			rialtoTableAccordion.clickRow(self.elmt); // select the row
			self.callNextPlugin(); // call next plugin
		},

		// scrolling
		rialtoScroll: function() {
			//self.stopEvent(); // stop the event
			var rialtoScroll = $Rialto.getPlugin('RialtoScroll'); // get the plugin
			rialtoScroll.click(self.elmt); // process the clicked scroll elmt
			self.callNextPlugin(); // call next plugin
		},

		// a regular link (allow default functionality)
		rialtoLink: function() {
			var href = self.elmt.get('href'); // get href
			window.location = href; // redirect the page
		},

		// a function that is called after everyting else has been run
		rialtoClosureCallback: function() {
			if(self.closureCallback) try{window[self.closureCallback](self.elmt)}catch(err) { $Rialto.throwCatchError(err); }; // call the ending function
		},

		// bubble an event up
		rialtoBubble: function() {
			$Rialto.clickElmt(self.elmt.getParent(self.selectorString)); // fire event on the first parent
		},

		rialtoFiltersListItem: function() {
			if($Rialto.getPlugin('RialtoFilters').clickListItem(self.elmt)) self.callNextPlugin();
		},
		rialtoFiltersX: function() {
			if($Rialto.getPlugin('RialtoFilters').clickX(self.elmt)) self.callNextPlugin();
		},
		rialtoClearFilters: function() {
			if($Rialto.getPlugin('RialtoFilters').clickClearFilters(self.elmt)) self.callNextPlugin();
		},

		rialtoLoadReplaces: function() {
			self.loadReplaces(self.elmt, true);
		},

		rialtoFormLink: function() {
			var formIDAttr = 'rialtoFormLinkFormID';
			var formID = self.elmt.get(formIDAttr);
			var form = $(formID);
			var href = self.elmt.get('href');
			form.set('action', href);
			form.submit();
		},

		rialtoDropdownHeader: function() {
			if($Rialto.getPlugin('RialtoDropdown').clickHeader(self.elmt)) self.callNextPlugin();
		},*/

		// ======================================================== PRIVATE METHODS ======================================
		// stop the  event
		// stopEvent: function(event) {
			// var eventToStop = event || this.event; // get the event to stop
			// if (typeof eventToStop.stop == 'function') { eventToStop.stop(); } // stop the event
		// },

		// when an ajax call is successful
		// ajaxSuccess: function(triggerElmt, responseJSON, responseText) {
// 			var appendTargetID = this.elmt.get(this.options.appendTargetIDAttr);
// 			var replacesTargetID = this.elmt.get(this.options.replacesTargetIDAttr);
// 			var newElmt;
// 			if (appendTargetID) {
// 				newElmt = Elements.from('<span>'+responseJSON+'</span>')[0]; // get new elmt
// 				newElmt.fade('hide').inject(appendTargetID, 'bottom').fade('in'); // replace old elmt with new and fade in
// 				this.setup(newElmt);
// 			} else if (replacesTargetID) {
// 				newElmt = Elements.from('<span>'+responseJSON+'</span>')[0]; // get new elmt
// 				newElmt.fade('hide').replaces(replacesTargetID).fade('in'); // replace old elmt with new and fade in
// 				this.setup(newElmt);
// 			}
// 			//$NW.getPlugin('NWFlashMessage').show('Ajax Success'); // show a flash message
// 			this.responseCallback(responseJSON); // callback functions
// 		},

		// call the init function
		// initCallback: function() {
		// 		var initCallback = this.elmt.get(this.options.initCallbackAttr); // get init callback
		// 		if(initCallback) try{ if(window[initCallback](this.elmt) === false) return; }
		// 		catch(err) {
		// 			 console.log(this.elmt);
		// 			 $Rialto.throwCatchError(err);
		// 		}; // call init IF provided
		// 	},

		// call JSON response function on elmt
		// responseCallback: function(data) {
// 			var callbackName = this.elmt.get(this.options.responseCallbackAttr);
// 			if (callbackName) { // IF a response callback is specified
// 				try{window[callbackName](data, this.elmt);}catch(err) { $NW.throwCatchError(err); } // callback
// 				if (window[callbackName+'Page']) { try{window[callbackName+'Page'](data, this.elmt);}catch(err) { $NW.throwCatchError(err); } } //callback + 'Page'
// 			}
// 			if (data.success === false) { $NW.getPlugin('NWFlashMessage').show(data.error.message); } // flash error message
// 		},
//
// 		// load replaces
// 		loadReplaces: function(container, thisElmt) {
// 			console.log('loading replaces on: '); console.log(container);
// 			if (!container) { return; } // make sure a container was passed
// 			if (!thisElmt) { $NW.getPlugin('NWLoadReplaces').load(container); } // load replaces
// 			else { $NW.getPlugin('NWLoadReplaces').loadSingleReplaces(container, true); } // load replaces
// 		}

	});

})();
