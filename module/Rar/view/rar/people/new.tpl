<fieldset>
	<legend>New Person</legend>
	<form action='/rar/people/new' method='post'>
		<div>
			<label>Name</label>
			<input type='text' name='newPersonForm[name]' />
		</div>
		<div>
			<label>E-mail</label>
			<input type='email' name='newPersonForm[email]' />
		</div>
		<div>
			<label>Phone Number</label>
			<input type='text' name='newPersonForm[phone]' />
		</div>
		<div>
			<label>When can you leave?</label>
			<input type='text' name='newPersonForm[departureTime]' />
		</div>
		<div>
			<label class='checkbox'>
				<input type='checkbox' name='newPersonForm[driver]' />
				I have a car I can drive
			</label>
		</div>
		<div>
			<label>How many people (including yourself) can you fit in your car?</label>
			<input type='text' name='newPersonForm[capacity]' />
		</div>
		<div>
			<label>Preference 1</label>
			<input type='text' name='newPersonForm[preference1]' />
		</div>
		<div>
			<label>Preference 2</label>
			<input type='text' name='newPersonForm[preference2]' />
		</div>
		<div>
			<label>Antipreference 1</label>
			<input type='text' name='newPersonForm[antipreference1]' />
		</div>
		<div>
			<label>Antipreference 2</label>
			<input type='text' name='newPersonForm[antipreference2]' />
		</div>
		<div>
			<button type='submit'>Submit</button>
		</div>
	</form>
</fieldset>