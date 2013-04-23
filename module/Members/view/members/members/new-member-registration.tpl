<form id='form-newMemberRegistration' class='NWForm:json' data-nwForm-postDCB='onNewRegistrationFormReceived' action='{$siteRoot}/join/new-member-registration' method='post'>
	<div>
		<label for='formNewMemberRegistration-firstName' class='required'>First Name</label>
		<input type='text' id='formNewMemberRegistration-firstName' name='formNewMemberRegistration[firstName]' data-validators='required' />
	</div>
	<div>
		<label for='formNewMemberRegistration-lastName' class='required'>Last Name</label>
		<input type='text' id='formNewMemberRegistration-lastName' name='formNewMemberRegistration[lastName]' data-validators='required' />
	</div>
	<div>
		<label for='formNewMemberRegistration-email' class='required'>Email Address</label>
		<input type='email' id='formNewMemberRegistration-email' name='formNewMemberRegistration[email]' data-validators='required' data-validator-email='required' />
	</div>
	<div>
		<label for='formNewMemberRegistration-phoneNumber'>Phone Number</label>
		<input type='tel' id='formNewMemberRegistration-phoneNumber' name='formNewMemberRegistration[phoneNumber]'  />
	</div>
	<div>
		<label for='formNewMemberRegistration-address'>Address</label>
		<input type='text' id='formNewMemberRegistration-address' name='formNewMemberRegistration[address]' />
	</div>
	<div>
		<label for='formNewMemberRegistration-city'>City</label>
		<input type='text' id='formNewMemberRegistration-city' name='formNewMemberRegistration[city]' />
	</div>
	<div>
		<label for='formNewMemberRegistration-state'>State</label>
		<input type='text' id='formNewMemberRegistration-state' name='formNewMemberRegistration[state]'  />
	</div>
	<div>
		<label for='formNewMemberRegistration-zipcode'>Zipcode</label>
		<input type='text' id='formNewMemberRegistration-zipcode' name='formNewMemberRegistration[zipcode]' />
	</div>
	<div>
		<label for='formNewMemberRegistration-howDidYouHearAboutUs' class='required'>How did you hear about us?</label>
		<select id='formNewMemberRegistration-howDidYouHearAboutUs' name='formNewMemberRegistration[howDidYouHearAboutUs]' data-validators='required' />
			<option value=''>Please make a selection</option>
			<option value='flyer'>Flyer</option>
		    <option value='website'>Website</option>
		    <option value='friends'>Friends</option>
		    <option value='welcomeWeek'>Welcome Week</option>
			<option value='fest'>Festifall, Northfest, or Winterfest</option>
			<option value='other'>Other</option>
		</select>
	</div>
	<div>
		<label for='formNewMemberRegistration-major'>What is your major?</label>
		<input type='text' id='formNewMemberRegistration-major' name='formNewMemberRegistration[major]' />
	</div>
	<div>
		<input type='submit' value='Submit' />
	</div>
</form>

{literal}<style>
	form > div label {
	    width: 200px;
	}
</style>{/literal}

{literal}<script type='text/javascript'>
	function onNewRegistrationFormReceived (data) {
		if(data.success)
		{
			$NW.getPlugin('NWFlashMessage').show('You successfully submitted your registration!');
		}
		else
		{
			$NW.getPlugin('NWFlashMessage').show('Your registration was not complete.');
		}
	};
</script>{/literal}