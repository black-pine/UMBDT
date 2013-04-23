// requires NWAjax
// requires NWFlashMessage
var NWForm = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWForm',

		paramPosType: 0,

		options: {
			defaultType: 'normal'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		setupContainer: function(container) {
			container.getElements('[class*="'+this.classPlugin+'"]').each(function(elmt) {
				this.setup(elmt);
			}.bind(this));
		},

		setup: function(form) {
			var formOptions = {};
			var params = $NW.getClassParams(form, this.classPlugin);
			formOptions.type = params[this.paramPosType] || this.options.defaultType;
			return new NWFormElmt(form, formOptions);
		},

		handleClick: function(elmt) {
			this.getNWFormElmt(elmt).handleClick(elmt);
		},


		// ======================================================== PRIVATE METHODS ======================================
		getNWFormElmt: function(form) {
			var formElmt = form.retrieve('NWFormElmt');
			if (!formElmt) { formElmt = this.setup(form); }
			return formElmt;
		}

	});
})();
