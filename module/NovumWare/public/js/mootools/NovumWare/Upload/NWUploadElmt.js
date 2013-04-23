var NWUploadElmt = (function(){
	'use strict';

	return new Class({
		// TODO MARK: do each upload individually with it's own progress bar
		// TODO MARK: make sure upload failures are handled
		// TODO MARK: add validation (type / size / etc)
		// TODO MARK: upgrade to HTML5
		// TODO MARK: make submit button unclickable after removing the last file for upload

		Implements: [Options],

	//	dataAllowedTypes: 'data-nwUpload-allowedTypes',
	//	dataMaxKB: 'data-nwUpload-maxKB',

		elmt: null,
		elmtInput: null,
		elmtDropArea: null,
		elmtFileList: null,
		elmtProgressBar: null,
		elmtSubmitButtons: null,

		classPlugin: 'NWUploadElmt',
		classInput: 'nwUpload-input',
		classDropArea: 'nwUpload-dropArea',
		classDragHover: 'nwUpload-dragHover',
		classFileList: 'nwUpload-fileList',
		classProgressBar: 'nwUpload-progressBar',

		textDropArea: 'Drop your files here!',

		htmlFileRow: function(file){return '<li>'+file.name+'<span class="icon icon-x"></span`></li>';},

		inputName: 'uploads',
		files: [],
		uploadRequest: null,

		// options: {},


		// ======================================================== SETUP METHODS ======================================
		initialize: function(elmt) {
			// this.setOptions(options);
			this.elmt = elmt;
			this.elmt.store(this.classPlugin, this);

			this.elmtSubmitButtons = this.elmt.getElements("[type='submit']").set('disabled', 'disabled');

			this.elmtInput = this.elmt.getElements('.'+this.classInput)[0];
			if (!this.elmtInput) { $NW.throwError('Could not find an elmtInput'); }
			this.elmtInput.set('multiple', true);

			this.inputName = this.elmtInput.get('name') || this.inputName;
			if (this.inputName.slice(-2) != '[]') { this.inputName += '[]'; }

			this.elmtDropArea = new Element('div.'+this.classDropArea, {
				text: this.textDropArea
			}).inject(this.elmtInput, 'after');

			this.elmtFileList = new Element('ul.'+this.classFileList).inject(this.elmtDropArea, 'after');

			this.uploadRequest = new Request.File({
				onRequest: this.onRequest.bind(this),
				onProgress: this.onProgress.bind(this),
				onComplete: this.onComplete.bind(this)
			});

			this.elmtProgressBar = new Element('div.'+this.classProgressBar).setStyle('display', 'none').inject(this.elmtFileList, 'after');


			this.elmtInput.addEvent('change', function(event) {
				Array.each(this.elmtInput.files, this.addFile, this);
				event.target.value = null;
			}.bind(this));

			this.elmtDropArea.addEvents({
				dragenter: this.onDropAreaDragEnter.bind(this),
				dragleave: this.onDropAreaDragLeave.bind(this),
				drop: this.onDropAreaDrop.bind(this)
			});

			this.elmt.addEvent('submit', this.onSubmit.bind(this));
		},


		// ======================================================== PUBLIC METHODS ======================================
		reset: function() {
			this.elmtSubmitButtons.set('disabled', 'disabled');
			this.elmtInput.set('value', null);
			while (this.files.length) { this.removeFile(this.files[this.files.length-1]); }
			this.files = [];
			$NW.fx.fadeOut(this.elmtProgressBar, {onComplete: function(){
				this.elmtProgressBar.setStyle('width', '0%').fade('in');
			}.bind(this)});
			this.uploadRequest.reset();
		},


		// ======================================================== PRIVATE METHODS ======================================
		addFile: function(file) {
			if (!this.validateFile(file)) { return; }
			var fileRow = Elements.from(this.htmlFileRow(file))[0];
			file.fileRow = fileRow;
			this.files.push(file);
			fileRow.getElements('.icon-x')[0].addEvent('click', function(event){
				this.removeFile(file);
			}.bind(this));
			$NW.injectAndFadeIn(fileRow, this.elmtFileList);
			this.elmtSubmitButtons.set('disabled', null);
		},

		removeFile: function(file) {
			var index = this.files.indexOf(file);
			if (index == -1) { $NW.throwError('file not found...'); }
			this.files.splice(index, 1);
			$NW.fx.fadeOut(file.fileRow, {destroy:true});
			if (this.files.length < 1) { this.elmtSubmitButtons.set('disabled', true); }
		},

		validateFile: function(file) {
			// var dataAllowedTypes = this.elmtInput.get(this.dataAllowedTypes);
			// if (dataAllowedTypes && dataAllowedTypes.indexOf(file.type) == -1) $NW.getPlugin('NWFlashMessage').show('File type must be one of: '+dataAllowedTypes);
			return true;
		},


		// ======================================================== EVENT HANDLERS ======================================
		onDropAreaDragEnter: function(event) {
			event.preventDefault();
			this.elmtDropArea.addClass(this.classDragHover);
		},

		onDropAreaDragLeave: function(event) {
			event.preventDefault();
			this.elmtDropArea.removeClass(this.classDragHover);
		},

		onDropAreaDrop: function(event) {
			event.preventDefault();
			this.onDropAreaDragLeave(event);
			if (event.event.dataTransfer) { Array.each(event.event.dataTransfer.files, this.addFile, this); }
		},

		onSubmit: function(event) {
			event.preventDefault();
			Array.each(this.files, function(file){
				this.uploadRequest.append(this.inputName, file);
			}, this);
			this.elmtProgressBar.setStyle('width', '0%').setStyle('display', null);
			this.uploadRequest.send();
		},

		onRequest: function(event) {},

		onProgress: function(event) {
			this.elmtProgressBar.setStyle('width', parseInt((event.loaded / event.total) * 100, 10) + '%');
		},

		onComplete: function(event) {
			$NW.getPlugin('NWFlashMessage').show('Upload complete!');
			this.reset();
		}

	});
})();