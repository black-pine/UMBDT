<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-24 18:25:44
         compiled from "/Users/Sumi/Sites/UMBDT/module/Media/view/media/media/display-gallery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:970584848517806a53dadc6-58470906%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd0d33c86f7aafc3aa2edcb984740f3a6151aecb6' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Media/view/media/media/display-gallery.tpl',
      1 => 1366820741,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '970584848517806a53dadc6-58470906',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_517806a5448a21_37607706',
  'variables' => 
  array (
    'galleryName' => 0,
    'images' => 0,
    'image' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_517806a5448a21_37607706')) {function content_517806a5448a21_37607706($_smarty_tpl) {?><?php if ($_smarty_tpl->tpl_vars['galleryName']->value){?>
	Images in <?php echo $_smarty_tpl->tpl_vars['galleryName']->value;?>
:
	<br />
	<div class='NWGallery'>
		<ul class='nwGallery-thumbsList'>
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['image']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['images']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
$_smarty_tpl->tpl_vars['image']->_loop = true;
?>
			<li><img src='/images/galleries/<?php echo $_smarty_tpl->tpl_vars['galleryName']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['image']->value;?>
' /></li>
		<?php } ?>
		</ul>
	</div>
<?php }?>

<style>
	li ul {
		margin-left: 20px;
	}
</style><?php }} ?>