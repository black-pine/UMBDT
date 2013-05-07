<ul id='cars'>
	{foreach from=$driversArray item='driver' key='keyNumber'}
		<li data-driverId='{$driver.id}'>{$driver.name} - {$driver.departureTime|rarFormatDate} ( {$driver.capacity} )
			<ul class='seats'>
				{foreach from=$ridersWithDriverArray[$keyNumber] item='rider'}
					<li data-riderId='{$rider.id}'>{$rider.name} - {$rider.departureTime|rarFormatDate}</li>
				{/foreach}
			</ul>
		</li>
	{/foreach}
</ul>

<ul id='riders'>
	{foreach from=$ridersArray item='rider'}
		<li data-riderId='{$rider.id}'>{$rider.name} - {$rider.departureTime|rarFormatDate}</li>
	{/foreach}
</ul>

<button onclick='createCarsArray()'>Save</button>

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
			vertical-align: top;
		}
	</style>

	<script type='text/javascript'>
		new Sortables([$$('.seats'), $('riders')]);

		function createCarsArray() {
			var drivers = [];
			$('cars').getChildren('li').each(function(car) {
				var ridersIds = [];
				car.getElements('li').each(function(rider) {
					ridersIds.push(rider.get('data-riderId'));
				});
				drivers[car.get('data-driverId')] = ridersIds;
			});
			var ridersNotSeated = [];
			$('riders').getElements('li').each(function(unseatedRider) {
				ridersNotSeated.push(unseatedRider.get('data-riderId'));
			})
			var o = {
				url : '/rar/rides/save',
				data : {
					drivers : drivers,
					ridersNotSeated : ridersNotSeated
				},
				method : 'post'
			};
			$NW.getPlugin('NWAjax').jsonRequest(o);
		}
	</script>
{/literal}