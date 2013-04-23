var NWDatePicker = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		// paramPosType: 0,
		// paramTypeDate: 'date',
		// paramTypeTime: 'time',
		// paramTypeBoth: 'both',
		// paramPosFormat: 1,

		classPlugin: 'NWDatePicker',

		dataOptions: 'data-nwDatePicker-options',

		options: {
			pickerOptions: {
			    timePicker: false,
				format: '%b %d, %Y',
			    positionOffset: {x: 5, y: 0},
			    pickerClass: 'datepicker_vista',
			    useFadeInOut: !Browser.ie
			}
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		setupContainer: function(container) {
			container.getElements('.'+this.classPlugin).each(function(elmt) { // for each elmt in the container
				this.setupElmt(elmt);
			}.bind(this));
		},

		setupElmt: function(elmt) {
			var options = this.options.pickerOptions;
			var elmtOptions = elmt.get(this.dataOptions);
			if (elmtOptions) { options = Object.merge(Object.clone(options), JSON.decode(elmtOptions)); }
			var picker  = new Picker.Date(elmt, options); // mootools datepicker
		}

	});
})();
