<!DOCTYPE html>
<html lang='en'>

	{include file='layout/partials/_head.tpl'}

	<body onUnload=''>

		<div id='wrapper'>

			{include file='layout/partials/_header.tpl'}
			<div id='content-wrapper'> <!-- CONTENT TOP -->

				{$this->nwFlashMessenger()}<!-- PHP FLASH MESSENGER -->
				{$this->content}<!-- PAGE CONTENT -->

			</div> <!-- CONTENT BOTTOM -->
			{include file='layout/partials/_footer.tpl'}

		</div> <!-- WRAPPER -->

	</body>
</html>
