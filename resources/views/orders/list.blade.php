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
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Yêu cầu List - XMCTB</h3>
            <div class="box-tools">
				<!-- Large modal -->
				<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg" style="margin-right: 5px;"><i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
				<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
				<div class="modal-dialog modal-lg">
				    <div class="modal-content">
				      ...
				    </div>
				  </div>
				</div>
                @include('pagination.limit_link', ['paginator' => $orders])            
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv đơn vị</th>
                        <th class="text-center">Số Cv PA71</th>
                        <th class="text-center" width="15%">Tên đối tượng</th>
                        <th clsas="text-center" width="10%">Số điện thoại</th>
                        <th clsas="text-center">Loại ĐT</th>
                        <th clsas="text-center">Tính chất</th>
                        <th clsas="text-center" width="13%">Thời gian yêu cầu</th>
                        <th clsas="text-center">Mục đích y/c</th>
                        <th width="12%">TS y/c (Số ĐT)</th>
                        <th width="4%">Tình trạng</th>
                        <th width="8%">Ghi chú</th>
                        <th class="text-center" width="6%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $order->date_order->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $order->number_cv . '/' . $order->unit->symbol }}</td>
                        <td class="text-center">{{ $order->number_cv_pa71 }}</td>
                        <td class="text-center">{{ $order->order_name }}</td>
                        <td class="text-left">
                            @foreach($order->phones as $index => $phone)
                                {{ $phone->number }} <br>    
                            @endforeach
                            
                        </td>
                        <td class="text-center">{{ $order->category->symbol }}</td>
                        <td class="text-center">{{ $order->kind->symbol }}</td>
                        <td class="text-center">{{ $order->date_begin->format('d/m/Y') . ' &rarr; ' . $order->date_end->format('d/m/Y')  }}</td>
                        <td>
                            @foreach($order->purposes as $index=>$purpose)
                                {{ $purpose->symbol }}
                            @endforeach
                        
                        </td>
                        <td>{{ $order->customer_name }} <br> {{ $order->customer_phone }}</td>
                        <td>
                            @foreach($order->phones as $index=> $phone)
                            <span class="label label-success">{{ $phone->status }}</span><br>
                            @endforeach
                        </td>
                        <td>{{ $order->comment }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('OrderController@edit', $order->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('OrderController@destroy', $order->id) }}" title="Xóa"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
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
