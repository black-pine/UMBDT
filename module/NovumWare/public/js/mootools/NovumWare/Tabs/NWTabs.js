var NWTabs = (function(){
	// TODO MARK: consecutive clicks on different tabs need to interrupt each other
	'use strict';

	return new Class({

		Implements: [Options],

		classPlugin: 'NWTabs',

		dataPostDCB: 'data-nwTabs-postDCB',
		dataGroup: 'data-nwTabs-group',
		dataURL: 'data-nwTabs-url',

		classCurrent: 'nwTabs-current',

		options: {},

		initialize: function(options) {
			this.setOptions(options); // override default options
		},


		// ======================================================== PUBLIC METHODS ======================================
		// setup an elmt
		setup: function(tab) {
			this.show(tab);
			// var groupName = tab.get(self.dataGroup); // get group name of tabs
			// 		var containers = $$('['+self.dataGroup+'='+groupName+']:not(.'+self.classPlugin+')'); // get all the containers in this group
			// 		if (containers.length) {
			// 			$Rialto.fx.fadeOut(containers, {duration: 0, hide: true}); // hide all tab content
			// 			if (tab.hasClass(self.classCurrent)) {
			// 				var containers = $$(tab.get('href')); // get associated containers
			// 				$Rialto.callCB(tab.get(self.dataPostDCB), [tab, containers]);
			// 				$Rialto.fx.fadeIn.pass([containers, {duration: 0}]).delay($Rialto.timing+10); // show clicked tab's content
			// 				$Rialto.getPlugin('RialtoLoadReplaces').load(containers); // load replaces in the current container
			// 			}
			// 		}
		},

		// setup all relavant elmts in a given container
		setupContainer: function(container) {
			container.getElements('.'+this.classPlugin+'.'+this.classCurrent).each(function(elmt) { // for each elmt in the container
				this.setup(elmt);
			}.bind(this));
		},

		handleClick: function(elmt, params) {
			this.clickTab(elmt);
		},

		clickTab: function(tab) {
			if (tab.hasClass(this.classCurrent)) { return; } // don't do anything if the clicked tab is the current one
			var groupName = tab.get(this.dataGroup); // get the group name of clicked tab
			// TODO MARK: add support for multiple current tabs?
			var oldTab = $$('.'+this.classPlugin+'.'+this.classCurrent+'['+this.dataGroup+'="'+groupName+'"]')[0]; // get the old tab
			if (oldTab) {
				oldTab.removeClass(this.classCurrent);
				this.hide(oldTab);
			}
			tab.addClass(this.classCurrent); // add current class
			(function(){ this.show(tab); }.bind(this)).delay($NW.timing+300); // show the new tab's contents
		},


		// ======================================================== PRIVATE METHODS ======================================
		hide: function(tab) {
			var href = tab.get('href'); // get href
			//tab.removeClass(this.classCurrent); // remove current class
			var containers = $$(href); // get associated containers
			if (containers) { $NW.fx.fadeOut(containers, {onComplete:function(){
				containers.removeClass(this.classCurrent);
			}.bind(this)}); } // hide tab contents after fade
		},

		// show a tab
		show: function(tab){
			//tab.addClass(this.classCurrent); // add current class
			var containers = $$(tab.get('href')); // get associated containers

			if (containers) {
				containers.addClass(this.classCurrent);
				$NW.fx.fadeIn(containers); // fade in tab contents
				containers.each(function(container) {
					var url = container.get(this.dataURL);
					if (url) {
						container.set(this.dataURL, null);
						this.loadURLInContainer(container, url);
					}
					else { $NW.getPlugin('NWLoadReplaces').load(container); }
				}, this); // load replaces in each container
			}
			if ($NW.callCB(tab.get(this.dataPostDCB), [tab, containers])) { $NW.callNextPlugin(); }
		},

		loadURLInContainer: function(tabContentContainer, url) {
			var o = { // set ajax options
				url: url,
				onRequest: function() {
					$NW.getPlugin('NWLoadingImage').show(tabContentContainer); // show loading image
				},
				onSuccess: function(responseHTML) {
					var newContent = Elements.from('<span>'+responseHTML+'</span>');
					tabContentContainer.adopt(newContent);
					$NW.getPlugin('NWPlugins').setupContainer(tabContentContainer);
				},
				onComplete: function() {
					$NW.getPlugin('NWLoadingImage').hide(tabContentContainer); // show loading image
				}
			};
			$NW.getPlugin('NWAjax').htmlRequest(o); // make the call
		}

	});
})();
