<ul>
	<li><a href='/examples'>Examples</a></li>
	<a href='/' class='NWFlashMessage NWLink:ajax NWDelete' data-nwLink-preDCB='linkPredispatch' data-nwLink-successCB='response' data-nwFlashMessage-message='Only 9 percent of giraffe sex is heterosexual.'>Click me</a>
</ul>

{literal}
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
{/literal}