@extends('layouts.master')

@section('css')

{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop

@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
    <div class="box row-form">
        <div class="row">
            <div class="col-sm-11">
                <span style="padding-left: 8px;font-size: 18px;" id="title-form">Form Đăng ký</span>
           </div>
            <div class="col-sm-1">
                <form class="import-file" method="post" enctype="multipart/form-data" action="{{ action('OrderController@importExcel') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="file" id="import-order" name="file"  style="width: 0;height: 0;display: none;">
                    <button class="btn btn-info btn-xs" type="button">Nhập từ excel</button>
                </form>
           </div>
        </div>
        <hr>
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('orders'))->id('form-create') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
                
            !!}
            {!! Former::text('number_cv', 'Số công văn yêu cầu')->required()->addClass('input-sm'); !!}
            <div class="form-group">
                <label for="unit" class="control-label col-lg-4 col-sm-4">Đơn vị yêu cầu</label>
                <div class="col-lg-8 col-sm-8">
                    <select class="form-control input-sm select2" id="unit" name="unit">
                        <optgroup label="Khối An ninh">
                            @foreach ($unitSecurites as $index=>$unit)
                                <option value="{{ $unit->id }}" >{{ ucwords($unit->symbol) }}</option>
                            @endforeach
                        </optgroup>
                        <optgroup label="Khối Cảnh sát">
                            @foreach ($unitPolices as $index=>$unit)
                                <option value="{{ $unit->id }}" >{{ ucwords($unit->symbol) }}</option>
                            @endforeach
                        </optgroup>
                    </select>
                </div>
            </div>
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')->required()->addClass('input-sm'); !!}
            {!! Former::text('order_name', 'Tên đối tượng')->addClass('input-sm'); !!}
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
            {!! Former::text('date_request', 'Thời gian yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
            !!}
            {!! Former::select('purpose')->label('Mục đích yêu cầu')->options($purposes)->addClass('input-sm') !!}
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
        {!! Former::close() !!}
    </div>
</div>

<div class="row">
    <div class="box">
        <div class="box-header">
            <!-- <h3 class="box-title">DS Yêu cầu giám sát</h3> -->
            <!-- <div class="box-tools"> -->
            <div class="col-sm-3" >
                <form class="form-horizontal" id="perPage">
                    <div class="form-group">
                        <label class="control-label col-lg-6 col-sm-6">Số bản ghi</label>
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
            <div class="col-sm-4">
                <form class="form-horizontal" id="condition">
                    <div class="form-group">
                        <label class="control-label col-lg-6 col-sm-6">Hiển thị</label>
                        <div class="col-lg-4 col-sm-4">
                            <select class="form-control input-sm">
                                <option value="">Tất cả</option>
                                @foreach ($purposes as $index=>$purpose)
                                    <option value="{{ $index }}" {{ $condition == $index ? "selected":""}}>{{ ucwords($purpose) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-5">
                @include('pagination.limit_link', ['paginator' => $orders])          
            </div>    
            <!-- </div> -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped tablesorter">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv đến</th>
                        <th class="text-center">Số Cv đi</th>
                        <th class="text-center" width="10%">Tên đối tượng</th>
                        <th class="text-center" width="10%">Số điện thoại/IMEI</th>
                        <th class="text-center">Loại ĐT</th>
                        <th class="text-center">Tính chất</th>
                        <th class="text-center" width="13%">Thời gian yêu cầu</th>
                        <th class="text-center">Mục đích y/c</th>
                        <th class="text-center" width="8%">TS y/c (Số ĐT)</th>
                        <th class="text-center" width="4%">Tình trạng</th>
                        <th class="text-center" width="8%">Ghi chú</th>
                        <th class="text-center" width="6%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $stt = $orders->perPage()*$orders->currentPage() - $orders->perPage();?>
                    @foreach ($orders as $index => $order)
                    <tr>
                        <td class="text-center">{{ ++$stt }}</td>
                        <td class="text-center">{{ $order->date_order->format('d/m/Y') }}</td>
                        <td class="text-center"><a href="{{ action('OrderController@show', $order->id) }}">{{ $order->number_cv . '/' . $order->unit->symbol }}</a></td>
                        <td class="text-center">{{ $order->number_cv_pa71 }}</td>
                        <td class="text-center">{{ $order->order_name }}</td>
                        <td class="text-center">
                            @foreach($order->phones as $index => $phone)
                                {{ $phone->number }} <br>    
                            @endforeach
                            
                        </td>
                        <td class="text-center">
                        @if (isset($order->category_id))
                            {{ $order->category->symbol }}
                        @endif
                        
                        </td>
                        <td class="text-center">
                        @if (isset($order->kind_id))
                            {{ $order->kind->symbol }}
                        @endif
                        
                        </td>
                        <td class="text-center">
                        @if (isset($order->date_begin) && isset($order->date_end))
                            {{ $order->date_begin->format('d/m/Y') . ' &rarr; ' . $order->date_end->format('d/m/Y')  }}
                        @endif
                        
                        </td>
                        <td class="text-center">
                            {{ $order->purpose->symbol }}                        
                        </td>
                        <td class="text-center">{{ $order->customer_name }} <br> {{ $order->customer_phone }}</td>
                        <td class="text-center">
                        @if ($order->purpose->group == 'monitor')
                            @foreach($order->phones as $index=> $phone)
                            <span class="btn btn-{{ $phone->status }} btn-xs" data-toggle="modal" data-target="#statusModal" data-url="{{ action('OrderController@updateStatus', $phone->id) }}" data-status="{{ $phone->status }}" data-number="{{ $phone->number }}" >
                                @if ($phone->status == 'success')
                                    <i class="fa fa-link " title="Kết nối"></i>
                                @elseif($phone->status == 'warning')
                                    <i class="fa fa-hourglass-half" title="Đang chờ"></i>
                                @else
                                    <i class="fa fa-times" title="Đóng hoặc không kết nôi" ></i>
                                @endif
                            </span>
                            <br>
                            @endforeach
                        @else 
                            @foreach($order->phones as $index=> $phone)
                            <span class="btn btn-{{ $phone->status }} btn-xs" data-toggle="modal" data-target="#statusModal" data-url="{{ action('OrderController@updateStatus', $phone->id) }}" data-status="{{ $phone->status }}" data-number="{{ $phone->number }}" >
                                @if ($phone->status == 'success')
                                    <i class="fa fa-check " title="Đã giao"></i>
                                @elseif($phone->status == 'warning')
                                    <i class="fa fa-hourglass-half" title="Đang chờ"></i>
                                @else
                                    <i class="fa fa-times" title="Đóng hoặc không kết nôi" ></i>
                                @endif
                            </span>
                            <br>
                            @endforeach
                        @endif
                            
                            @include('partials.status_modal')
                        </td>
                        <td class="text-center">{{ $order->comment }}</td>
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
{{-- Daterangepicker for Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/moment.min.js') }}"></script>
{{-- Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/daterangepicker.js') }}"></script>
{{-- Inputmask --}}
<script src="{{ URL::asset('js/plugins/jquery.inputmask.bundle.min.js') }}"></script>
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
