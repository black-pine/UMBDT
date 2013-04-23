<form id='form-resultsSearchTerms' class='NWForm:ajax' data-nwForm-preDCB='onResultsSearchTermsSubmitted'>
	<div>
		<label for='formResultsSearchTerms-comp'>Competition</label>
		<select id='formResultsSearchTerms-comp' />
			<option value='ncc'>USA Dance National Collegiate Dancesport Championship</option>
		    <option value='pbc'>Purdue Ballroom Competition</option>
			<option value='uofm'>University of Michigan Competition</option>
		</select>
	</div>
	<div>
		<label for='formResultsSearchTerms-year'>Year</label>
		<select id='formResultsSearchTerms-year' />
			<option value='12'>2012</option>
			<option value='11'>2011</option>
		    <option value='10'>2010</option>
		    <option value='09'>2009</option>
		    <option value='08'>2008</option>
			<option value='07'>2007</option>
		</select>
	</div>
	<div>
		<input type='submit' value='Submit' />
	</div>
</form>

<iframe id='resultsIframe' src='' width='700' height='900'></iframe>

{literal}<script type='text/javascript'>
	function onResultsSearchTermsSubmitted () {
		var compKey = $('formResultsSearchTerms-comp').get('value');
		var yearKey = $('formResultsSearchTerms-year').get('value');
		var eventKey = '';
		if(compKey == 'ncc' || compKey == 'pbc') {
			var url = 'http://www.o2cm.com/Results/event3.asp?event={event}';
			eventKey += compKey + yearKey;
		}
		else {
			var url = 'http://www.dance.zsconcepts.com/results/{event}';
			eventKey += compKey + '20' + yearKey;
		}
		var substituteValues = {event: eventKey};
		url = url.substitute(substituteValues);
		$('resultsIframe').set('src', url);
		return false;
	};
</script>{/literal}