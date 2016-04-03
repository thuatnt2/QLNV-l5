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
        {!! Former::open_for_files(url('ship/xmctb'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Giao List-XMCTB') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày giao')
                ->required()
                ->addClass('input-sm daterange')
            !!}
            <div class="form-group <?php if($errors->has('phone')) echo 'has-error'?>">
                <label for="phone" class="control-label col-lg-4 col-sm-4">Số Cv - Thuê bao<sup>*</sup></label>
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
                    <span class="help-block">
                        <?php echo $errors->first('phone') ?>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            {!! Former::text('page_xmctb', 'Số trang XMCTB')->required()->addClass('input-sm'); !!}
            <div class="form-group required <?php if($errors->has('file')) echo 'has-error'?>">
                <label for="file" class="control-label col-lg-4 col-sm-4">File đính kèm<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8" id="uploadFile">
                    <input type="text" class="form-control input-sm" name="file_name">
                    <input accept="application/msword|application/vnd.openxmlformats-officedocument.wordprocessingml.document|application/vnd.ms-excel|application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/pdf" id="file" type="file" name="file" style="width: 0px; height: 0px; display: none;">
                    <span class="help-block">
                        <?php echo $errors->first('file') ?>
                    </span>
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
            <div class="col-sm-3" >
                <form class="form-horizontal" id="perPage">
                    <div class="form-group">
                        <label class="control-label col-lg-6 col-sm-6">DS List-XMCTB đã giao</label>
                        <div class="col-lg-4 col-sm-4">
                            <select class="form-control input-sm">
                                <option value="10"{{ $ships->perPage()==10 ? "selected":"" }}>10</option>
                                <option value="25" {{ $ships->perPage()==25 ? "selected":"" }}>25</option>
                                <option value="50" {{ $ships->perPage()==50 ? "selected":"" }}>50</option>
                                <option value="100" {{ $ships->perPage()==100 ? "selected":"" }}>100</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
                @include('pagination.limit_link', ['paginator' => $ships])          
            </div>    
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv/Đơn vị</th> 
                        <th class="text-center">Số Cv/PA71</th>
                        <th class="text-center" width="10%">Số điện thoại</th>
                        <th class="text-center">Mục đích y/c</th>
                        <th class="text-center">Số trang xmctb</th>
                        <th class="text-center" width="8%">Ghi chú</th>
                        <th class="text-center" width="6%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php $stt = $orders->perPage()*$orders->currentPage() - $orders->perPage();?>
                    @foreach ($ships as $index => $ship)
                    <tr>
                        <td class="text-center">{{ ++$stt }}</td>
                        <td class="text-center">{{ $ship->date_submit->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $ship->phone->order->number_cv . '/' . $ship->phone->order->unit->symbol }}</td>
                        <td class="text-center">{{ $ship->phone->order->number_cv_pa71 }}</td>
                        <td class="text-center">{{ $ship->phone->number }}</td>
                        <td>
                            {{ $ship->phone->order->purpose->symbol }}
                        </td>
                        <td class="text-center">{{ $ship->page_xmctb}}</td>
                        <td class="text-center">{{ $ship->phone->order->comment}}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('XMCTBController@edit', $ship->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('XMCTBController@destroy', $ship->id) }}" title="Xóa"></button>
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