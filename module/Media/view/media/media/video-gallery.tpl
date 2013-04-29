<div id='video-search-criteria'>
	<form id='form-videoSearchTerms' class='NWForm:ajax' data-nwForm-preDCB='onVideoSearchTermsSubmitted' data-nwForm-postDCB='onVideoSearchReturned' method='GET'>
		<div>
			<label for='formVideoSearchTerms-year'>Year</label>
			<select id='formVideoSearchTerms-year' />
				<option value=''>All</option>
				<option value='2011'>2011</option>
				<option value='2010'>2010</option>
				<option value='2009'>2009</option>
				<option value='2008'>2008</option>
				<option value='2007'>2007</option>
			</select>
		</div>
		<div>
			<label for='formVideoSearchTerms-event'>Event</label>
			<select id='formVideoSearchTerms-event' />
				<option value=''>All</option>
				<option value='Competiton'>Competiton</option>
				<option value='Showcase'>Showcase</option>
				<option value='SocialEvent'>Social Event</option>
				<option value='Tryouts'>Tryouts</option>
			</select>
		</div>
		<div>
			<label for='formVideoSearchTerms-location'>Location</label>
			<select id='formVideoSearchTerms-location'/>
				<option value=''>All</option>
				<option value='Purdue'>Purdue</option>
				<option value='OSB'>OSB</option>
				<option value='Arnold'>Arnold</option>
				<option value='Michigan'>Michigan</option>
				<option value='Northwestern'>Northwestern</option>
				<option value='NotreDame'>Notre Dame</option>
			</select>
		</div>
		<div>
			<label for='formVideoSearchTerms-level'>Level</label>
			<select id='formVideoSearchTerms-level' />
				<option value=''>All</option>
				<option value='Newcomer'>Newcomer</option>
				<option value='Bronze'>Bronze</option>
				<option value='Silver'>Silver</option>
				<option value='Gold'>Gold</option>
				<option value='Novice'>Novice</option>
				<option value='PreChamp'>Pre Champ</option>
				<option value='Champ'>Champ</option>
			</select>
		</div>
		<div>
			<label for='formVideoSearchTerms-style'>Style</label>
			<select id='formVideoSearchTerms-style' />
				<option value=''>All</option>
				<option value='AmWaltz'>Am - Waltz</option>
				<option value='AmFoxtrot'>Am - Foxtrot</option>
				<option value='AmTango'>Am - Tango</option>
				<option value='VietWaltz'>Viet - Waltz</option>
				<option value='AmRumba'>Am - Rumba</option>
				<option value='AmChacha'>Am - Chacha</option>
				<option value='Swing'>Swing</option>
				<option value='IntWaltz'>Int - Waltz</option>
				<option value='IntFoxtrot'>Int - Foxtrot</option>
				<option value='IntTango'>Int - Tango</option>
				<option value='IntRumba'>Int - Rumba</option>
				<option value='IntChacha'>Int - Chacha</option>
				<option value='Samba'>Samba</option>
				<option value='Jive'>Jive</option>
				<option value='PasoDoble'>Paso Doble</option>
			</select>
		</div>
		<br />
		<div>
			<input type='submit' value='Search' />
		</div>
	</form>
</div>

<div class='spacer-large'></div>

<div class='videoGallery'>
	<ul class='videoThumbs'>
	</ul>
</div>

{literal}<script type='text/javascript'>
	function onVideoSearchTermsSubmitted () {
		var url = 'https://gdata.youtube.com/feeds/api/users/UMBDT/uploads/{keywords}?alt=json';
		var terms = '';
		if ($('formVideoSearchTerms-year').get('value') != '')  terms += '/' + $('formVideoSearchTerms-year').get('value');
		if ($('formVideoSearchTerms-event').get('value') != '')  terms += '/' + $('formVideoSearchTerms-event').get('value');
		if ($('formVideoSearchTerms-location').get('value') != '')  terms += '/' + $('formVideoSearchTerms-location').get('value');
		if ($('formVideoSearchTerms-level').get('value') != '')  terms += '/' + $('formVideoSearchTerms-level').get('value');
		if ($('formVideoSearchTerms-style').get('value') != '')  terms += '/' + $('formVideoSearchTerms-style').get('value');
		if (terms != '') terms = '-' + terms;
		var searchValues = {keywords: terms};
		url = url.substitute(searchValues);
		$('form-videoSearchTerms').set('action', url);
		return true;
	};

	function onVideoSearchReturned (data) {
		// TODO : return more than 25 entries
		var entries = JSON.decode(data).feed.entry;
		if (!entries) {
			$NW.getPlugin('NWFlashMessage').show('No videos meet the search criteria!!');
			return false;
		}
		$$('.videoThumbs')[0].empty();
		Array.each(entries, returnVideoInformation);
	};

	function returnVideoInformation (entry, index, entries) {
		var title = new Element('p', {html: entry.title.$t, 'class': 'videoTitle'});
		var link = new Element('a', {href: entry.link[0].href, 'class': 'videoLink', 'title': entry.title.$t});
		var thumb = new Element('img', {src: entry.media$group.media$thumbnail[0].url, 'class': 'videoThumbImg'});
		//thumb.inject(link);
		var li = new Element('li');
		title.inject(link);
		link.inject(li, 'bottom');
		li.inject($$('.videoThumbs')[0]);

		$j('.videoLink').click(function() {
			$j.fancybox({
				'padding'		: 0,
				'autoScale'		: false,
				'transitionIn'	: 'none',
				'transitionOut'	: 'none',
				'title'			: this.title,
				'width'			: 680,
				'height'		: 495,
				'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
				'type'			: 'swf',
				'swf'			: {
					'wmode'			: 'transparent',
					'allowfullscreen'	: 'true'
				}
			});
			return false;
		});
	};


</script>{/literal}