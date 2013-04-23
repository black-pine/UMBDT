var NWHintElmt = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		htmlArrow: function(arrow){return "<span class='nw-hint-arrow icon-arrow-"+arrow+"'></span>";},

		elmt: null,
		elmtTrigger: null,
		elmtTriggerClose: null,
		elmtContent: null,

		typeHover: 'hover',
		typeClick: 'click',
		typeShow: 'show',

		classPlugin: 'NWHintElmt',
		classTrigger: 'nw-hint-trigger',
		classTriggerClose: 'nw-hint-triggerClose',
		classContent: 'nw-hint-content',
		classContentVisible: 'nw-hint-content-visible',
		// classContentN: 'nw-hint-content-n',
		// 		classContentE: 'nw-hint-content-e',
		// 		classContentS: 'nw-hint-content-s',
		// 		classContentW: 'nw-hint-content-w',
		classArrow: 'nw-hint-arrow',

		showing: false,

		options: {
			type: 'hover',
			delay: 0
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(elmt, options) {
			this.elmt = elmt;
			this.elmt.store(this.classPlugin, this);
			this.elmtTrigger = this.elmt.getElements('.'+this.classTrigger)[0];
			this.elmtTriggerClose = this.elmt.getElements('.'+this.classTriggerClose)[0];
			this.elmtContent = this.elmt.getElements('.'+this.classContent)[0];
			if (!this.elmtContent) { $NW.throwError('Hint does not have a content elmt'); }
			this.setOptions(options); // override default options
			// this.addArrow();
			this.initializePosition();
			if (this.elmtTriggerClose) { this.elmtTriggerClose.addEvent('click', this.onClickClose.bind(this)); }
			if (this.options.type == this.typeHover) { this.initializeTypeHover(); }
			// else if (this.options.type == this.typeClick) this.initializeTypeClick();
			else if (this.options.type == this.typeShow) { this.show(); }
		},

		// initializeTypeClick: function() {
			// if (this.elmtTrigger.addEvent('click', this.onClick.bind(this));
			// this.elmtTrigger.addEvent('mouseleave', this.onMouseLeave.bind(this));
		// },

		initializeTypeHover: function() {
			this.elmtTrigger.addEvent('mouseenter', this.onMouseEnter.bind(this));
			this.elmtTrigger.addEvent('mouseleave', this.onMouseLeave.bind(this));
		},

		initializePosition: function() {
			var triggerCoords;
			if (this.elmtTrigger) { triggerCoords = this.elmtTrigger.getCoordinates(this.elmtTrigger.getOffsetParent()); }
			else { triggerCoords = this.elmt.getCoordinates(); }
			var contentSize = this.elmtContent.getDimensions();
			var newContentPos = {
				x: (triggerCoords.width / 2) - (contentSize.width / 2),
				y: triggerCoords.height + 5
			};
			this.elmtContent.setPosition(newContentPos);
		},


		// ======================================================== PUBLIC METHODS ======================================
		show: function(noDelay) {
			this.showing = true;
			var tween = $NW.fx.getElmtTween(this.elmtContent);
			var delayTime;
			if (noDelay || !this.options.delay || tween.isRunning()) { delayTime = 0; }
			else { delayTime = this.options.delay; }
			$NW.fx.cancelTween(tween);
			(function(){
				if (!this.showing) { return; }
				this.elmtContent.addClass(this.classContentVisible);
				$NW.fx.fadeIn(this.elmtContent);
			}.bind(this)).delay(delayTime);
		},

		hide: function() {
			this.showing = false;
			$NW.fx.cancelTween($NW.fx.getElmtTween(this.elmtContent));
			$NW.fx.fadeOut(this.elmtContent, {onComplete: function(){ this.elmtContent.removeClass(this.classContentVisible); }.bind(this)});
		},


		// ======================================================== PRIVATE METHODS ======================================
		// addArrow: function() {
			// if (this.options.position == 'n') {
			// 				this.options.arrow = 's';
			// 				this.elmtContent.addClass(this.classContentN);
			// 			} else if (this.options.position == 'e') {
			// 				this.options.arrow = 'w';
			// 				this.elmtContent.addClass(this.classContentE);
			// 			} else if (this.options.position == 's') {
			// 				this.options.arrow = 'n';
			// 				this.elmtContent.addClass(this.classContentS);
			// 			} else if (this.options.position == 'w') {
			// 				this.options.arrow = 'e';
			// 				this.elmtContent.addClass(this.classContentW);
			// 			}
			// var htmlArrow = Elements.from(this.htmlArrow('up'))[0];
			// this.elmtContent.grab(htmlArrow);
			// console.log(htmlArrow);
		// },


		// ======================================================== EVENT HANDLERS ======================================
		onMouseEnter: function() {
			this.show();
		},

		onMouseLeave: function() {
			this.hide();
		},

		onClick: function() {
			this.show();
		},

		onClickClose: function() {
			this.hide();
		}

	});
})();