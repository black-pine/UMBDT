<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-28 20:25:56
         compiled from "/Users/Sumi/Sites/UMBDT/module/Media/view/media/media/photo-gallery.tpl" */ ?>
<?php /*%%SmartyHeaderCode:82286439751746a008d71c4-52006048%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7e6f5899fc351fe967988dd1549f000ff9885be5' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Media/view/media/media/photo-gallery.tpl',
      1 => 1367173128,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '82286439751746a008d71c4-52006048',
  'function' => 
  array (
    'printNestedDirs' => 
    array (
      'parameter' => 
      array (
      ),
      'compiled' => '',
    ),
  ),
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_51746a00b4cc21_87880299',
  'variables' => 
  array (
    'dirs' => 0,
    'gallery' => 0,
    'dirName' => 0,
    'path' => 0,
    'galleries' => 0,
  ),
  'has_nocache_code' => 0,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51746a00b4cc21_87880299')) {function content_51746a00b4cc21_87880299($_smarty_tpl) {?><div id='content'>
	<?php if (!function_exists('smarty_template_function_printNestedDirs')) {
    function smarty_template_function_printNestedDirs($_smarty_tpl,$params) {
    $saved_tpl_vars = $_smarty_tpl->tpl_vars;
    foreach ($_smarty_tpl->smarty->template_functions['printNestedDirs']['parameter'] as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);};
    foreach ($params as $key => $value) {$_smarty_tpl->tpl_vars[$key] = new Smarty_variable($value);}?>
	  <ul>
		  <?php  $_smarty_tpl->tpl_vars['gallery'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['gallery']->_loop = false;
 $_smarty_tpl->tpl_vars['dirName'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['dirs']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['gallery']->key => $_smarty_tpl->tpl_vars['gallery']->value){
$_smarty_tpl->tpl_vars['gallery']->_loop = true;
 $_smarty_tpl->tpl_vars['dirName']->value = $_smarty_tpl->tpl_vars['gallery']->key;
?>
			  <li>
				  <?php if (!empty($_smarty_tpl->tpl_vars['gallery']->value)){?>
					  <a class='collapsibleDir'>
						  <span class='icon icon-arrow-e'></span>
						  <?php echo $_smarty_tpl->tpl_vars['dirName']->value;?>

					  </a>
					  <?php smarty_template_function_printNestedDirs($_smarty_tpl,array('dirs'=>$_smarty_tpl->tpl_vars['gallery']->value,'path'=>((string)$_smarty_tpl->tpl_vars['path']->value).((string)$_smarty_tpl->tpl_vars['dirName']->value)."/"));?>

				  <?php }else{ ?>
					  <a href='/media/media/display-gallery/<?php echo $_smarty_tpl->tpl_vars['path']->value;?>
<?php echo $_smarty_tpl->tpl_vars['dirName']->value;?>
' class='NWLink:ajax' data-nwLink-successCB='onGalleryResponse'><?php echo $_smarty_tpl->tpl_vars['dirName']->value;?>
</a>
				  <?php }?>
			  </li>
		  <?php } ?>
	  </ul>
	<?php $_smarty_tpl->tpl_vars = $saved_tpl_vars;
foreach (Smarty::$global_tpl_vars as $key => $value) if(!isset($_smarty_tpl->tpl_vars[$key])) $_smarty_tpl->tpl_vars[$key] = $value;}}?>


	<div class='photoGalleryNav'>
		Galleries:
		<br />
		<?php smarty_template_function_printNestedDirs($_smarty_tpl,array('dirs'=>$_smarty_tpl->tpl_vars['galleries']->value));?>

	</div>

	<div id='photoGallery'></div>
</div>

<script type='text/javascript'>
	function onGalleryResponse(data) {
		var photoGalleryDiv = $('photoGallery');
		photoGalleryDiv.empty();
		var imageGallery = new Element('div', {html: data});
		imageGallery.inject(photoGalleryDiv);
		$NW.getPlugin('NWPlugins').setupContainer(photoGalleryDiv);
		return true;
	}

	$$('.collapsibleDir').addEvent('click', function(event) {
		var targetElmt = this;
		if (!targetElmt.hasClass('collapsibleDir')) return;
		var childUl = targetElmt.getNext('ul');
		childUl.toggle();
		if (targetElmt.getElement('span').hasClass('icon-arrow-e')) targetElmt.getElement('span').removeClass('icon-arrow-e').addClass('icon-arrow-s');
		else targetElmt.getElement('span').removeClass('icon-arrow-s').addClass('icon-arrow-e');
		event.stopPropagation();
	});
</script>
<?php }} ?>