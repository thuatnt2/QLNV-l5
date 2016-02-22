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
	<div class="box row-form">
		{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('ships'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Giao List-XMCTB') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày giao')
                ->required()
                ->addClass('input-sm daterange')
            !!}
            <div class="form-group">
                <label for="phone" class="control-label col-lg-4 col-sm-4">Số Cv - Thuê bao</label>
                <div class="col-lg-8 col-sm-8">
                    <select class="form-control input-sm" id="phone" name="phone" placeholder="Chọn thuê bao đã đăng ký">
                        @foreach($orders as $order)
                        <optgroup label="{{$order->number_cv . '/' . $order->unit->symbol}}">
                            @foreach ($order->phones as $index => $phone)
                                    <option value="{{$phone->id}}">
                                        {{ $phone->number }}
                                    </option>
                            @endforeach
                        </optgroup>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            {!! Former::text('page_number', 'Số trang tin')->required()->addClass('input-sm'); !!}
            <div class="form-group required">
                <label for="file" class="control-label col-lg-4 col-sm-4">File đính kèm<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8">
                    <input type="text" class="form-control input-sm">
                    <input accept="application/msword|application/vnd.openxmlformats-officedocument.wordprocessingml.document|application/vnd.ms-excel|application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/pdf" id="file" type="file" name="file" style="width: 0px; height: 0px">
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            {!! Former::text('receive_name', 'Người nhận')->addClass('input-sm'); !!}
            {!! Former::select('user_name')->label('Người giao')->options($users)->addClass('input-sm') !!}
        </div>
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
               <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus">&nbsp</i>Thêm</button>
               <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
            </div>
        </div>     
        </fieldset>
        {!! Former::close() !!}
	</div>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
            <h3 class="box-title">DS List-XMCTB đã giao</h3>
            <div class="box-tools">
                @include('pagination.limit_link', ['paginator' => $ships])            
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">So cv Don vi</th>
                        <th class="text-center">So cv PA71</th>
                        <th class="text-center" width="15%">Tên đối tượng</th>
                        <th clsas="text-center" width="10%">Số điện thoại</th>
                        <th clsas="text-center">Loại ĐT</th>
                        <th clsas="text-center">Tính chất</th>
                        <th clsas="text-center" width="13%">Thời gian yêu cầu</th>
                        <th clsas="text-center">Số trang tin</th>
                        <th width="8%">Ghi chú</th>
                        <th class="text-center" width="6%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ships as $index => $ship)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $ship->date_submit->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $ship->phone->order->number_cv . '/' . $ship->phone->order->unit->symbol }}</td>
                        <td class="text-center">{{ $ship->phone->order->number_cv_pa71 }}</td>
                        <td class="text-center">{{ $ship->phone->order->order_name }}</td>
                        <td class="text-center">{{ $ship->phone->number }}</td>
                        <td class="text-center">{{ $ship->phone->order->category->symbol }}</td>
                        <td class="text-center">{{ $ship->phone->order->kind->symbol }}</td>
                        <td class="text-center">{{ $ship->phone->order->date_begin->format('d/m/Y') . ' &rarr; ' . $ship->phone->order->date_end->format('d/m/Y')  }}</td>
                        <td class="text-center">{{ $ship->page_number}}</td>
                        <td class="text-center">{{ $ship->phone->order->comment}}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('ShipController@edit', $ship->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('ShipController@destroy', $ship->id) }}" title="Xóa"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
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