@extends('layouts.master')
@section('css')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2.min.css') }}">
{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop()
@section('content')
	<div class="row">
		<div class="box">
			{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
	        {!! Former::horizontal_open(url('statistics'))->id('form-create') !!}
	        <fieldset>
	       		{!! Former::legend('Form') !!}
	       		<div class="col-sm-6 col-sm-offset-2">
	       			{!! Former::text('time_request', 'Tùy chọn')
		                ->append('<i class="fa fa-calendar" id="range"></i>')
		                ->addClass('input-sm daterange')
             		!!}
	       		</div>
	        </fieldset>
	        {!! Former::close() !!}
		</div>
	</div>
@stop
@section('javascript')
{{-- Daterangepicker for Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/moment.min.js') }}"></script>
{{-- Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/daterangepicker.js') }}"></script>
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop