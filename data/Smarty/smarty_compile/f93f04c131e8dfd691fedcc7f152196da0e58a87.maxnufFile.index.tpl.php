<?php /* Smarty version Smarty-3.1-DEV, created on 2013-05-04 21:03:35
         compiled from "/Users/Sumi/Sites/UMBDT/module/Rar/view/rar/rides/index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20258042925182d27d081532-53206242%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f93f04c131e8dfd691fedcc7f152196da0e58a87' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Rar/view/rar/rides/index.tpl',
      1 => 1367694214,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '20258042925182d27d081532-53206242',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_5182d27d1ac2b3_35635219',
  'variables' => 
  array (
    'driversArray' => 0,
    'driver' => 0,
    'ridersArray' => 0,
    'rider' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5182d27d1ac2b3_35635219')) {function content_5182d27d1ac2b3_35635219($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_rarFormatDate')) include '/Users/Sumi/Sites/UMBDT/module/Rar/config/../src/Smarty/plugins/modifier.rarFormatDate.php';
?><ul id='cars'>
	<?php  $_smarty_tpl->tpl_vars['driver'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['driver']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['driversArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['driver']->key => $_smarty_tpl->tpl_vars['driver']->value){
$_smarty_tpl->tpl_vars['driver']->_loop = true;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['driver']->value['name'];?>
 - <?php echo smarty_modifier_rarFormatDate($_smarty_tpl->tpl_vars['driver']->value['departureTime']);?>
 ( <?php echo $_smarty_tpl->tpl_vars['driver']->value['capacity'];?>
 ) <ul class='seats'> </ul> </li>
	<?php } ?>
</ul>

<ul id='riders'>
	<?php  $_smarty_tpl->tpl_vars['rider'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['rider']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ridersArray']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['rider']->key => $_smarty_tpl->tpl_vars['rider']->value){
$_smarty_tpl->tpl_vars['rider']->_loop = true;
?>
		<li><?php echo $_smarty_tpl->tpl_vars['rider']->value['name'];?>
 - <?php echo smarty_modifier_rarFormatDate($_smarty_tpl->tpl_vars['rider']->value['departureTime']);?>
</li>
	<?php } ?>
</ul>


	<style>
		#riders li, .seats li {
			cursor: move;
		}

		.seats, #riders {
			min-height: 20px;
		}

		#riders, #cars > li {
			border: 2px solid #000000;
			margin: 0px 5px 5px;
			padding: 5px;
		}

		#cars, #riders {
			margin: 5px;
			width: 450px;
			display: inline-block;
		}
	</style>

	<script type='text/javascript'>
		var cars = $$('.seats');
		new Sortables(new Array(cars, $('riders')));
	</script>
<?php }} ?>