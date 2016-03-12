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
        {!! Former::open_for_files(url('orders'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Thêm yêu cầu List-XMCTB') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
                
             !!}
            {!! Former::text('number_cv', 'Số công văn yêu cầu')->required()->addClass('input-sm'); !!}
            {!! Former::select('unit')->label('Đơn vị yêu cầu')->options($units)->addClass('input-sm') !!}
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')->required()->addClass('input-sm'); !!}
            {!! Former::text('order_name', 'Tên đối tượng')->required()->addClass('input-sm'); !!}
          
        </div> 
        <div class="col-sm-4">
            {!! Former::text('order_phone[]', 'Số điện thoại ĐT')
                ->append('<i class="fa fa-plus add_phone"></i>')
                ->required()
                ->addClass('input-sm phone')
                ->addGroupClass('phone_order')
             !!}
            {!! Former::select('category')->label('Loại đối tượng')->options($categories)->addClass('input-sm') !!}
            {!! Former::select('kind')->label('Tính chất')->options($kinds)->addClass('input-sm') !!}
            {!! Former::checkboxes('purpose[]','Mục đích yêu cầu')
                ->checkboxes($purposes)
                ->inline()
            !!}
            {!! Former::text('date_request', 'Thời gian yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
             !!}
            {!! Former::file('file','File đính kèm')->accept('doc', 'docx', 'xls', 'xlsx', 'pdf') !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('customer_name', 'Tên trinh sát')->addClass('input-sm'); !!}
            {!! Former::text('customer_phone', 'Số điện thoại TS')
                ->append('<i class="fa fa-phone"></i>')
                ->addClass('input-sm phone'); 
            !!}
           
           {!! Former::select('user')->label('Người nhận yêu cầu')->options($users)->addClass('input-sm') !!}
           {!! Former::textarea('comment')->label('Ghi chú') !!}
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
                        <label class="control-label col-lg-6 col-sm-6">DS yêu cầu LIST</label>
                        <div class="col-lg-4 col-sm-4">
                            <select class="form-control input-sm">
                                <option value="10"{{ $orders->perPage()==10 ? "selected":"" }}>10</option>
                                <option value="25" {{ $orders->perPage()==25 ? "selected":"" }}>25</option>
                                <option value="50" {{ $orders->perPage()==50 ? "selected":"" }}>50</option>
                                <option value="100" {{ $orders->perPage()==100 ? "selected":"" }}>100</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
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
                        <th class="text-center"width="4%">Tình trạng</th>
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
                        <td class="text-center"><a href="{{ action('OrderController@show', $order->id) }}">{{ $order->order_name }}</a></td>
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
                        <td class="text-center">
                            @foreach($order->phones as $index=> $phone)
                            <span class="btn btn-{{ $phone->status }} btn-xs" data-toggle="modal" data-target="#statusModal" data-url="{{ action('OrderController@updateStatus', $phone->id) }}" data-status="{{ $phone->status }}" data-number="{{ $phone->number }}" >
                                @if ($phone->status == 'success')
                                    <i class="fa fa-check" title="Đã giao"></i>
                                @elseif($phone->status == 'warning')
                                    <i class="fa fa-hourglass-half" title="Chờ xử lý"></i>
                                @else
                                    <i class="fa fa-times" title="Không có dữ liệu" ></i>
                                @endif
                            </span>
                            <br>
                            @endforeach
                            @include('partials.status_list_modal')
                        </td>
                        <td>{{ $order->comment }}</td>
                        <td class="text-center">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('OrderController@editList', $order->id) }}" type="button" title="Sửa"></button>
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
