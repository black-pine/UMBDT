var NWLoadingImage = (function(){
	'use strict';

	// TODO MARK: fails when more than one loading image is assigned before first one is deleted
	// TODO MARK: remove loading image from DOM once it is hidden

	return new Class({

		Implements: [Options],

		loadingImageOverlayHTML: function(){ return "<div id='"+this.idOverlay+"' style='opacity:0; display:none'><img src='"+this.options.url+"'/></div>"; },
		loadingImageHTML: function(){ return "<div class='nw-loadingImage' style='opacity:0;'><img src='"+this.options.url+"'/></div>"; },

		// container: null,
		idOverlay: 'nw-loadingImage-overlay',

		options: {
			url: '/images/loading.gif'
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
			var img = Elements.from(this.loadingImageOverlayHTML())[0];
			img.inject(document.body, 'bottom');
		},

		// setupContainer: function(container) {
		// 		this.container = container;
		//
		// 	},


		// ======================================================== PUBLIC METHODS ======================================
		/**
		 * Attach a loading image to something.
		 * Also attach a function to remove the loading image.
		 *
		 * @param Object elmt The element to attach the loading image to.
		 * @param bool overlay Puts an overlay over all content if true.
		 * @return void
		 */
		show: function(elmt) {
			// TODO MARK: fix conflict in ID
			if (elmt) { this.attachLoadingImage(elmt); }
			else { this.showBodyLoadingImage(); }
		},

		/**
		 * Detaches the loading image from an element.
		 *
		 * @param Object elmt The element to detach the loading image from.
		 * @return void
		 */
		hide: function(elmt) { // hide the global loading image
			if (elmt) { if (typeOf(elmt.rialtoDetachLoadingImage) == 'function') { elmt.rialtoDetachLoadingImage(); } }
			else { this.hideBodyLoadingImage(); }
		},


		// ======================================================== PROTECTED METHODS ======================================
		attachLoadingImage: function(elmt) {
			if (typeOf(elmt.rialtoDetachLoadingImage) == 'function') { return; }
			var img = Elements.from(this.loadingImageHTML())[0]; // create loading image object
			elmt.rialtoDetachLoadingImage = function(){ // make detach loading image function on elmt
				$NW.fx.fadeOut(img, {destroy:true}); // fade out loading image and destroy it
				delete elmt.rialtoDetachLoadingImage;
			};
			if (elmt.getStyle('position') == 'static') { elmt.setStyle('position', 'relative'); } // make sure elmt has some sort of positioning
			img.inject(elmt, 'bottom'); // inject loading image into elmt
			$NW.fx.fadeIn(img); // fade in the loading image
		},

		showBodyLoadingImage: function() {
			$NW.fx.fadeIn($(this.idOverlay));
		},

		hideBodyLoadingImage: function() {
			$NW.fx.fadeOut($('nw-loadingImage-overlay'), {hide: true});
		}

	});
})();
