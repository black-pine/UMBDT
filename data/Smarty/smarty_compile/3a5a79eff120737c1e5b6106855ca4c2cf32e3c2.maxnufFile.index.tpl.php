<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-29 21:31:22
         compiled from "/Users/Sumi/Sites/UMBDT/module/Application/view/application/index/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:44438662351746a792c49c9-92542721%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a5a79eff120737c1e5b6106855ca4c2cf32e3c2' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Application/view/application/index/index.tpl',
      1 => 1367260517,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '44438662351746a792c49c9-92542721',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_51746a7930dd55_35836333',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51746a7930dd55_35836333')) {function content_51746a7930dd55_35836333($_smarty_tpl) {?><ul>
	<li><a href='/examples'>Examples</a></li>
	<a href='/' class='NWFlashMessage NWLink:ajax NWDelete' data-nwLink-preDCB='linkPredispatch' data-nwLink-successCB='response' data-nwFlashMessage-message='Only 9 percent of giraffe sex is heterosexual.'>Click me</a>
</ul>


	<script type='text/javascript'>
		function linkPredispatch(elmt) {
			console.log(elmt);
			return true;
		}

		function response(response, elmt) {
			console.log(response);
			return true;
		}
	</script>
<?php }} ?>