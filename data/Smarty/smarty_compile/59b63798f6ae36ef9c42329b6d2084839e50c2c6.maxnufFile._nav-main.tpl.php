<?php /* Smarty version Smarty-3.1-DEV, created on 2013-04-22 01:07:47
         compiled from "/Users/Sumi/Sites/UMBDT/module/Application/view/layout/partials/_nav-main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53745824751747143bf00e0-95473543%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '59b63798f6ae36ef9c42329b6d2084839e50c2c6' => 
    array (
      0 => '/Users/Sumi/Sites/UMBDT/module/Application/view/layout/partials/_nav-main.tpl',
      1 => 1352684708,
      2 => 'maxnufFile',
    ),
  ),
  'nocache_hash' => '53745824751747143bf00e0-95473543',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'siteRoot' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1-DEV',
  'unifunc' => 'content_51747143cac6c4_39866458',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_51747143cac6c4_39866458')) {function content_51747143cac6c4_39866458($_smarty_tpl) {?><nav class='nav-main'>
	<ul>
		<li>
			<a href="#">M</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/m/home'>Home</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/m/calendar'>Calendar</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/m/dues-payment'>Dues Payment</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Join</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/join/about-the-team'>About the Team</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/join/about-ballroom-dance'>About Ballroom Dance</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/join/new-member-faq'>New Member FAQ</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/join/new-member-registration'>New Member Registration</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Media</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/media/photo-gallery'>Photo Gallery</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/media/video-gallery'>Video Gallery</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Competitions</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/competitions/mich-comp'>Mich Comp</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/competitions/away-competitions'>Away Competitions</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/competitions/results'>Results</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/competitions/competition-faq'>Competition FAQ</a></li>
			</ul>
		</li>
		<li>
			<a href="#">About</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/about/about-us'>About Us</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/about/board-members'>Board Members</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/about/constitution'>Constitution</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/about/affiliates'>Affiliates</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Contact</a>
			<ul>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/contact/contact-us'>Contact Us</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/contact/hire-us'>Hire Us</a></li>
				<li><a href='<?php echo $_smarty_tpl->tpl_vars['siteRoot']->value;?>
/contact/donate'>Donate</a></li>
			</ul>
		</li>


	</ul>
</nav><?php }} ?>