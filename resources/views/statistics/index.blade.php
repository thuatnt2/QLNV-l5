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
  <div class="row">
    <div class="box">
      {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::horizontal_open(url('statistics'))->id('form-create') !!}
          <fieldset>
            <legend>
              <span>Kết quả thống kê</span>
              <a href="#" style="float: right; margin-right: 15px"><img src="{{ asset('icon/pdf.png') }}"></a>
              <a href="{{ route('excel') }} " style="float: right; margin-right: 15px"><img src="{{ asset('icon/excel.png') }}"></a>
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
                        <td class="text-center">Tổng số yêu cầu thực hiện</td>
                        <td class="text-center">Tổng số bản tin đã giao</td>
                        <td class="text-center">Tổng số trang tin đã giao</td>
                        <td class="text-center">Tổng số trang tin list</td>
                      </tr>
                      <tr>
                        <th class="text-center">Kết quả</th>
                        <td class="text-center">{{ $result['order'] }}</td>
                        <td class="text-center">{{ $result['number_news'] }}</td>
                        <td class="text-center">{{ $result['page_number'] }}</td>
                        <td class="text-center">{{ $result['list'] }}</td>
                      </tr>
                    </table>
                  </div><!-- /.box-body -->
              <!-- </div>/.box -->
            </div><!-- /.col-md-6 -->
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
                        <th class="text-center">Số bản tin</th>
                        <th class="text-center">Số trang tin</th>
                        <th class="text-center">Số trang list</th>
                        <th class="text-center">Số trang xmctb</th>
                        <th class="text-center">Số trang imeil</th>
                        <th class="text-center">Số trang email</th>
                      </tr>
                      @foreach ($result['units'] as $index => $unit)
                        <tr>
                          <td class="text-center">{{ ++$index }}</td>
                          <td>{{ $unit->symbol }}</td>
                          <td class="text-center">
                            {{ $unit->total }}
                          </td>
                          <td class="text-center">
                            {{ $unit->totalNews }}
                          </td>
                          <td class="text-center">
                            {{ $unit->totalPage }}
                          </td>
                        </tr>
                      @endforeach
                      
                    </table>
                  </div><!-- /.box-body -->
            </div>
            @else
              <p  style="font-size: 16px; margin-left: 10px">Không tìm thấy kết quả từ {{ trim(array_pop($reportrange)) }} đến ngày {{ trim(array_pop($reportrange)) }}</p>  
            @endif
          </fieldset>
        {!! Former::close() !!}
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