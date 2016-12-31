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
	        {!! Former::horizontal_open(url('statistics-report'))->id('form-create') !!}
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
        @if (isset($result) && $result['order'] > 0)
          <form>
          <fieldset>
            <legend>
              <span>Kết quả thống kê</span>
              <a href="{{ route('excel', 'date='.$output) }} " style="float: right; margin-right: 15px"><img src="{{ asset('icon/excel.png') }}"></a>
            </legend>
              <p style="font-size: 16px; margin-left: 10px">Kết quả thực hiện từ ngày <strong>{{ trim(array_pop($reportrange)) }}</strong> đến ngày <strong>{{ trim(array_pop($reportrange)) }}</strong>  như sau:</p>

              <div class="col-md-12">
              <!-- <div class="box"> -->
                  <div class="box-header">
                    <p style="font-size: 16px;">Thực hiện <strong>{{ $result['order'] }}</strong> yêu cầu, trong đó: <strong>{{ $result['orderMonitor']}}</strong> yêu cầu giám sát (<strong>{{$result['orderNew']}}</strong> yêu cầu mới, <strong>{{$result['orderClosed']}}</strong> yêu cầu đã cắt) và <strong>{{ $result['orderOther']}}</strong> yêu cầu cung cấp dữ liệu viễn thông. Khai thác, xử lý <strong>{{$result['total'][0]->news}}</strong> bản tin, gồm <strong>{{$result['total'][0]->pageNews}}</strong> trang (trong đó có <strong>...</strong> bản tin dịch từ ngoại ngữ, gồm ... trang) <strong>...</strong> MB(hoặc GB) và <strong>{{$result['total'][0]->pageList + $result['total'][0]->pageXmctb + $result['total'][0]->pageImei}}</strong> trang tài liệu BP3. </p>
                    <ul style="font-size: 16px;">
                      <li>Báo cáo Ban Giám đốc: <strong>...</strong> bản tin, <strong>...</strong> trang tin</li>
                      <li>Trao đổi với các đơn vị nghiệp vụ: <strong>...</strong> bản tin, <strong>...</strong> trang tin. Cụ thể:</li>
                    </ul>
                    <h3 class="box-title"><strong>Yêu cầu giám sát</strong></h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered ">
                      <tr class="success" >
                        <th class="text-center" rowspan="2">STT</th>
                        <th class="text-center" rowspan="2">Đơn vị</th>
                        <th class="text-center" colspan="4">Yêu cầu của lực lượng An ninh, Tình báo</th>
                        <th class="text-center" rowspan="2">Thuê bao</th>
                        <th class="text-center" colspan="2">Số bản tin khai thác, xử lý</th>
                        <th class="text-center" rowspan="2">Dung lượng thoại ghi đĩa (MB)</th>
                      </tr>
                      <tr class="success">
                        <th class="text-center">CA</th>
                        <th class="text-center">LQANQG</th>
                        <th class="text-center">QLNV</th>
                        <th class="text-center">KTNV</th>
                        <th class="text-center">Bản tin</th>
                        <th class="text-center">Trang tin</th>
                      </tr>
                    </table>
                  </div><!-- /.box-body -->
              <!-- </div>/.box -->
            </div><!-- /.col-md-6 -->
            <div class="col-md-12">
              <!-- <div class="box"> -->
                  <div class="box-header">
                    <h3 class="box-title"><strong>Yêu cầu cung cấp dữ liệu</strong></h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered ">
                      <tr class="success" >
                        <th class="text-center" rowspan="2">STT</th>
                        <th class="text-center" rowspan="2">Đơn vị</th>
                        <th class="text-center" colspan="4">Yêu cầu của lực lượng An ninh, Tình báo</th>
                        <th class="text-center" rowspan="2">Thuê bao</th>
                        <th class="text-center" colspan="2">Số bản tin khai thác, xử lý</th>
                        <th class="text-center" rowspan="2">Dung lượng thoại ghi đĩa (MB)</th>
                      </tr>
                      <tr class="success">
                        <th class="text-center">CA</th>
                        <th class="text-center">LQANQG</th>
                        <th class="text-center">QLNV</th>
                        <th class="text-center">KTNV</th>
                        <th class="text-center">Bản tin</th>
                        <th class="text-center">Trang tin</th>
                      </tr>
                    </table>
                  </div><!-- /.box-body -->
              <!-- </div>/.box -->
            </div><!-- /.col-md-6 -->
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