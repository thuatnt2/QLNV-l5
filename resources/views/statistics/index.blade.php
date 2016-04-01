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
	        {!! Former::horizontal_open(url('statistics'))->id('form-create') !!}
	        <fieldset>
	       		{!! Former::legend('Thống kê') !!}
	       		<div class="col-sm-6 col-sm-offset-2">
	       			{!! Former::text('reportrange', 'Thời gian')
		                ->append('<i class="fa fa-calendar" id="range"></i>')
		                ->addClass('input-sm')
             		!!}
	       		</div>
	       		<button type="submit" class="btn btn-success btn-sm">Đồng ý</button>
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
        <form>
          <fieldset>
            <legend>
              <span>Kết quả thống kê</span>
              <a href="{{ route('excel', 'date='.$output) }} " style="float: right; margin-right: 15px"><img src="{{ asset('icon/excel.png') }}"></a>
            </legend>
          
            @if (isset($result))
              <p style="font-size: 16px; margin-left: 10px">Kết quả thực hiện từ ngày <strong>{{ trim(array_pop($reportrange)) }}</strong> đến ngày <strong>{{ trim(array_pop($reportrange)) }}</strong>  như sau</p>
              <div class="col-md-12">
              <!-- <div class="box"> -->
                  <div class="box-header">
                    <h3 class="box-title label label-info">Kết quả chung</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr class="success">
                        <th class="text-center">Nội dung</th>
                        <td class="text-center">Tổng số yêu cầu</td>
                         @foreach ($result['purposes'] as $element)
                          <td class="text-center"> {{ ucwords($element->symbol) }} </td>
                        @endforeach
                        <td class="text-center">Tổng số bản tin </td>
                        <td class="text-center">Tổng số trang tin </td>
                        <td class="text-center">Tổng số trang list</td>
                        <td class="text-center">Tổng số trang xmctb</td>
                        <td class="text-center">Tổng số trang imei</td>
                      </tr>
                      <tr>
                        <th class="text-center">Kết quả</th>
                        <td class="text-center">{{ $result['order'] }}</td>
                        @foreach ($result['purposes'] as $element)
                          <td class="text-center"> {{ $element->purposeOrder }} </td>
                        @endforeach
                        @foreach ($result['total'] as $total)
                          <td class="text-center"> {{ $total->news }} </td>
                          <td class="text-center"> {{ $total->pageNews }} </td>
                          <td class="text-center"> {{ $total->pageList }} </td>
                          <td class="text-center"> {{ $total->pageXmctb }} </td>
                          <td class="text-center"> {{ $total->pageImei }} </td>
                        @endforeach
                      </tr>
                    </table>
                  </div><!-- /.box-body -->
              <!-- </div>/.box -->
            </div><!-- /.col-md-6 -->
            
            <div class="col-md-12">
                <div class="box-header">
                    <h3 class="box-title label label-info">Khối An ninh: {{ $result['security'] }} yêu cầu</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr class="success">
                          <th class="text-center">STT</th>
                          <th class="text-center">Tính chất</th>
                          <th class="text-center">Tổng số</th>
                          @foreach ($result['ss'] as $index => $ss)
                            @foreach ($ss->symbol as $element)
                                <th class="text-center">{{ $element->symbol }}</th>
                            @endforeach
                            @break;
                          @endforeach
                      </tr>
                      @foreach ($result['ss'] as $index => $ss)
                        <tr>
                          <td class="text-center">{{ ++$index }}</td>
                          <td class="text-center">{{ $ss->description }}</td>
                          <td class="text-center">{{ $ss->total }}</td>
                          @foreach ($ss->symbol as $element)
                                <td class="text-center">{{ $element->total }}</td>
                          @endforeach
                        </tr>
                      @endforeach
                    </table>
                  </div><!-- /.box-body -->
            </div>
            <div class="col-md-12">
                <div class="box-header">
                    <h3 class="box-title label label-info">Khối cảnh sát: {{ $result['police'] }} yêu cầu</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr class="success">
                          <th class="text-center">STT</th>
                          <th class="text-center">Tính chất</th>
                          <th class="text-center">Tổng số</th>
                          @foreach ($result['sp'] as $index => $sp)
                            @foreach ($sp->symbol as $element)
                                <th class="text-center">{{ $element->symbol }}</th>
                            @endforeach
                            @break;
                          @endforeach
                      </tr>
                      @foreach ($result['sp'] as $index => $sp)
                        <tr>
                          <td class="text-center">{{ ++$index }}</td>
                          <td class="text-center">{{ $sp->description }}</td>
                          <td class="text-center">{{ $sp->total }}</td>
                          @foreach ($sp->symbol as $element)
                                <td class="text-center">{{ $element->total }}</td>
                          @endforeach
                        </tr>
                      @endforeach
                    </table>
                  </div><!-- /.box-body -->
            </div>
            <div class="col-md-12">
                <div class="box-header">
                    <h3 class="box-title label label-info">Cụ thể từng đơn vị</h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered">
                      <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên đơn vị</th>
                        <th class="text-center">Số yêu cầu</th>
<!--                         <th class="text-center">Yêu cầu giám sát</th>
                        <th class="text-center">Yêu cầu list</th> -->
                        <th class="text-center">Số bản tin</th>
                        <th class="text-center">Số trang tin</th>
                        <th class="text-center">Số trang list</th>
                        <th class="text-center">Số trang xmctb</th>
                        <th class="text-center">Số trang imei</th>
                      </tr>
                      
                      @foreach ($result['units'] as $index => $unit)
                        <tr>
                          <td class="text-center"> {{ ++$index }} </td>
                          <td class="text-center"> {{ $unit->symbol }} </td>
                          <td class="text-center"> {{ $unit->total }} </td>
                          <td class="text-center"> {{ $unit->numberNews }} </td>
                          <td class="text-center"> {{ $unit->pageNews }} </td>
                          <td class="text-center"> {{ $unit->pageList }} </td>
                          <td class="text-center"> {{ $unit->pageXmctb }} </td>
                          <td class="text-center"> {{ $unit->pageImei }} </td>
                        </tr>
                      @endforeach
                      
                    </table>
                  </div><!-- /.box-body -->
            </div>
            @else
              <p  style="font-size: 16px; margin-left: 10px">Không tìm thấy kết quả từ {{ trim(array_pop($reportrange)) }} đến ngày {{ trim(array_pop($reportrange)) }}</p>  
            @endif
          </fieldset>
          </form>
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