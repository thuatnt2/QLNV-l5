@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
<div class="row">
	<div class="box">
		 <div class="box-header text-center">
            <h3 class="box-title" style="color: red; font-weight: bold;">PHÂN CÔNG GIÁM SÁT</h3>
        </div>
		<div class="box-body">
			<table id="example1" class="table table-bordered">
				@foreach ($users as $user)
					<th>{{ $user->fullname }}</th>
				@endforeach
			</table>
		</div>
	</div>
</div>
@stop
@section('javascript')
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
