<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-24 17:14:42
         compiled from "/Users/Sumi/Sites/UMBDT/module/Application/view/application/contact/contact-us.tpl" */ ?>
<?php /*%%SmartyHeaderCode:17059649285177f6e2123805-70018083%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2dbbdd46df3276a2332cb4e6aa993ae7f3a066a2' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Application/view/application/contact/contact-us.tpl',
      1 => 1352742915,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '17059649285177f6e2123805-70018083',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteRoot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5177f6e226caa9_19065950',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5177f6e226caa9_19065950')) {function content_5177f6e226caa9_19065950($_smarty_tpl) {?><form id='form-contactUs' class='NWForm:json' data-nwForm-postDCB='onContactUsFormReceived' method='post' action='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/contact/contact-us'>
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

<script type='text/javascript'>
		function onContactUsFormReceived (data)  {
			if(data.success)  {
				$NW.getPlugin('NWFlashMessage').show('The form was successfully submitted!');
			}
			else  {
				$NW.getPlugin('NWFlashMessage').show('Your registration was not complete.');
			}
		};
</script><?php }} ?>