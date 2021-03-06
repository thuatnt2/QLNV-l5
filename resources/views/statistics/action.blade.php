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
        <div class="box-header">
            <!-- <h3 class="box-title">DS Yêu cầu giám sát</h3> -->
            <!-- <div class="box-tools"> -->    
            <!-- </div> -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv đến</th>
                        <th class="text-center">Số Cv đi</th>
                        <th class="text-center" width="17%">Tên đối tượng</th>
                        <th class="text-center" width="17%">Số điện thoại/IMEI</th>
                        <th class="text-center" width="17%">Thời gian yêu cầu</th>
                        <th class="text-center" data-toggle="tooltip" data-placement="auto" title="hello fwerwrewrtnt">Số bản tin</th>
                        <th class="text-center">Số trang tin</th>
                        <th class="text-center" width="12%">TS y/c (Số ĐT)</th>
                        <th class="text-center" width="8%">Ghi chú</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($result as $index=>$item)
                    	<tr>
                    		<td class="text-center">{{ ++$index }}</td>
                    		<td class="text-center">{{ $item->order->date_order->format('d/m/Y') }}</td>
                    		<td class="text-center">{{ $item->order->number_cv . '/'.$item->order->unit->symbol }}</td>
                    		<td class="text-center">{{ $item->order->number_cv_pa71 }}</td>
                    		<td class="text-center"><a href="{{ action('OrderController@show', $item->order->id)  }}">{{ $item->order->order_name }}</a></td>
                    		<td class="text-center">{{ $item->number }}</td>
                    		<td class="text-center">
	                    		@if (isset($item->order->date_begin) && isset($item->order->date_end))
	                 		   		{{ $item->order->date_begin->format('d/m/Y') . ' &rarr; ' . $item->order->date_end->format('d/m/Y') }}
	                    		@endif
                    		</td>
                            <td class="text-center">{{ $item->ships->sum('news') }}</td>    
                            <td class="text-center">{{ $item->ships->sum('page_news') }}</td>    
                    		<td>{{ $item->order->customer_name . '/' . $item->order->customer_phone }}</td>
                    		<td>{{ $item->order->comment }}</td>
                    	</tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
@stop
@section('javascript')
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
</script>
@stop