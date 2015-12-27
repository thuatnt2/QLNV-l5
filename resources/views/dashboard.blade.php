@extends('layouts.master')
@section('content')
<form>
	<label>Company Name</label>
	<input type="text" name="name">

	<h3>Employees</h3>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[1][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[1][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<div class="add-employee">
		<label>Employee Name</label>
		<input type="text" name="employee[2][name]">
		<label>Employee Title</label>
		<input type="text" name="employee[2][title]">
	</div>
	<a href="#" class="js-create-new-add-employee-box">Add another employee</a>

	<input type="submit">
</form>
@endsection
