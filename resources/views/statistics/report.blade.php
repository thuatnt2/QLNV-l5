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
                      <li>Báo cáo Ban Giám đốc: <strong>{{$result['shipDirector'][0]->news}}</strong> bản tin, <strong>{{$result['shipDirector'][0]->pageNews}}</strong> trang tin</li>
                      <li>Trao đổi với các đơn vị nghiệp vụ: <strong>{{$result['total'][0]->news - $result['shipDirector'][0]->news}}</strong> bản tin, <strong>{{$result['total'][0]->pageNews - $result['shipDirector'][0]->pageNews}}</strong> trang tin. Cụ thể:</li>
                    </ul>
                    <h3 class="box-title"><strong>Yêu cầu giám sát</strong></h3>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered ">
                      <?php 
                        $categories = App\Category::all()->sortBy('symbol');
                        $sumPurposeUnit = [];
                        $sumNumber = 0;
                        $sumNews = 0;
                        $sumPageNews = 0;
                        $sumtotal = 0;

                      ?>
                      <tr class="success" >
                        <th class="text-center" rowspan="2">STT</th>
                        <th class="text-center" rowspan="2">Đơn vị</th>
                        <th class="text-center" colspan="{{$categories->count()}}">Yêu cầu của lực lượng An ninh, Tình báo</th>
                        <th class="text-center" rowspan="2">Thuê bao</th>
                        <th class="text-center" colspan="2">Số bản tin khai thác, xử lý</th>
                        <th class="text-center" rowspan="2">Dung lượng thoại ghi đĩa (MB)</th>
                      </tr>
                      <tr class="success">
                        <?php
                        foreach($categories  as $index => $category) {
                          echo '<th class="text-center">' . $category->symbol . '</th>';  
                          $sumPurposeUnit[$category->symbol] = 0;   
                        }
                        ?>
                        <th class="text-center">Bản tin</th>
                        <th class="text-center">Trang tin</th>
                      </tr>
                      <?php 
                        foreach($result['detailMonitor']['security'] as $index=>$unit) {
                          echo '<tr>' .
                            '<td class="text-center">' . ++$index . '</td>' .
                            '<td class="text-center">' . $unit->unit .'</td>';
                          foreach($unit->categories as $key=>$category) {

                            echo '<td class="text-center">' . $category. '</td>';
                            $sumPurposeUnit[$key] += $category;
                          }
                          $sumNumber += $unit->number;
                          echo  '<td class="text-center">'. $unit->number .'</td>';
                          if (count($unit->news) > 0) {
                            $sumNews += $unit->news[0];
                            $sumPageNews += $unit->news[1];
                            echo '<td class="text-center">'. $unit->news[0] .'</td>' .
                                 '<td class="text-center">'. $unit->news[1]  .'</td>';
                          }
                          echo '<td></td></tr>';
                        }
                      ?>  
                      <tr>
                        <td></td>
                        <td class="text-center"><strong>Cộng</strong></td>
                        @foreach($sumPurposeUnit as $key=>$value)
                          <td class="text-center">{{$value}}</td>
                        @endforeach
                        <td class="text-center">{{$sumNumber}}</td>
                        <td class="text-center">{{$sumNews}}</td>
                        <td class="text-center">{{$sumPageNews}}</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td class="text-center"><strong>Tổng cộng</strong></td>
                        <td class="text-center" colspan="{{$categories->count()}}">{{array_sum($sumPurposeUnit)}}</td>
                        <td class="text-center">{{$sumNumber}}</td>
                        <td class="text-center">{{$sumNews}}</td>
                        <td class="text-center">{{$sumPageNews}}</td>
                        <td></td>
                      </tr>
                      {{-- Yêu cầu giám sát của lực lượng cảnh sát --}}
                      @if(isset($result['detailMonitor']['police']) && !empty($result['detailMonitor']['police']))
                        <tr class="success">
                          <th rowspan="2"`></th>
                          <th rowspan="2"></th>
                          <th class="text-center" colspan="{{$categories->count()}}">Yêu cầu của lực lượng Cảnh sát</th>
                          <th rowspan="2"></th>
                          <th rowspan="2"></th>
                          <th rowspan="2"></th>
                          <td rowspan="2"></td>
                        </tr>
                        <tr class="success">
                          <?php
                            foreach($categories  as $index => $category) {
                              echo '<th class="text-center">' . $category->symbol . '</th>';  
                              $sumPurposeUnit[$category->symbol] = 0;   
                              $sumNumber = 0;
                              $sumNews = 0;
                              $sumPageNews = 0;
                              $sumtotal = 0;
                            }
                          ?>
                        </tr>
                        <?php 
                          foreach($result['detailMonitor']['police'] as $index=>$unit) {
                            echo '<tr>' .
                              '<td class="text-center">' . ++$index . '</td>' .
                              '<td class="text-center">' . $unit->unit .'</td>';
                            foreach($unit->categories as $key=>$category) {

                              echo '<td class="text-center">' . $category. '</td>';
                              $sumPurposeUnit[$key] += $category;
                            }
                            $sumNumber += $unit->number;
                            echo  '<td class="text-center">'. $unit->number .'</td>';
                            if (count($unit->news) > 0) {
                              $sumNews += $unit->news[0];
                              $sumPageNews += $unit->news[1];
                              echo '<td class="text-center">'. $unit->news[0] .'</td>' .
                                   '<td class="text-center">'. $unit->news[1]  .'</td>';
                            }
                            echo ' </tr>';
                          }
                        ?>  
                        <tr>
                          <td></td>
                          <td class="text-center"><strong>Cộng</strong></td>
                          @foreach($sumPurposeUnit as $key=>$value)
                            <td class="text-center">{{$value}}</td>
                          @endforeach
                          <td class="text-center">{{$sumNumber}}</td>
                          <td class="text-center">{{$sumNews}}</td>
                          <td class="text-center">{{$sumPageNews}}</td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td class="text-center"><strong>Tổng cộng</strong></td>
                          <td class="text-center" colspan="{{$categories->count()}}">{{array_sum($sumPurposeUnit)}}</td>
                          <td class="text-center">{{$sumNumber}}</td>
                          <td class="text-center">{{$sumNews}}</td>
                          <td class="text-center">{{$sumPageNews}}</td>
                          <td></td>
                        </tr>
                      @endif
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
               <th class="text-center" colspan="{{$categories->count()}}">Yêu cầu của lực lượng An ninh, Tình báo</th>
               <th class="text-center" colspan="2">XMCTB</th>
               <th class="text-center" colspan="2">IMEI</th>
               <th class="text-center" colspan="2">Lấy list</th>
               {{-- <th class="text-center" rowspan="2">Số trang list</th> --}}
             </tr>
             <tr class="success">
               <?php
                 foreach($categories  as $index => $category) {
                   echo '<th class="text-center">' . $category->symbol . '</th>';  
                   $sumPurposeUnit[$category->symbol] = 0;   
                 }
               ?>
               <th class="text-center">Thuê bao</th>
               <th class="text-center">Kết quả</th>
               <th class="text-center">Thuê bao</th>
               <th class="text-center">Kết quả</th>
               <th class="text-center">Thuê bao</th>
               <th class="text-center">Trang list</th>
             </tr>
             <?php 
               $sumPurposeUnit[$category->symbol] = 0;   
               $sumNumber = 0;
               $sumNews = 0;
               $sumPageNews = 0;
               $sumtotal = 0;

               foreach($result['detailOther']['security'] as $index=>$unit) {
                  echo '<tr>' .
                    '<td class="text-center">' . ++$index . '</td>' .
                    '<td class="text-center">' . $unit->unit .'</td>';
                  foreach($unit->categories as $key=>$category) {
                    echo '<td class="text-center">' . $category. '</td>';
                    $sumPurposeUnit[$key] += $category;
                  }
                  if (count($unit->xmctb) > 0) {
                    $sumNews += $unit->xmctb[0];
                    $sumPageNews += $unit->xmctb[1];
                    echo '<td class="text-center">'. $unit->xmctb[0] .'</td>';
                    echo '<td class="text-center">'. $unit->xmctb[1]  .'</td>';
                  }
                  else {
                    echo '<td></td><td></td>';
                  }

                  if (count($unit->imei) > 0) {
                    $sumNews += $unit->imei[0];
                    $sumPageNews += $unit->imei[1];
                    echo '<td class="text-center">'. $unit->imei[0] .'</td>';
                    echo '<td class="text-center">'. $unit->imei[1]  .'</td>';
                  }
                  else {
                    echo '<td></td><td></td>';
                  }

                  if (count($unit->list) > 0) {
                    $sumNews += $unit->list[0];
                    $sumPageNews += $unit->list[1];
                    echo '<td class="text-center">'. $unit->list[0] .'</td>';
                    echo '<td class="text-center">'. $unit->list[1]  .'</td>';
                  }
                  else {
                    echo '<td></td><td></td>';
                  }
                  
                  
                  echo '</tr>';
               }
             ?>  
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