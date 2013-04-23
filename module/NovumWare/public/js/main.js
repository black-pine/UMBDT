// @codekit-prepend 'methods.js'
// @codekit-prepend 'jquery/jquery-1.9.1.js'
// @codekit-prepend 'jquery/ui/jquery-ui-1.10.1.custom.js'
// @codekit-prepend 'jquery/plugins/fancybox/jquery.fancybox.js'
// @codekit-prepend 'jquery/plugins/fancybox/helpers/jquery.fancybox-buttons.js'
// @codekit-prepend 'jquery/plugins/fancybox/helpers/jquery.fancybox-media.js'
// @codekit-prepend 'jquery/plugins/fancybox/helpers/jquery.fancybox-thumbs.js'
// @codekit-prepend 'jqueryNoConflict.js'

// @codekit-prepend 'mootools/mootools-core-1.4.5.js'
// @codekit-prepend 'mootools/mootools-more-1.4.0.1.js'
// @codekit-prepend 'mootools/plugins/DatePicker/Locale.en-US.DatePicker.js'
// @codekit-prepend 'mootools/plugins/DatePicker/Picker.js'
// @codekit-prepend 'mootools/plugins/DatePicker/Picker.Attach.js'
// @codekit-prepend 'mootools/plugins/DatePicker/Picker.Date.js'
// @codekit-prepend 'mootools/plugins/Uploads/Request.File.js'
// @codekit-prepend 'mootools/plugins/Uploads/Form.MultipleFileInput.js'
// @codekit-prepend 'mootools/plugins/Uploads/Form.Upload.js'

// @codekit-prepend 'mootools/novumWare/NovumWare.js'
// @codekit-prepend 'mootools/novumWare/NWPlugins.js'
// @codekit-prepend 'mootools/novumWare/NWEvent.js'
// @codekit-prepend 'mootools/novumWare/NWFx.js'
// @codekit-prepend 'mootools/novumWare/NWInit.js'
// @codekit-prepend 'mootools/novumWare/NWClosure.js'

// @codekit-prepend 'mootools/novumWare/Bubble/NWBubble.js'
// @codekit-prepend 'mootools/novumWare/LoadingImage/NWLoadingImage.js'
// @codekit-prepend 'mootools/novumWare/Ajax/NWAjax.js'
// @codekit-prepend 'mootools/novumWare/LoadReplaces/NWLoadReplaces.js'
// @codekit-prepend 'mootools/novumWare/FlashMessage/NWFlashMessage.js'
// @codekit-prepend 'mootools/novumWare/Link/NWLink.js'
// @codekit-prepend 'mootools/novumWare/DatePicker/NWDatePicker.js'
// @codekit-prepend 'mootools/novumWare/Delete/NWDelete.js'
// @codekit-prepend 'mootools/novumWare/Dialog/NWDialog.js'
// @codekit-prepend 'mootools/novumWare/ImageBook/NWImageBook.js'
// @codekit-prepend 'mootools/novumWare/Tooltip/NWTooltip.js'
// @codekit-prepend 'mootools/novumWare/Tooltip/NWTooltipElmt.js'
// @codekit-prepend 'mootools/novumWare/Hint/NWHint.js'
// @codekit-prepend 'mootools/novumWare/Hint/NWHintElmt.js'
// @codekit-prepend 'mootools/novumWare/Tour/NWTour.js'
// @codekit-prepend 'mootools/novumWare/Popup/NWPopup.js'
// @codekit-prepend 'mootools/novumWare/Tabs/NWTabs.js'
// @codekit-prepend 'mootools/novumWare/Scroll/NWScroll.js'
// @codekit-prepend 'mootools/novumWare/RolloverImage/NWRolloverImage.js'
// @codekit-prepend 'mootools/novumWare/Form/Validator/NWValidator.js'
// @codekit-prepend 'mootools/novumWare/Form/Validator/CustomValidators.js'
// @codekit-prepend 'mootools/novumWare/Form/NWForm.js'
// @codekit-prepend 'mootools/novumWare/Form/NWFormElmt.js'
// @codekit-prepend 'mootools/novumWare/Upload/NWUpload.js'
// @codekit-prepend 'mootools/novumWare/Upload/NWUploadElmt.js'
// @codekit-prepend 'mootools/novumWare/Gallery/NWGallery.js'
// @codekit-prepend 'mootools/novumWare/Gallery/NWGalleryElmt.js'

window.addEvent('domready', function() {
	// var nwOptionsDefault = {
		// NWLoadingImage: {
			// url: '/images/loading.gif'
		// }
	// };
	// var nwOptions = document.nwOptions || {};
	// nwOptions = Object.merge(nwOptions, nwOptionsDefault);
	$NW = new NovumWare();
	$NW.setup();
});