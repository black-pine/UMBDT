<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-24 17:24:07
         compiled from "/Users/Sumi/Sites/UMBDT/module/Members/view/members/members/new-member-registration.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8115859945177f91719a078-95104895%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '606cf10c098791e0e4ff6a7e53e8aef3dd0fb934' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Members/view/members/members/new-member-registration.tpl',
      1 => 1354137983,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '8115859945177f91719a078-95104895',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteRoot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5177f917228828_85724822',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5177f917228828_85724822')) {function content_5177f917228828_85724822($_smarty_tpl) {?><form id='form-newMemberRegistration' class='NWForm:json' data-nwForm-postDCB='onNewRegistrationFormReceived' action='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/join/new-member-registration' method='post'>
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

<style>
	form > div label {
	    width: 200px;
	}
</style>

<script type='text/javascript'>
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
</script><?php }} ?>