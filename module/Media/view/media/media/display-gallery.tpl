{if $galleryName}
	Images in {$galleryName}:
	<br />
	<div class='NWGallery'>
		<ul class='nwGallery-thumbsList'>
		{foreach from=$images item='image'}
			<li><img src='{$dirImages}/galleries/{$galleryName}/{$image}' /></li>
		{/foreach}
		</ul>
	</div>
{/if}

{literal}<style>
	li ul {
		margin-left: 20px;
	}
</style>{/literal}