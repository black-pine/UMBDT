<div id='content'>
	<form id='form-contactUs' class='NWForm:json' data-nwForm-postDCB='onContactUsFormReceived' method='post' action='{$siteRoot}/contact/contact-us'>
		<div>
			<label for='formContactUs-name'>Name</label>
			<input type='text' id='formContactUs-name' name='formContactUs[name]' placeholder='name' data-validators='required' />
		</div>
		<div>
			<label for='formContactUs-email'>Email</label>
			<input type='email' id='formContactUs-email' name='formContactUs[email]' placeholder='email' data-validators='required'/>
		</div>
		<div>
			<label for='formContactUs-inquiry'>Inquiry</label>
			<textarea id='formContactUs-inquiry' name='formContactUs[inquiry]' placeholder='Your inquiry here...' data-validators='required'></textarea>
		</div>
		<div>
			<input type='submit' value='Submit' />
		</div>
	</form>
</div>

{literal}<script type='text/javascript'>
		function onContactUsFormReceived (data)  {
			if(data.success)  {
				$NW.getPlugin('NWFlashMessage').show('The form was successfully submitted!');
			}
			else  {
				$NW.getPlugin('NWFlashMessage').show('Your registration was not complete.');
			}
		};
</script>{/literal}