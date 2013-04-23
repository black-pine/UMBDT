var NWFormElmt = (function(){
	'use strict';

		return new Class({

		elmt: null,
		nwEvent: null,
		validator: null,

		classPlugin: 'NWFormElmt',

		dataPreDCB: 'data-nwForm-preDCB',
		dataPostDCB: 'data-nwForm-postDCB',
		// dataSubmitOnChangeURL: 'data-nwForm-submitOnChangeURL',

		typeNormal: 'normal',
		typeAjax: 'ajax',
		typeJson: 'json',
		type: 'normal',


		// ======================================================== SETUP METHODS ======================================
		initialize: function(elmt, options) {
			this.elmt = elmt;
			this.elmt.store(this.classPlugin, this);
			if (options.type) { this.type = options.type; }
			this.validator = new NWValidator(this.elmt);

			// this.elmt.getElements("[type='submit']").set('disabled', true);
		},

		handleClick: function(nwEvent) {
			this.nwEvent = nwEvent;
			this.submitForm();
		},


		// ======================================================== PUBLIC METHODS ======================================
		submitForm: function() {
			if (this.validate() && $NW.callCB(this.elmt.get(this.dataPreDCB), this.elmt)) {
				if (this.type == this.typeAjax) { this.submitFormAjax(); }
				else if (this.type == this.typeJson) { this.submitFormJson(); }
				else { this.submitFormNormal(); }
			}
		},

		validate: function() {
			return this.validator.validate() || false;
		},


		// ======================================================== PRIVATE METHODS ======================================
		submitFormNormal: function() {
			this.elmt.submit();
		},

		submitFormAjax: function() {
			this.sendAjaxfully(this.typeAjax); // send the form
		},

		submitFormJson: function() {
			this.sendAjaxfully(this.typeJson); // send the form
		},

		sendAjaxfully: function(requestType) {
			var o = {
				form: this.elmt,
				onRequest: (function() {
					this.elmt.getElements('input[type="submit"], button[type="submit"]').set('disabled', 'disabled'); // disable submit buttons
					$NW.getPlugin('NWLoadingImage').show();
				}).bind(this),
				onSuccess: (function(data){ this.onFormSubmitSuccess(data); }).bind(this),
				onComplete: (function() {
					this.elmt.getElements('input[type="submit"], button[type="submit"]').set('disabled', null); // enable submit buttons
					$NW.getPlugin('NWLoadingImage').hide();
				}).bind(this)
			};
			if (requestType == this.typeJson) { $NW.getPlugin('NWAjax').jsonRequest(o, this.elmt); }
			else { $NW.getPlugin('NWAjax').htmlRequest(o, this.elmt); }
		},


		// ======================================================== EVENT HANDLERS ======================================
		onFormSubmitSuccess: function(data) {
			var postDCB = this.elmt.get(this.dataPostDCB);
			if ($NW.callCB(postDCB, [data, this.elmt])) { $NW.callNextPlugin(); }
		}

	});
})();