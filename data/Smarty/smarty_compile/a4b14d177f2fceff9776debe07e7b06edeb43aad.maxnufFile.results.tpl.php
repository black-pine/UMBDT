<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-24 05:12:53
         compiled from "/Users/Sumi/Sites/UMBDT/module/Competitions/view/competitions/competitions/results.tpl" */ ?>
<?php /*%%SmartyHeaderCode:157527987251774db5a30654-94997935%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4b14d177f2fceff9776debe07e7b06edeb43aad' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Competitions/view/competitions/competitions/results.tpl',
      1 => 1354141207,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '157527987251774db5a30654-94997935',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_51774db5a53888_80431492',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51774db5a53888_80431492')) {function content_51774db5a53888_80431492($_smarty_tpl) {?><form id='form-resultsSearchTerms' class='NWForm:ajax' data-nwForm-preDCB='onResultsSearchTermsSubmitted'>
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

<script type='text/javascript'>
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
</script><?php }} ?>