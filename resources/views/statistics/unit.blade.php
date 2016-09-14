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
			{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
	        {!! Former::horizontal_open(url('statistics-unit'))->id('form-create') !!}
	        <fieldset>
	       		{!! Former::legend('Thống kê theo đơn vị') !!}
	       		<div class="col-sm-4 col-sm-offset-3">
              {!! Former::select('unit')->label('Đơn vị yêu cầu')->options($units)->addClass('input-sm') !!}
	       			{!! Former::text('reportrange', 'Thời gian')
		                ->append('<i class="fa fa-calendar" id="range"></i>')
		                ->addClass('input-sm')
             		!!}

	       		</div>
            <div class="col-sm-12 col-sm-offset-5">
              <button type="submit" class="btn btn-success btn-sm">Đồng ý</button>
            </div>
	       		
	        </fieldset>
	   {!! Former::close() !!}
		</div>
	</div>
@if (isset($reportrange))
  <?php 
    $output = preg_replace( '/[^0-9]/', '', $reportrange );
    $output = implode(array_reverse($output));
  ?>
  <div class="row">
    <div class="box">
         @if (isset($result) && !$result->isEmpty())
          <form>
          <fieldset>
              <legend>
              <span>Kết quả thống kê</span>
              <a href="{{ route('excel', 'date='.$output) }} " style="float: right; margin-right: 15px"><img src="{{ asset('icon/excel.png') }}"></a>
            </legend>
              <p style="font-size: 16px; margin-left: 10px">Kết quả thực hiện từ ngày <strong>{{ trim(array_pop($reportrange)) }}</strong> đến ngày <strong>{{ trim(array_pop($reportrange)) }}</strong>  như sau</p>
              @foreach ($result as $key=> $orders)
                <div class="col-md-12">
              <!-- <div class="box"> -->
                  <div class="box-header">
                    <h3 class="box-title label label-info">{{ $key }}</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                    <thead>
                      <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Ngày tháng</th>
                        <th class="text-center">Số Cv đến</th>
                        <th class="text-center">Số Cv đi</th>
                        <th class="text-center" width="17%">Tên đối tượng</th>
                        <th class="text-center" width="17%">Số điện thoại/IMEI</th>
                        <th class="text-center" width="17%">Thời gian yêu cầu</th>
                        @if ($key == "giám sát")
                          <th class="text-center">Số bản</th>
                        @endif
                        <th class="text-center">Số trang</th>
                        <th class="text-center">Ghi chú</th>
                      </tr>
                     </thead>
                     @foreach ($orders as $index=>$order)
                      <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $order->date_order->format('d/m/Y') }}</td>
                        <td class="text-center"><a href="{{ action('OrderController@show', $order->id)  }}">{{ $order->number_cv . '/' . $order->unit->symbol}}</a></td>
                        <td class="text-center">{{ $order->number_cv_pa71 }}</td>
                        <td>{{ $order->order_name }}</td>
                        <td class="text-center">
                          <?php
                            $numberOfCopies = 0;
                            $numberOfPage = 0;
                            foreach ($order->phones as $k => $phone) {
                              echo $phone->number . '<br>';
                              $numberOfCopies += $phone->ships->sum('news');
                              $numberOfPage += $phone->ships->sum('page_news') + $phone->ships->sum('page_list') + $phone->ships->sum('page_xmctb') + $phone->ships->sum('page_imei');
                            }
                          ?>
                        </td>
                        <td>
                          @if (isset($order->date_begin) && isset($order->date_end))
                            {{ $order->date_begin->format('d/m/Y') . ' &rarr; ' . $order->date_end->format('d/m/Y') }}
                          @endif
                        </td>
                        @if ($key == "giám sát")
                          <td class="text-center">
                            {{  $numberOfCopies }}
                          </td>
                        @endif
                        <td class="text-center">{{ $numberOfPage }}</td>
                        <td>{{ $order->comment }}</td>
                      </tr>
                     @endforeach
                     <tbody>
                     </tbody>
                    </table>
                  </div><!-- /.box-body -->
                  <!-- </div>/.box -->
                </div><!-- /.col-md-6 -->
              @endforeach
              </fieldset>
            </form>
          @else
            <p  style="font-size: 16px; margin-left: 10px">Không tìm thấy kết quả từ {{ trim(array_pop($reportrange)) }} đến ngày {{ trim(array_pop($reportrange)) }}</p>  
          @endif
    </div>
  </div>
@endif

@stop
@section('javascript')
{{-- Daterangepicker for Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/moment.min.js') }}"></script>
{{-- Daterangepicker --}}
<script src="{{ URL::asset('js/plugins/daterangepicker.js') }}"></script>
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
<script type="text/javascript">
$(function() {

    function cb(start, end) {
        $('#reportrange').html(start.format('dd/mm/YY') + ' - ' + end.format('dd/mm/YY'));
    }
    cb(moment().subtract(29, 'days'), moment());
    $('#reportrange').daterangepicker({
    	locale: {"format": "DD/MM/YYYY"},
    	"autoApply": true,
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

});
</script>
@stop