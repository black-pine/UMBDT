var NWLink = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		paramPosType: 0,
		paramTypeAjax: 'ajax',
		paramTypeJson: 'json',
		paramTypeForm: 'form',
		paramTypeNothing: 'nothing',

		dataPreDCB: 'data-nwLink-preDCB',
		dataSuccessCB: 'data-nwLink-successCB',
		dataFormId: 'data-nwLink-formId',

		options: {},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		handleClick: function(elmt, params) {
			if (params[this.paramPosType] == this.paramTypeAjax) { this.handleAjaxLink(elmt); } // IF AJAX link
			else if (params[this.paramPosType] == this.paramTypeJson) { this.handleJsonLink(elmt); } // ELSE IF JSON link
			else if (params[this.paramPosType] == this.paramTypeNothing) { this.handleNothingLink(elmt); } // ELSE IF nothing link
			else if (params[this.paramPosType] == this.paramTypeForm) { this.handleFormLink(elmt); } // ELSE IF nothing link
			else { // ELSE redirect the page
				var href = elmt.get('href');
				if (href) { window.location = href; }
				else { this.handleNothingLink(elmt); }
			}
		},


		// ======================================================== PRIVATE METHODS ======================================
		handleAjaxLink: function(elmt, type) {
			if (!$NW.callCB(elmt.get(this.dataPreDCB), elmt)) { return false; }
			var nwAjax = $NW.getPlugin('NWAjax');
			var ajaxOptions = {
				url: elmt.get('href'),
				onSuccess: (function(response){
					if ($NW.callCB(elmt.get(this.dataSuccessCB), [response, elmt])) { $NW.callNextPlugin(); }
				}).bind(this)
			};
			if (type == this.paramTypeJson) { nwAjax.jsonRequest(ajaxOptions, elmt); }
			else { nwAjax.htmlRequest(ajaxOptions, elmt); }
		},

		handleJsonLink: function(elmt) {
			this.handleAjaxLink(elmt, this.paramTypeJson); // delegate
		},

		handleNothingLink: function(elmt) {
			if ($NW.callCB(elmt.get(this.dataPreDCB), elmt)) { $NW.callNextPlugin(); }
		},

		handleFormLink: function(elmt) {
			var formId = elmt.get(this.dataFormId);
			var form = $(formId);
			var href = elmt.get('href');
			form.set('action', href);
			form.submit();
		}

	});
})();
