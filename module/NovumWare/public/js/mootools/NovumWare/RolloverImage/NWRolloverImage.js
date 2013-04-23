var NWRolloverImage = (function(){
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'nwRolloverImage',

		//dataOverImage: 'data-nwRolloverImage-over',
		dataNormalImage: 'data-nwRolloverImage-normal',

		options: {
			defaultSuffix: '_over'
		},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(options){
			this.setOptions(options); // override default options
		},

		setup: function(elmt) {
			elmt.addEvent('mouseenter', function(){ this.showOver(elmt); }.bind(this));
			elmt.addEvent('mouseleave', function(){ this.showOut(elmt); }.bind(this));
			//$this.hover(function(){ this.src = this.src.replace(settings.off, settings.on); },
			//		   function(){ this.src = this.src.replace(settings.on, settings.off); });
		},

		setupContainer: function(container){
			container.getElements('.'+this.classPlugin).each(function(elmt){ // for each elmt in the container
				this.setup(elmt); // setup the plugin
			}.bind(this));
		},


		// ======================================================== PUBLIC METHODS ======================================
		showOver: function(elmt) {
			var currImage = elmt.get('src'); // get the file path of the image
			var imageName = this.getImageName(currImage); // get the image name
			if (!elmt.get(this.dataNormalImage)) { elmt.set(this.dataNormalImage, imageName); } // set the image to return to on mouse out IF not already set
			//var overImageAttr = elmt.get(this.dataOverImage); // get hover image if it is specified
			//if (overImageAttr) var newImage = currImage.replace(imageName, overImageAttr); // IF hover image is specified
			var newImage = currImage.replace(imageName, imageName+this.options.defaultSuffix); // ELSE (no hover specified)
			elmt.set('src', newImage); // set the new image
		},

		showOut: function(elmt) {
			var currImage = elmt.get('src'); // get the file path of the image
			var imageName = this.getImageName(currImage); // get the image name
			elmt.set('src', currImage.replace(imageName, elmt.get(this.dataNormalImage))); // set back the old image
		},

		// ======================================================== PRIVATE METHODS ======================================
		/**
		* Gets image name from a path (no path or file extension included).
		*
		* @param string path The path from which to find the image name.
		* @return string
		*/
		getImageName: function(path) {
			var lastSlash = path.lastIndexOf('/')+1; // find the last slash
			return path.substr(lastSlash, path.lastIndexOf('.')-lastSlash); // return the image name
		}

	});

})();
