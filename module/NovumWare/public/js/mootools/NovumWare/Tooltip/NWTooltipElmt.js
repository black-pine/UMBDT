var NWTooltipElmt = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		elmt: null,
		elmtBody: null,
		elmtContent: null,

		typeHover: 'hover',
		typeClick: 'click',
		typeClickAlways: 'clickAlways',

		classPlugin: 'NWTooltipElmt',
		classBody: 'nw-tooltip-body',
		classBodyVisible: 'nw-tooltip-body-visible',
		classContent: 'nw-tooltip-content',

		dataURL: 'data-nwTooltip-url',
		// formIDAttr: 'nw-tooltip-formID', // the ID of the form to submit and load into the row

		showing: false,

		options: {
			type: 'hover', // hover | click | clickAlways
			delay: 500
		},

		initialize: function(elmt, options) {
			this.elmt = elmt;
			this.elmt.store(this.classPlugin, this);
			this.elmtBody = elmt.getElements('.'+this.classBody)[0];
			if (!this.elmtBody) { $NW.throwError('Tooltip does not have a body elmt'); }
			this.elmtContent = this.elmtBody.getElements('.'+this.classContent)[0];
			if (!this.elmtContent) { $NW.throwError('Tooltip does not have a content elmt'); }
			this.setOptions(options); // override default options
			if (this.options.type == this.typeHover) { this.initializeTypeHover(); }
			this.elmt.addEvent('mouseleave', this.onMouseLeave.bind(this));
		},

		initializeTypeHover: function() {
			this.options.type = this.typeHover;
			this.elmt.addEvent('mouseenter', this.onMouseEnter.bind(this));
		},


		// ======================================================== PUBLIC METHODS ======================================
		show: function(noDelay) {
			this.showing = true;
			var tween = $NW.fx.getElmtTween(this.elmtBody);
			var delayTime;
			if (noDelay || !this.options.delay || tween.isRunning()) { delayTime = 0; }
			else { delayTime = this.options.delay; }
			$NW.fx.cancelTween(tween);
			(function(){
				if (!this.showing) { return; }
				this.elmtBody.addClass(this.classBodyVisible);
				$NW.fx.fadeIn(this.elmtBody);
			}.bind(this)).delay(delayTime);
		},

		hide: function() {
			this.showing = false;
			$NW.fx.cancelTween($NW.fx.getElmtTween(this.elmtBody));
			$NW.fx.fadeOut(this.elmtBody, {onComplete: function(){ this.elmtBody.removeClass(this.classBodyVisible); }.bind(this)});
		},


		// ======================================================== PRIVATE METHODS ======================================
		loadURL: function() {
			var url = this.elmt.get(this.dataURL);
			if (this.options.type == this.typeClick) { this.initializeTypeHover(); }
			var nwAjax = $NW.getPlugin('NWAjax');
			var o = { // set ajax options
				method: 'get', // setting the method to get!
				url: url,
				onRequest: function(){ this.showLoading(); }.bind(this), // show loading image on tooltipBody
				onSuccess: function(responseHTML){
					this.elmt.set(this.dataURL, null); // so that it doesn't load it anymore.
					var newElmt = Elements.from('<span>'+responseHTML+'</span>', false)[0]; // get new elmt
					newElmt.inject(this.elmtContent);
					$NW.getPlugin('NWPlugins').setupContainer(this.elmtContent);
				}.bind(this),
				onComplete: function(){
					this.hideLoading();
				}.bind(this)
			};
			// if (formID = tooltipBody.get(this.formIDAttr)) {
			// 				o.form = $(formID); // get the form and set it to the AJAX options
			// 				$Rialto.getPlugin('RialtoAjax').formRequest(o, url); // submit the form
			// 			}
			// 			else $Rialto.getPlugin('RialtoAjax').htmlRequest(o); // make the call
			$NW.getPlugin('NWAjax').htmlRequest(o);
		},

		showLoading: function() {
			$NW.getPlugin('NWLoadingImage').show(this.elmtContent);
		},

		hideLoading: function() {
			$NW.getPlugin('NWLoadingImage').hide(this.elmtContent);
		},


		// ======================================================== EVENT HANDLERS ======================================
		onMouseEnter: function() {
			this.show();
		},

		onMouseLeave: function() {
			this.hide();
		},

		onClick: function() {
			if ((this.options.type == this.typeClickAlways || this.options.type == this.typeClick) && this.elmt.get(this.dataURL)) { this.loadURL(); }
			this.show(true);
		}

	});
})();