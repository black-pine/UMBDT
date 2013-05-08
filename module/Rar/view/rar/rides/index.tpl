<ul id='cars'>
	{foreach from=$driversArray item='driver' key='keyNumber'}
		<li data-driverId='{$driver.id}' data-driverCapacity='{$driver.capacity}'>{$driver.name} - {$driver.departureTime|rarFormatDate} &emsp;&emsp;&emsp; Seats Remaining: <span>{$driver.capacity - $ridersWithDriverArray[$keyNumber]|@count - 1}</span>
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
			font-weight: bold;
		}

		#riders, .seats {
			font-weight: normal;
		}

		#cars, #riders {
			margin: 5px;
			width: 450px;
			display: inline-block;
			vertical-align: top;
		}
	</style>

	<script type='text/javascript'>
		new Sortables([$$('.seats'), $('riders')], {
			onStart : function(elmt) {
				if (elmt.getParent('li')) {
					var remainingSeats = elmt.getParent('li').get('data-driverCapacity') - elmt.getSiblings('li').length;
					console.log(remainingSeats);
					elmt.getParent('li').getChildren('span')[0].innerHTML=remainingSeats;
					if (remainingSeats > 0) {
						elmt.getParent('li').getChildren('span')[0].setStyles({
							color : '#000000'
						});
						elmt.getParent('li').setStyles({
							border : '2px solid #000000'
						});
					}
				}

			},
			onComplete : function(elmt) {
				if (elmt.getParent('li')) {
					var remainingSeats = elmt.getParent('li').get('data-driverCapacity') - 2 - elmt.getSiblings('li').length;
					elmt.getParent('li').getChildren('span')[0].innerHTML=remainingSeats;
					if (remainingSeats <= 0) {
						elmt.getParent('li').getChildren('span')[0].setStyles({
							color : '#FF0000'
						});
						elmt.getParent('li').setStyles({
							border : '2px solid #FF0000'
						});
					}
				}
			}
		});

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