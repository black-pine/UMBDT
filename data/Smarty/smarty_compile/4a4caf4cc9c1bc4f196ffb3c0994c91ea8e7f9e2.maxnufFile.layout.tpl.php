<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-24 00:00:17
         compiled from "/Users/Sumi/Sites/UMBDT/module/Application/view/layout/layout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1371995809517470e1cedfb8-68507863%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4a4caf4cc9c1bc4f196ffb3c0994c91ea8e7f9e2' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Application/view/layout/layout.tpl',
      1 => 1366754203,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '1371995809517470e1cedfb8-68507863',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_517470e1e78eb6_25181935',
  'variables' => 
  array (
    'this' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517470e1e78eb6_25181935')) {function content_517470e1e78eb6_25181935($_smarty_tpl) {?><!DOCTYPE html>
<html lang='en'>
	
	<?php echo $_smarty_tpl->getSubTemplate ('layout/partials/_head.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
	<body onUnload=''>

		<div id='wrapper'>

			<?php echo $_smarty_tpl->getSubTemplate ('layout/partials/_header.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

			<div id='content-wrapper'> <!-- CONTENT TOP -->

				<!-- PHP FLASH MESSENGER -->
				<?php echo $_smarty_tpl->tpl_vars['this']->value->content;?>
<!-- PAGE CONTENT -->
	
			</div> <!-- CONTENT BOTTOM -->
			<?php echo $_smarty_tpl->getSubTemplate ('layout/partials/_footer.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>

	
		</div> <!-- WRAPPER -->

	</body>
</html>
<?php }} ?>