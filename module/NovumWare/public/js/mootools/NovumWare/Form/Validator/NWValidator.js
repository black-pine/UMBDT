var NWValidator = (function(){
	'use strict';

	return new Class({

		Extends: Form.Validator.Inline,

		options: {
			adviceClass: 'nwValidator-advice',
			showError: function(errorElmt){
				errorElmt.setStyle('display', 'inline-block'); // set display to
				if (errorElmt.fade) { errorElmt.fade('in'); }
				else { errorElmt.setStyle('display', 'inline-block'); }
			},
			hideError: function(errorElmt){
				if (errorElmt.fade) { errorElmt.fade('out'); }
				else { errorElmt.setStyle('display', 'none'); }
			},
			errorPrefix: '',
			serial: false,
			stopOnFailure: false,
			scrollToErrorsOnSubmit: false,
			evaluateOnSubmit: false,
			evaluateFieldsOnBlur: true,
			evaluateFieldsOnChange: true,
			ignoreHidden: true,
			useTitles: true
		},

		isNovumWare: true,


		// ======================================================== SETUP METHODS ======================================
		initialize: function(form){
			this.parent(form, this.options); // call parent method
		},


		// ======================================================== PUBLIC METHODS ======================================


		// ======================================================== PRIVATE METHODS ======================================


		// ======================================================== OVERRIDES ======================================
		makeAdvice: function(className, field, error, warn) {
			var advice = this.parent(className, field, error, warn); // call parent method
			return advice.set('class', this.options.adviceClass); // change error elmt class and return
		},

		insertAdvice: function(advice, field) {
			this.parent(advice, field); // call parent method
			advice.position({ // position advice
				relativeTo: field,
				edge: 'left',
				position: 'right'
			});
		}

	});
})();
