<ul id='cars'>
	{foreach from=$driversArray item='driver'}
		<li>{$driver.name} - {$driver.departureTime|rarFormatDate} ( {$driver.capacity} ) <ul class='seats'> </ul> </li>
	{/foreach}
</ul>

<ul id='riders'>
	{foreach from=$ridersArray item='rider'}
		<li>{$rider.name} - {$rider.departureTime|rarFormatDate}</li>
	{/foreach}
</ul>

{literal}
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
{/literal}