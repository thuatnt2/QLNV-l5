@extends('layouts.master')

@section('css')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2.min.css') }}">
{{-- Datepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/datepicker3.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/plugins/daterangepicker-bs3.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop

@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
    <div class="box row-form">
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::horizontal_open(url('orders'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Thêm yêu cầu giám sát') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày yêu cầu')->required()->addClass('input-sm datepicker'); !!}
            {!! Former::text('number_cv', 'Số công văn yêu cầu')->required()->addClass('input-sm'); !!}
            {!! Former::select('unit')->label('Đơn vị yêu cầu')->options($units)->addClass('input-sm') !!}
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')->required()->addClass('input-sm'); !!}
          
        </div> 
        <div class="col-sm-4">
            {!! Former::text('customer_name', 'Tên đối tượng')->required()->addClass('input-sm'); !!}
            {!! Former::select('category')->label('Loại đối tượng')->options($categories)->addClass('input-sm') !!}
            {!! Former::select('kind')->label('Tính chất')->options($kinds)->addClass('input-sm') !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('description', 'Thời gian yêu cầu')->required()->addClass('input-sm daterangepicker'); !!}
            {!! Former::text('description', 'Tên đơn vị')->required()->addClass('input-sm'); !!}
            {!! Former::checkboxes('Mục đích yêu cầu')->checkboxes($purposes)->inline() !!}
        </div>
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
               <button type="submit" class="btn btn-success btn-small"><i class="fa fa-plus">&nbsp</i>Thêm</button>
               <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
           </div>
            </div>
        </fieldset>
        {!! Former::close() !!}
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách đơn vị yêu cầu</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên đơn vị</th>
                        <th class="text-center">Kí hiệu</th>
                        <th class="text-center">Khối</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $order->description }}</td>
                        <td class="text-center">{{ $order->symbol }}</td>
                        <td class="text-center">{{ $order->block }}</td>
                        <td class="text-center">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $order->updated_at->format('d/m/Y') }}</td>
                        <td class="text-center"width="6%">
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
{{-- datepicker --}}
<script src="{{ URL::asset('js/plugins/bootstrap-datepicker.js') }}"></script>
{{-- Daterangepicker for Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/moment.min.js') }}"></script>
{{-- Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/daterangepicker.js') }}"></script>
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
