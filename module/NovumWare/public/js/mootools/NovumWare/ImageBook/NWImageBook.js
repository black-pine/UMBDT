var NWImageBook = (function(){
	// TODO MARK: make sure that when no images are present the add images work.
	// TODO MARK: make sure that the big image can bring out the popup windows as well too
	// TODO MARK: make sure that when images are on hover, it loads the appropriate sized image in regards to the size of the book.
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'nw-imageBook',
		classMainImage: 'nw-imageBook-mainImage',

		options: {
			largeImageURLAttr: 'data-nwImageBook-largeImageURL'
		},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},

		getImageLi: function(image, thumb){ return Elements.from('<li><a><img src="'+thumb+'" data-nwImageBook-largeImageURL="'+image+'" /></a></li>'); },


		// ======================================================== SETUP METHODS ======================================
		// setup an elmt
		setup: function(book) {
			var mainImage = book.getElement('.'+this.classMainImage+' img').get('src'); // get main image
			book.mainImage = mainImage;
			book.addEvent('mouseenter:relay(li img)', function(event){ this.onMouseEnter(event.target); }.bind(this)); // add mouseover event to li's
			book.addEvent('mouseleave:relay(li img)', function(event){ this.onMouseLeave(event.target); }.bind(this)); // add mouseleave event to li's
		},

		// setup all relavant elmts in a given container
		setupContainer: function(container) {
			container.getElements('.'+this.classPlugin).each(function(elmt) { // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},


		// ======================================================== PUBLIC METHODS ======================================
		addImageToBook: function(book, image, thumb) {
			var newLi = this.getImageLi(image, thumb);
			newLi.setStyle('opacity', 0);
			var ul = book.getElement('ul'); // get ul
			if(ul) { // IF there is already a main image
				ul.grab(newLi[0]); // create a new thumb
				$NW.fx.fadeIn(newLi); // add the thumb
			} else { // ELSE (there is no main image yet)
				var mainImg = book.getElement('.nw-imageBook-mainImage img'); // get main image
				mainImg.set('src', image); // set the main image
				book.grab(new Element('ul'));
			}
		},

		/**
		 * Activate a thumbnail to change to the main image.
		 *
		 * @param Object elmt The licked thumbnail.
		 * @return void
		 */
		/*click: function(elmt) {
			var book = elmt.getParent('.'+self.options.class); // get the whole book element
			book.getElements('ul > li.selected').removeClass('selected'); // remove selected class from current
			elmt.getParent('li').addClass('selected'); // add selected class to clicked
			var newImage = elmt.getParent('a').get('href'); // get new image src
			book.getElements('.'+self.options.mainImageClass+' > img')[0].set('src', newImage); // replace main image with new image
		}*/


		// ======================================================== EVENT LISTENERS ======================================
		onMouseEnter: function(img) {
			var largeImageURL = img.get(this.options.largeImageURLAttr);
			var book = img.getParent('.'+this.classPlugin); // get the whole book element
			book.getElement('.'+this.classMainImage+' img').set('src', largeImageURL); // replace main image with new image
		},

		onMouseLeave: function(img) {
			var book = img.getParent('.'+this.classPlugin); // get the whole book element
			book.getElement('.'+this.classMainImage+' img').set('src', book.mainImage); // reset main image
		}

	});
})();
