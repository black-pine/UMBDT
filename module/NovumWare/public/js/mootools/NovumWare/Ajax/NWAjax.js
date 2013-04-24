var NWAjax = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		dataContainerTargetId: 'data-nwAjax-containerTargetId',
		dataAppendTargetId: 'data-nwAjax-appendTargetId', // pass 'self' to append to the item that was clicked
		dataReplaceTargetId: 'data-nwAjax-replaceTargetId', // pass 'self' to replace the item that was clicked

		typeHtml: 'html',
		typeJson: 'json',

		keyFlashMessages: 'nwFlashMessages',
		keyFlashMessagesSuccess: 'success',
		keyFlashMessagesError: 'error',

		options: {
			method: 'get',
			link: 'ignore',
			noCache: false,
			evalScripts: true,
			onRequest: function(){ $NW.getPlugin('NWLoadingImage').show(); },
			onError: function(){
				$NW.getPlugin('NWLoadingImage').hide();
				$NW.getPlugin('NWFlashMessage').showError();
			},
			onComplete: function(){ $NW.getPlugin('NWLoadingImage').hide(); },
			onFailure: function(xhr){
				$NW.getPlugin('NWLoadingImage').hide();
				$NW.getPlugin('NWFlashMessage').showError();
				$NW.throwError(xhr);
			}
		},


		// ======================================================== SETUP METHODS ======================================		
		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================		
		htmlRequest: function(o, elmt) {
			this.makeRequest(o, this.typeHtml, elmt);
		},

		jsonRequest: function(o, elmt) {
			this.makeRequest(o, this.typeJson, elmt);
		},
		/**
		 * Make an ajax request for an HTML response.
		 * 
		 * @param Object o Request options.
		 * @throws error if no url is provided.
		 * @return void
		 */
		// htmlRequest: function(o, elmt) {
// 			if (!o.url) { $NW.throwError('No url was provided'); } // make sure a url was passed
// 			o = Object.merge(Object.clone(this.options), o);
// 			// o.url = $NW.formatURL(o.url, 'zendNoLayout'); // format url to request layout=none
// 			o = this.addOnSuccess(o, elmt); // add additional onSuccess functionality
// 			//console.log('HTML loading: '+o.url);
// 			var htmlRequest = new Request(o); // create HTML request object
// 			htmlRequest.send(); // send the request
// 		},

		/**
		 * Make an ajax request for a JSON response.
		 * 
		 * @param o Object Request options.
		 * @throws error if no url is provided.
		 * @return void
		 */
		// jsonRequest: function(o, elmt) {
// 			o = Object.merge(Object.clone(this.options), o);
// 			if (!o.url) { $NW.throwError('No url was provided'); } // make sure a url was passed
// 			// o.url = $NW.formatURL(o.url, 'zendJSON'); // format url to request json
// 			o = this.addOnSuccess(o, elmt); // add additional onSuccess functionality
// 			var jsonRequest = new Request.JSON(o); // create JSON request object
// 			jsonRequest.send(); // send the request
// 		},

		/**
		 * Submit a form via ajax.
		 * 
		 * @param Object o Request options.
		 * @throws error if no form is provided.
		 * @return void
		 */
		// formRequest: function(o, elmt) {
// 			if (!o.form) { $NW.throwError('No form was provided to submit'); }  // make sure a form was passed
// 			o = Object.merge(Object.clone(this.options), o);
// 			o.data = o.form; // set the data attribute for the request
// 			o.url = o.form.get('action'); // get the url (action) of the form
// 			//o.url = overrideURL || o.form.get('action'); // get the url (action) of the form
// 			o.method = o.form.get('method') || 'post';
// 			//var passedSuccess = o.onSuccess; // passed success function
// 			o = this.addOnSuccess(o, nwEvent); // add additional onSuccess functionality
// 			/*o.onSuccess = function(data){ // onSuccess
// 				if(this.getHeader('content-type') == 'application/json') data = JSON.decode(data); // decode JSON resonses
// 				if(passedSuccess) passedSuccess(data); // call the passed function
// 			};*/
// 			var formRequest;
// 			if (o.requestType == 'json') { formRequest = new Request.JSON(o); } // create a Form Request object
// 			else { formRequest = new Request(o); } // create a Form Request object
// 			formRequest.send(); // send the request
// 		},


		// ======================================================== PRIVATE METHODS ======================================
		makeRequest: function(o, type, elmt) {
			if (o.form) {
				o.data = o.form;
				o.method = o.form.method;
				o.url = o.form.get('action');
			}

			if (!o.url) { $NW.throwError('No url was provided'); } // make sure a url was passed
			o = Object.merge(Object.clone(this.options), o);
			o = this.addOnSuccess(o, type, elmt); // add additional onSuccess functionality

			var request;
			switch(type) {
				case this.typeHtml:
					request = new Request(o);
					break;
				case this.typeJson:
					request = new Request.JSON(o);
					break;
			}
			request.send();
		},

		addOnSuccess: function(o, type, elmt) {
			if (typeOf(o.onSuccess) == 'function') { var passedOnSuccess = o.onSuccess; } // copy passed onSuccess function
			o.onSuccess = (function(response) {
				if (type == this.typeHtml) { this.ajaxSuccess(response, elmt); }
				else if (type == this.typeJson) { this.jsonSuccess(response, elmt); }
				if (passedOnSuccess) { passedOnSuccess(response); } // run passedOnSuccess function if it was provided
			}).bind(this);
			return o;
		},

		ajaxSuccess: function(response, elmt) {
			if (!elmt) { return; }
			var containerTargetId = elmt.get(this.dataContainerTargetId);
			var appendTargetId = elmt.get(this.dataAppendTargetId);
			var replaceTargetId = elmt.get(this.dataReplaceTargetId);
			var newElmt;

			if (containerTargetId) {
				$(containerTargetId).empty();
				appendTargetId = containerTargetId;
			}

			if (appendTargetId) {
				newElmt = Elements.from('<span>'+response+'</span>')[0]; // get new elmt
				if (appendTargetId == 'self') { appendTargetId = elmt; } // optionally append to self
				newElmt.fade('hide').inject(appendTargetId, 'bottom').fade('in'); // replace old elmt with new and fade in
				$NW.getPlugin('NWPlugins').setupContainer(newElmt);
			} else if (replaceTargetId) {
				newElmt = Elements.from('<span>'+response+'</span>')[0]; // get new elmt
				if (replaceTargetId == 'self') { replaceTargetId = elmt; } // optionally replace self
				newElmt.fade('hide').replaces(replaceTargetId).fade('in'); // replace old elmt with new and fade in
				$NW.getPlugin('NWPlugins').setupContainer(newElmt);
			}
		},

		jsonSuccess: function(response, elmt) {
			var flashMessagesArray = response[this.keyFlashMessages];
			if (flashMessagesArray) {
				var successMessagesArray = flashMessagesArray[this.keyFlashMessagesSuccess];
				if (successMessagesArray) { successMessagesArray.each(function(successMessage){
					$NW.getPlugin('NWFlashMessage').showSuccessMessage(successMessage);
				}); }
				var errorMessagesArray = flashMessagesArray[this.keyFlashMessagesError];
				if (errorMessagesArray) { errorMessagesArray.each(function(errorMessage){
					$NW.getPlugin('NWFlashMessage').showErrorMessage(errorMessage);
				}); }
			}
		}

	});
})();
