<div id='content'>
	{function printNestedDirs}
	  <ul>
		  {foreach $dirs as $dirName=>$gallery}
			  <li>
				  {if !empty($gallery)}
					  <a class='collapsibleDir'>
						  <span class='icon icon-arrow-e'></span>
						  {$dirName}
					  </a>
					  {printNestedDirs dirs=$gallery path="$path$dirName/"}
				  {else}
					  <a href='/media/media/display-gallery/{$path}{$dirName}' class='NWLink:ajax' data-nwLink-successCB='onGalleryResponse'>{$dirName}</a>
				  {/if}
			  </li>
		  {/foreach}
	  </ul>
	{/function}

	<div class='photoGalleryNav'>
		Galleries:
		<br />
		{printNestedDirs dirs = $galleries}
	</div>

	<div id='photoGallery'></div>
</div>

{literal}<script type='text/javascript'>
	function onGalleryResponse(data) {
		var photoGalleryDiv = $('photoGallery');
		photoGalleryDiv.empty();
		var imageGallery = new Element('div', {html: data});
		imageGallery.inject(photoGalleryDiv);
		$NW.getPlugin('NWPlugins').setupContainer(photoGalleryDiv);
		return true;
	}

	$$('.collapsibleDir').addEvent('click', function(event) {
		var targetElmt = this;
		if (!targetElmt.hasClass('collapsibleDir')) return;
		var childUl = targetElmt.getNext('ul');
		childUl.toggle();
		if (targetElmt.getElement('span').hasClass('icon-arrow-e')) targetElmt.getElement('span').removeClass('icon-arrow-e').addClass('icon-arrow-s');
		else targetElmt.getElement('span').removeClass('icon-arrow-s').addClass('icon-arrow-e');
		event.stopPropagation();
	});
</script>{/literal}
