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
        <div class="row">
            <div class="col-sm-11">
                <span style="padding-left: 8px;font-size: 18px;">Giao tin</span>
           </div>
            <div class="col-sm-1">
                <form class="import-file" method="post" enctype="multipart/form-data" action="{{ action('NewsController@importExcel') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="file" id="import-order" name="file"  style="width: 0;height: 0;display: none;">
                    <button class="btn btn-info btn-xs" type="button">Nhập từ excel</button>
                </form>
           </div>
        </div>
        <hr>
		{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('ship/news'))->id('form-create') !!}
        <fieldset>
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày giao')
                ->required()
                ->addClass('input-sm daterange')
            !!}
            <div class="form-group <?php if($errors->has('phone')) echo 'has-error'?>">
                <label for="phone" class="control-label col-lg-4 col-sm-4">Số Cv - Thuê bao<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8">
                    <select class="form-control input-sm select2" id="phone" name="phone" placeholder="Chọn thuê bao đã đăng ký">
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
                        <?php echo $errors->first('phone'); ?>
                    </span>
                </div>
            </div>
            
        </div>
        <div class="col-sm-4">
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')->required()->addClass('input-sm'); !!}
            {!! Former::text('page_news', 'Số trang tin')->required()->addClass('input-sm'); !!}
            <div class="form-group required <?php if($errors->has('file')) echo 'has-error'?>">
                <label for="file" class="control-label col-lg-4 col-sm-4">File đính kèm<sup>*</sup></label>
                <div class="col-lg-8 col-sm-8" id="uploadFile">
                    <input type="text" class="form-control input-sm" name="file_name">
                    <input accept="application/msword|application/vnd.openxmlformats-officedocument.wordprocessingml.document|application/vnd.ms-excel|application/vnd.openxmlformats-officedocument.spreadsheetml.sheet|application/pdf" id="file" type="file" name="file" style="width: 0px; height: 0px; display: none;">
                     <span class="help-block">
                        <?php echo $errors->first('file'); ?>
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
        {!! Former::close() !!}
	</div>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
            <div class="col-sm-3" >
                <form class="form-horizontal" id="perPage">
                    <div class="form-group">
                        <label class="control-label col-lg-6 col-sm-6">DS giao tin</label>
                        <div class="col-lg-4 col-sm-4">
                            <select class="form-control input-sm">
                                <option value="10"{{ $news->perPage()==10 ? "selected":"" }}>10</option>
                                <option value="25" {{ $news->perPage()==25 ? "selected":"" }}>25</option>
                                <option value="50" {{ $news->perPage()==50 ? "selected":"" }}>50</option>
                                <option value="100" {{ $news->perPage()==100 ? "selected":"" }}>100</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-sm-9">
                @include('pagination.limit_link', ['paginator' => $news])          
            </div>
        </div>
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv/Đơn vị</th>
                        <th class="text-center">Số Cv/PA71</th>
                        <th class="text-center" width="15%">Tên đối tượng</th>
                        <th class="text-center" width="10%">Số điện thoại</th>
                        <th class="text-center">Loại ĐT</th>
                        <th class="text-center">Tính chất</th>
                        <th class="text-center" width="13%">Thời gian yêu cầu</th>
                        <th class="text-center">Số bản tin</th>
                        <th class="text-center">Số trang tin</th>
                        <th class="text-center" width="8%">Người nhận</th>
                        <th class="text-center" width="8%">Ghi chú</th>
                        <th class="text-center" width="6%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                <?php $stt = $news->perPage()*$news->currentPage() - $news->perPage();?>
                    @foreach ($news as $index => $new)
                    <tr>
                        <td class="text-center">{{ ++$stt }}</td>
                        <td class="text-center">{{ $new->date_submit->format('d/m/Y') }}</td>
                        <td class="text-center"><a href="{{ action('OrderController@show', $new->phone->order->id) }}">{{ $new->phone->order->number_cv . '/' . $new->phone->order->unit->symbol }}</a></td>
                        <td class="text-center">{{ $new->number_cv_pa71 }}</td>
                        <td class="text-center">{{ $new->phone->order->order_name }}</td>
                        <td class="text-center">{{ $new->phone->number }}</td>
                        <td class="text-center">{{ $new->phone->order->category->symbol }}</td>
                        <td class="text-center">{{ $new->phone->order->kind->symbol }}</td>
                        <td class="text-center">{{ $new->phone->order->date_begin->format('d/m/Y') . ' &rarr; ' . $new->phone->order->date_end->format('d/m/Y')  }}</td>
                        <td class="text-center">
                            {{ $new->news }}
                        </td>
                        <td class="text-center">
                            {{ $new->page_news }}
                        </td>
                        <td class="text-center">{{ $new->receive_name }}</td>
                        <td class="text-center">{!! $new->phone->order->comment !!}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('NewsController@edit', $new->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('NewsController@destroy', $new->id) }}" title="Xóa"></button>
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