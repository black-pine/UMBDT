var NWFx = (function() {
	'use strict';

	return new Class({

		Implements: [Options],

		timing: 300,

		options: {
			timing: 300,
			tweenOptions: {
				duration: 500,
				link: 'cancel',
				transition: 'sine:out'
			}
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
			if (this.options.timing) { this.timing = this.options.timing; } // override timing default
			// Fx.implement({options: this.tweenOptions}); // implement global effects options
		},


		// ======================================================== PUBLIC METHODS ======================================
		// TODO MARK: find better way of animating multiple elements (NOT looping)
		fadeIn: function(elmts, passedOptions) {
			var options = Object.merge({ // merge in passed options
				startOpacity: null,
				endOpacity: 1,
				onComplete: null // event handler when all passed elmts have animated
			}, passedOptions);

			var elmtsArray = elmts;
			if (typeOf(elmtsArray) != 'array' && typeOf(elmtsArray) != 'elements') { elmtsArray = [elmts]; } // put single element into an array

			var numElmts = elmtsArray.length; // get length of elements array (for adding event listener on last one)
			elmtsArray.each(function(elmt, index) {
				var tween = this.getElmtTween(elmt);
				if (options.onComplete && index == elmtsArray.length-1) { tween.addEvent('complete', function() { tween.removeEvents('complete'); options.onComplete(elmts); }); } // add event listener on last elmt
				if (options.startOpacity) { elmt.setStyle('opacity', options.startOpacity); }
				elmt.setStyle('display', null); // reset inline display property
				elmt.setStyle('visibility', 'visible');
				tween.start('opacity', options.startOpacity, options.endOpacity); // start tween
			}.bind(this));
		},

		fadeOut: function(elmts, passedOptions) {
			var options = Object.merge({ // merge in passed options
				startOpacity: null,
				endOpacity: 0,
				hide: false,
				destroy: false,
				onComplete: null
			}, passedOptions);

			var elmtsArray = elmts;
			if (typeOf(elmtsArray) != 'array' && typeOf(elmtsArray) != 'elements') { elmtsArray = [elmts]; } // put single element into an array

			var numElmts = elmtsArray.length; // get length of elements array (for adding event listener on last one)
			elmtsArray.each(function(elmt, index) {
				var tween = this.getElmtTween(elmt);
				if (options.destroy) { tween.addEvent('complete', function(elmt){ elmt.destroy(); }); } // optionally destroy elmt when finished fading out
				else if (options.hide) { tween.addEvent('complete', function(elmt){ elmt.setStyle('display', 'none'); }); } // optionally hide elmt when finished fading out
				if (options.onComplete && index == elmtsArray.length-1) { tween.addEvent('complete', function(){ tween.removeEvents('complete'); options.onComplete(elmts); }); } // edd event listener on last elmt
				tween.start('opacity', options.startOpacity, options.endOpacity);
			}.bind(this));
		},

		// hide: function(elmts) {
		// 				var o = {
		// 					endOpacity: 0,
		// 					duration: 0
		// 				};
		// 				this.fadeOut(elmts, o);
		// 			},

		highlight: function(elmts, o) {
			var options = Object.merge(Object.clone(this.options.tweenOptions), { // merge in passed options
				property: 'background-color', // the property to tween
				startColor: '#ff8', // starting color
				endColor: null, // ending color
				endTransparent: true, // set to transparent bg at end
				onComplete: null
			}, o);

			if (typeOf(elmts) == 'element') { elmts = [elmts]; } // turn single elements into array

			var numElmts = elmts.length; // get length of elements array (for adding event listener on last one)
			elmts.each(function(elmt, index) { // FOR EACH element
				var fx = new Fx.Tween(elmt, options); // create tween
				if (index == elmts.length-1 && options.onComplete) { fx.addEvent('complete', function() { options.onComplete(elmts); }); } // edd event listener on last elmt
				var endColor = options.endColor || elmt.getStyle('background-color');
				elmt.setStyle('background-color', options.startColor);
				if (options.endTransparent) { fx.addEvent('complete', function() { elmt.setStyle('background-color', null); }); } // optionally make bg transparent at end
				fx.start(endColor); // start tween
			});
		},

		compact: function(elmts, o) {
			var options = Object.merge(Object.clone(this.options.tweenOptions), { // merge in passed options
				property: 'height', // the property to tween
				startHeight: null,
				endHeight: 0,
				onComplete: null
			}, o);

			if (typeOf(elmts) == 'element') { elmts = [elmts]; } // turn single elements into array

			elmts.each(function(elmt, index) {
				var fx = new Fx.Tween(elmt, options); // create tween
				if (index == elmts.length-1 && options.onComplete) { fx.addEvent('complete', function() { options.onComplete(elmts); }); } // edd event listener on last elmt
				if (options.startHeight) { elmt.setStyle('height', options.startHeight); } // optionally set a starting height
				fx.start(options.endHeight); // start the tween
			});
		},

		expand: function(elmts, o) {
			var options = Object.merge(Object.clone(this.options.tweenOptions), { // merge in passed options
				property: 'height', // the property to tween
				startHeight: null,
				endHeight: null,
				onComplete: null
			}, o);

			if (typeOf(elmts) == 'element') { elmts = [elmts]; } // turn single elements into array

			elmts.each(function(elmt, index) {
				if (!options.endHeight) { options.endHeight = elmt.measure(function() { // ELSE get height of hidden elmt
					var currHeight = this.getSize().y; // get current height
					this.setStyle('height', ''); // temp set height to auto
					var height = this.getSize().y; // get height
					this.setStyle('height', currHeight); // set height back to original height
					return height; // return height
				}); }

				var fx = new Fx.Tween(elmt, options); // create tween
				if (index == elmts.length-1 && options.onComplete) { fx.addEvent('complete', function() { options.onComplete(elmts); }); } // edd event listener on last elmt
				if (options.startHeight) { elmt.setStyle('height', options.startHeight); } // optionally set a starting height
				fx.start(options.endHeight); // start the tween
			});
		},

		getElmtTween: function(elmt) {
			var tween = elmt.retrieve('tween');
			if (!tween) {
				tween = new Fx.Tween(elmt, this.options.tweenOptions);
				elmt.store('tween', tween);
			}
			return tween;
		},

		// get the morph for an elmt
		// getMorph: function(elmt) {
		// 				var morph = elmt.retrieve('morph');
		// 				if (!morph) {
		// 					morph = new Fx.Morph(elmt, this.options.tweenOptions);
		// 					elmt.store('morph', morph);
		// 				}
		// 				return morph;
		// 			},

		cancelTween: function(tween) {
			tween.cancel();
			tween.removeEvents();
		}

	});
})();