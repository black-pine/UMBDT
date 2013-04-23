// requires: jQuery fancybox plugin
var NWGalleryElmt = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWGalleryElmt',

		elmt: null,
		elmtMainImage: null,
		elmtThumbsList: null,

		classMainImage: 'nwGallery-mainImage',
		classThumbsList: 'nwGallery-thumbsList',

		dirOriginals: 'originals',

		relString: 'nwGallery-'+Math.floor(Math.random()*10000),

		typeNormal: 'normal',
		typePopup: 'popup',
		type: 'popup',


		// ======================================================== SETUP METHODS ======================================
		initialize: function(elmt, options) {
			if (options.type) { this.type = options.type; }

			this.elmt = elmt;
			this.elmtThumbsList = this.elmt.getElement('.'+this.classThumbsList);
			this.elmt.store(this.classPlugin, this);

			if (this.type == this.typeNormal) { this.setupTypeNormal(); }
			else if (this.type == this.typePopup) { this.setupTypePopup(); }
			else { $NW.throwError('unrecognized type provided: '+this.type); }
		},

		setupTypeNormal: function() {
			console.log('normal');
			this.elmtMainImage = new Element('img.'+this.classMainImage).inject(this.elmtThumbsList, 'before');
			this.elmtMainImage.set('src', this.addOriginalsDir(this.elmtThumbsList.getElement('img').get('src')));
			this.elmtThumbsList.addEvent('click:relay(img)', this.onThumbClick.bind(this));
		},

		setupTypePopup: function() {
			this.elmtThumbsList.getElements('img').each(function(thumb){
				var anchorTag = new Element('a', {rel: this.relString}).wraps(thumb);
				anchorTag.set('href', this.addOriginalsDir(thumb.get('src')));
			}, this);
			$j(this.elmtThumbsList.getElements('a')).fancybox();
		},


		// ======================================================== PUBLIC METHODS ======================================


		// ======================================================== PRIVATE METHODS ======================================
		addOriginalsDir: function(path) {
			var index = path.lastIndexOf('/');
			return path.slice(0, index) + '/' + this.dirOriginals + path.slice(index);
		},


		// ======================================================== EVENT HANDLERS ======================================
		onThumbClick: function(event) {
			this.elmtMainImage.set('src', this.addOriginalsDir(event.target.get('src')));
		}

	});
})();