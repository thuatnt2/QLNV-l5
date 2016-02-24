@extends('layouts.master')

@section('css')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2.min.css') }}">
{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop

@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
<div class="col-sm-6">
<div class="box">
	<div class="box-body">
		<div class="box-header">
            <h3 class="box-title">Thông tin yêu cầu</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                       <tr>
                                  <th class="text-left" width="30%">Ngày đăng ký</th>
                                  <td>{{  $order->date_order->format('d/m/Y')  }}</td>
                       </tr>
                       <tr>
                                  <th class="text-left" width="30%">Số công văn yêu cầu</th>
                                  <td>{{  $order->number_cv . '/ ' . $order->unit->symbol }}</td>
                       </tr>
                       <tr>
                                  <th class="text-left" width="30%">Số công văn PA71</th>
                                  <td>{{  $order->number_cv_pa71  }}</td>
                       </tr>
                       <tr>
                                  <th class="text-left" width="30%">Họ tên ĐT</th>
                                  <td>{{  $order->order_name  }}</td>
                       </tr>
                       <tr>
                                  <th class="text-left" width="30%">Ngày đăng ký:</th>
                                  <td>{{  $order->date_order->format('d/m/Y')  }}</td>
                       </tr>
            </table>
        </div><!-- /.box-body -->
	</div>
</div>
</div>
<div class="col-sm-6">
<div class="box">
	<div class="box-body">
		<div class="box-header">
            <h3 class="box-title">Kết quả thực hiện</h3>
        </div><!-- /.box-header -->
	</div>
</div>
</div>
</div>
@stop

@section('javascript')
{{-- Select2 4.0.1 --}}
<script src="{{ URL::asset('js/plugins/select2.min.js') }}"></script>
{{-- Daterangepicker for Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/moment.min.js') }}"></script>
{{-- Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/daterangepicker.js') }}"></script>
{{-- Inputmask --}}
<script src="{{ URL::asset('js/plugins/jquery.inputmask.bundle.min.js') }}"></script>
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
