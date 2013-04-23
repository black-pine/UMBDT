// requires NWAjax
// requires NWLoadingImage
var NWLoadReplaces = (function(){
	// TODO MARK: automatically add layout/none to loading stuff?
	// TODO MARK: add callback and ending callback functionality and preDispatch
	// TOOD MARK: merge common options with an ajaxoptions options
	'use strict';

	return new Class({

		Implements: [Options, Events],

		classPlugin: 'NWLoadReplaces',

		dataURL: 'data-nwLoadReplaces-url',

		LOADED_EVENT: 'nwLoadReplacesLoaded',

		options: {
			showLoadingImage: true, // default to show the loading image
			RialtoLoadingImage: {}
		},

		initialize: function(options){
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt) {
			this.loadOne(elmt, null);
		},

		// check if there are any load replaces to load
		needsReplacing: function(container) {
			var loadReplaces = this.getLoadReplaces(container);
			return loadReplaces.length;
		},

		/**
		 * Replace any elements that have a [this.options.replaceTag] tag.
		 *
		 * @param elmt container The container in which to load and replaces.
		 * @param bool showLoading Show a loading image in container if true.
		 * @return void
		 */
		load: function(containers, showLoading){
			if (typeOf(containers) == 'elements') { containers.each(function(container){ this.loadContainer(container, showLoading); }.bind(this)); } // IF a group elements load each individually
			else { this.loadContainer(containers, showLoading); } // delegate to loadContainer()
		},


		// ======================================================== PRIVATE METHODS ======================================
		// load a single container
		loadContainer: function(container, showLoading) {
			var loadReplaces = this.getLoadReplaces(container); // get all load replaces in container
			loadReplaces.each(function(lr){ $NW.clickElmt(lr); }); // delegate each load replaces to it's handleClick() method
		},

		// load a single container
		loadOne: function(elmt, showLoading) {
			if (!elmt) { $NW.throwCatchError('No elmt provided'); }
			var nwAjax = $NW.getPlugin('NWAjax');
			if (showLoading === null) { showLoading = this.options.showLoadingImage; }
			var url = elmt.get(this.dataURL);
			if (!url) { $NW.throwCatchError('No URL provided'); }
			// url = $NW.formatURL(url, 'zendNoLayout');
			var parent = elmt.getParent(); // find the parent container (for loading image)
			var o = { // set ajax options
				method: 'get', // setting the method to get!
				url: url,
				onRequest: function(){ if (showLoading){$NW.getPlugin('NWLoadingImage').show(parent);} }, // show loading image on parent container
				onComplete: function(){ if (showLoading){$NW.getPlugin('NWLoadingImage').hide(parent);} } // hide loading image on parent container
			};
			elmt.set(nwAjax.dataReplaceTargetID, 'self'); // make elmt replace itself
			nwAjax.htmlRequest(o, elmt); // make the call
		},

		// loadSingleReplaces: function(elmt, showLoading) {
		// 		var url = elmt.get(self.options.replaceTag); // get the URL to load
		// 		url = $Rialto.formatURL(url, 'zendNoLayout');
		// 		if(url) { // IF there is a URL
		// 			var parent = elmt.getParent(); // find the parent container
		// 			var o = { // set ajax options
		// 				method: 'get', // setting the method to get!
		// 				url: url,
		// 				onRequest: function(){ if(showLoading) self.showLoadingImage(parent); }, // show loading image on parent container
		// 				onSuccess: function(responseJSON, responseText){
		// 					self.onSuccess(elmt, responseJSON, responseText, true, parent);
		// 				},
		// 				onFailure: function(xhr){
		// 					$Rialto.getPlugin('RialtoFlashMessage').showError(); // show error message
		// 					console.log(xhr);
		// 				},
		// 				onComplete: function(){ if(showLoading) self.hideLoadingImage(parent); } // hide loading image on parent container
		// 			};
		// 			$Rialto.getPlugin('RialtoAjax').htmlRequest(o); // make the call
		// 		}
		// 	},

		// on successfull load
		// onSuccess: function(elmt, responseJSON, responseText, finished, container){
		// 		// var rialtoLoadReplaces = $Rialto.getPlugin('RialtoLoadReplaces'); // get RialtoLoadReplaces plugin
		// 		// rialtoLoadReplaces.addEvent(rialtoLoadReplaces.LOADED_EVENT, function(container){ self.setupContainer(container); }); // setup listener for loaded stuff
		// 		var parent = elmt.getParent(); // get parent container
		// 		var newElmt = Elements.from('<span>'+responseJSON+'</span>', false)[0]; // get new elmt
		// 		// console.log(newElmt);
		// 		newElmt.fade('hide').replaces(elmt).fade('in'); // replace old elmt with new and fade in
		// 		self.fireEvent(self.LOADED_EVENT, parent); // fire loaded event for self
		// 		if(finished) container.fireEvent(self.LOADED_EVENT); // fire loaded event for container
		// 	},


		// ======================================================== PRIVATE METHODS ======================================
		getLoadReplaces: function(container) {
			var loadReplaces;
			if (container.hasClass(this.classPlugin)) { loadReplaces = [container]; }
			else { loadReplaces = container.getElements('.'+this.classPlugin); } // return number of load replaces
			return loadReplaces;
		}
	});

})();
