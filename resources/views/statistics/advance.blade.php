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
                {!! Former::legend('Thống kê nâng cao') !!}
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
              <p style="font-size: 16px; margin-left: 10px">Kết quả thực hiện từ ngày <strong>{{ trim(array_pop($reportrange)) }}</strong> đến ngày <strong>{{ trim(array_pop($reportrange)) }}</strong>  như sau</p>
              
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