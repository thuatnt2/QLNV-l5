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
    			<td>{{  $order->number_cv . '/' . $order->unit->symbol }}</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Số công văn PA71</th>
    			<td>{{  $order->number_cv_pa71  }}</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Họ tên ĐT</th>
    			<td>
                    @if (isset($order->order_name))
                        {{  $order->order_name  }}
                    @endif
                </td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Số điện thoại yêu cầu</th>
    			<td width="50%">
    				@include('partials.phone_status', ['order' => $order, 'detail' => true])
                    @include('partials.status_modal')
    			</td> 
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Loại đối tượng</th>
    			<td>
                    @if (isset($order->category_id))
                        {{  $order->category->symbol  }}
                    @endif
                </td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Tính chất </th>
    			<td>
                    @if (isset($order->kind_id))
                        {{  $order->kind->symbol  }}
                    @endif
                </td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Mục đích yêu cầu </th>
    			<td>
                    {{ $order->purpose->symbol }}
    			</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Ngày bắt đầu</th>
    			<td>
                    @if (isset($order->date_begin))
                        {{  $order->date_begin->format('d/m/Y')  }}
                    @endif
                </td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Ngày kết thúc</th>
    			<td>
                    @if (isset($order->date_end))
                        {{  $order->date_end->format('d/m/Y')  }}
                    @endif
                </td>
    		</tr>
            @if($order->purpose->group == 'monitor')
                <tr>
                    <th class="text-left" width="30%">Ngày cắt yêu cầu</th>
                    <td>{{isset($order->date_cut)  ? $order->date_cut->format('d/m/Y'):""}}</td>
                </tr>
            @endif
    		<tr>
    			<th class="text-left" width="30%">File đính kèm</th>
    			<td><a href="{{ url('file',['orders', $order->file_name]) }}" target="true">{{  $order->file_name  }}</a></td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Trinh sát yêu cầu</th>
    			<td>{{  $order->customer_name  }}</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Số điện thoại</th>
    			<td>{{  $order->customer_phone }}</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Người nhận yêu cầu</th>
    			<td>{{  $order->user->name }}</td>
    		</tr>

    		<tr>
    			<th class="text-left" width="30%">Ghi chú</th>
    			<td>{{  $order->comment  }}</td>
    		</tr>
            
    		<tr>
    			<th class="text-left" width="30%">Ngày thêm dữ liệu</th>
    			<td>{{  $order->created_at->format('d/m/Y')  }}</td>
    		</tr>
    		<tr>
    			<th class="text-left" width="30%">Ngày cập nhật dữ liệu</th>
    			<td>{{  $order->updated_at->format('d/m/Y')  }}</td>
    		</tr>
    	</table>
    </div><!-- /.box-body -->
</div>
</div>
<div class="col-sm-6">
<div class="box">
	<div class="box-body">
		<div class="box-header">
            <h3 class="box-title">Kết quả thực hiện</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
        	<table id="example2" class="table table-bordered table-striped">
        		@if ($order->purpose->group != "monitor" )
        		@foreach ($order->phones as $phone)
        		<tr>
        			<th colspan="2" bgcolor="#99CCFF">{{ $phone->number }}</th>
        		</tr>
        		@foreach($phone->ships as $index=>$ship)
        		<tr>
        			<th rowspan="6" style="background-color:  white;">Lần : {{ ++$index}}</th`>
        				<td>Ngày giao: {{ $ship->date_submit->format('d/m/Y') }}</td>
        			</tr>
        			<tr>
        				<td>Số công văn PA71: {{ $order->number_cv_pa71 }}</td>
        			</tr>
        			<tr>
                        @if (isset($ship->page_news))
                            <td>Số trang tin: {{ $ship->page_news }}</td>
                        @elseif(isset($ship->page_list))
                            <td>Số trang list: {{ $ship->page_list }}</td>
                        @elseif(isset($ship->page_xmctb))
                            <td>Số trang xmctb: {{ $ship->page_xmctb }}</td>
                        @elseif(isset($ship->page_imei))
                            <td>
                                Số trang imei: {{ $ship->page_imei }}
                                @foreach ($ship->networks as $index=>$network)
                                    <span style="float: right; margin-right: 20px">
                                      {{ $network->name }}
                                    </span>
                                @endforeach
                            </td>
                        @endif
        			</tr>

        			<tr>
        				<td>File đính kèm: <a href="{{ isset($ship->file->name) ? url('file', ['ships', $ship->file->name]):'#' }}" target="true">{{ $ship->file_name }}</a></td>
        			</tr>
        			<tr>
        				<td>Người nhận: {{ $ship->receive_name }}</td>
        			</tr>
        			<tr>
        				<td>Người giao: {{ $ship->user->name }}</td>
        			</tr>
        			@endforeach
        			@endforeach
        			@else
        			    @foreach ($order->phones as $phone)
            			<tr>
            				<th colspan="2" bgcolor="#99CCFF">{{ $phone->number }}</th>
            			</tr>
                			@foreach($phone->ships as $index=>$new)
                    			<tr>
                    				<th rowspan="7">Lần : {{ ++$index}}</th`>
                    					<td>Ngày giao: {{ $new->date_submit->format('d/m/Y') }}</td>
                    				</tr>
                    				<tr>
                    					<td>Số công văn PA71: {{ $new->number_cv_pa71 }}</td>
                    				</tr>
                    				<tr>
                    					<td>Số bản tin: {{ $new->news }}</td>
                    				</tr>
                    				<tr>
                    					<td>Số trang tin: {{ $new->page_news }}</td>
                    				</tr>
                    				<tr>
                    					<td>File đính kèm: <a href="{{ isset($new->file->name) ? url('file', ['news', $new->file->name]):'#'}}" target="true">{{ $new->file_name }}</a></td>
                    				</tr>
                    				<tr>
                    					<td>Người nhận: {{ $new->receive_name }}</td>
                    				</tr>
                    				<tr>
                    					<td>Người giao: {{ $new->user->name }}</td>
                    				</tr>
                				@endforeach
            				
            			@endforeach
        			@endif


        	</table>
        </div>
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
