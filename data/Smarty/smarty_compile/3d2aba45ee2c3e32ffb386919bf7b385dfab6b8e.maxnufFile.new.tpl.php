<?php /* Smarty version Smarty-3.1-DEV, created on 2013-05-01 00:03:11
         compiled from "/Users/Sumi/Sites/UMBDT/module/Rar/view/rar/people/new.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1084818998517dae98e6d562-46392585%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3d2aba45ee2c3e32ffb386919bf7b385dfab6b8e' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Rar/view/rar/people/new.tpl',
      1 => 1367359389,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '1084818998517dae98e6d562-46392585',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_517dae98ea0211_91976447',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517dae98ea0211_91976447')) {function content_517dae98ea0211_91976447($_smarty_tpl) {?><fieldset>
	<legend>New Person</legend>
	<form action='/rar/people/new' method='post' class='NWForm' >
		<div>
			<label>Name</label>
			<input type='text' name='newPersonForm[name]' data-validators='required' onblur='checkName(this.value)' />
		</div>
		<div>
			<label>E-mail</label>
			<input type='email' name='newPersonForm[email]' data-validators='required validate-email' />
		</div>
		<div>
			<label>Phone Number</label>
			<input type='text' name='newPersonForm[phone]' data-validators='required' />
		</div>
		<div>
			<label>When can you leave?</label>
			<input type='text' name='newPersonForm[departureTime]' data-validators='required' />
		</div>
		<div>
			<label class='checkbox'>
				<input type='checkbox' name='newPersonForm[driver]' class="validate-toggle-oncheck toToggle:['newPersonForm-capacity']" />
				I have a car I can drive
			</label>
		</div>
		<div>
			<label>How many people (including yourself) can you fit in your car?</label>
			<input type='text' name='newPersonForm[capacity]' id='newPersonForm-capacity' />
		</div>
		<div>
			<label>Preference 1</label>
			<input type='text' name='newPersonForm[preference1]' />
		</div>
		<div>
			<label>Preference 2</label>
			<input type='text' name='newPersonForm[preference2]' />
		</div>
		<div>
			<label>Antipreference 1</label>
			<input type='text' name='newPersonForm[antipreference1]' />
		</div>
		<div>
			<label>Antipreference 2</label>
			<input type='text' name='newPersonForm[antipreference2]' />
		</div>
		<div>
			<button type='submit'>Submit</button>
		</div>
	</form>
</fieldset>


	<script type='text/javascript'>
		function checkName(name) {
			var o = {
				'url' : '/rar/people/check-name-input',
				'data' : {'name' : name}
			};
			$NW.getPlugin('NWAjax').jsonRequest(o);
		}
	</script>
<?php }} ?>