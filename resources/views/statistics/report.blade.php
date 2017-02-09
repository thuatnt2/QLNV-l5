@extends('layouts.master')
@section('css')
{{-- Select2 --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/select2.min.css') }}">
{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/plugins/daterangepicker.css') }}">
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
<style type="text/css">
  .table-borderless tbody tr td,
  .table-borderless tbody tr th,
  .table-borderless thead tr th,
  .table-borderless thead tr td,
  .table-borderless tfoot tr th,
  .table-borderless tfoot tr td {
      border: none;
  }
</style>
@stop()
@section('content')
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
                <table class="table table-borderless">
                  <tr>
                    <td class="text-center" width="30%"><strong>CÔNG AN TỈNH QUẢNG BÌNH</strong></td>
                    <td width="20%"></td>
                    <td class="text-center" width="50%"><strong>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong></td>
                  </tr>
                  <tr>
                    <td class="text-center" width="20%"><strong>PHÒNG PA71/ĐỘI BP3</strong></td>
                    <td width="20%"></td>
                    <td class="text-center" width="50%"><strong>Độc lập - Tự do - Hạnh phúc</strong></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td class="text-center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>Quảng Bình, Ngày {{date('d')}} tháng {{date('m')}} năm {{date('Y')}}</em></td>
                  </tr>
                </table>
            {{-- </div> --}}
            <div class="col-sm-12">
              <h3 class="box-title text-center" style="margin-bottom: -25px;"><strong>{{$title}}<br><br></strong></h3>
              <p class="text-center" style="font-size: 16px; margin-left: 10px"><em>Từ ngày <strong>{{ trim(array_pop($reportrange)) }}</strong> đến ngày <strong>{{ trim(array_pop($reportrange)) }}</strong></em></p>
            </div>
            <div class="col-md-12">
              <!-- <div class="box"> -->
                  <div class="box-header">
                    
                    <h4 class="box-title"><strong>II. KẾT QUẢ<br><br></strong></h4>
                    <?php
                      $orderPurpose = "";
                      foreach ($result['purposes'] as $key => $purpose) {
                        $orderPurpose .= ", <strong>" .$purpose->purposeOrder . "</strong> yêu cầu " . strtoupper($purpose->symbol); 
                      }
                    ?>
                    <p style="font-size: 16px;">Thực hiện <strong>{{ $result['order'] }}</strong> yêu cầu, trong đó: <strong>{{ $result['orderMonitor']}}</strong> yêu cầu giám sát (<strong>{{$result['orderNew']}}</strong> yêu cầu mới, <strong>{{$result['orderClosed']}}</strong> yêu cầu đã cắt){!! $orderPurpose!!}. Khai thác, xử lý <strong>{{$result['total'][0]->news}}</strong> bản tin, gồm <strong>{{$result['total'][0]->pageNews}}</strong> trang (trong đó có <strong>...</strong> bản tin dịch từ ngoại ngữ, gồm ... trang) <strong>...</strong> MB(hoặc GB) và {!!$result['total'][0]->pageList > 0 ? ", <strong>".$result['total'][0]->pageList."</strong> trang LIST":""!!}{!!$result['total'][0]->pageXmctb > 0 ? ", <strong>".$result['total'][0]->pageXmctb."</strong> chủ thuê bao":""!!}{!!$result['total'][0]->pageImei > 0 ? ", <strong>".$result['total'][0]->pageImei."</strong> trang IMEI":""!!}. </p>
                    <ul style="font-size: 16px;">
                      <li>Báo cáo Ban Giám đốc: <strong>{{$result['shipDirector'][0]->news}}</strong> bản tin, <strong>{{$result['shipDirector'][0]->pageNews}}</strong> trang tin</li>
                      <li>Trao đổi với các đơn vị nghiệp vụ: <strong>{{$result['total'][0]->news - $result['shipDirector'][0]->news}}</strong> bản tin, <strong>{{$result['total'][0]->pageNews - $result['shipDirector'][0]->pageNews}}</strong> trang tin. Cụ thể:</li>
                    </ul>
                    <h4 class="box-title" style="font-size: 14px"><strong>Yêu cầu giám sát</strong></h4>
                  </div><!-- /.box-header -->
                  <div class="box-body">
                    <table class="table table-bordered ">
                      <?php 
                        $categories = $result['categories'];
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
                          foreach($unit->categories as $key => $category) {
                            if ($category > 0 ) {
                              $sumPurposeUnit[$key] += $category;
                              echo '<td class="text-center">'.$category.'</td>';
                            }
                            else {
                              echo "<td></td>";
                            }
                          }
                          $sumNumber += $unit->number;
                          echo  '<td class="text-center">'. $unit->number .'</td>';
                          if (count($unit->news) > 0) {
                            $sumNews += $unit->news[0];
                            $sumPageNews += $unit->news[1];
                            echo '<td class="text-center">'. $unit->news[0] .'</td>' .
                                 '<td class="text-center">'. $unit->news[1]  .'</td>';
                          }
                          else {
                            echo "<td></td><td></td>";
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
                              if ($category > 0 ) {
                                echo '<td class="text-center">' . $category. '</td>';
                              }
                              else {
                                echo '<td></td>';
                              }
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
                            else {
                              echo '<td></td><td></td>';
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
                      @endif
                    </table>
                  </div><!-- /.box-body -->
              <!-- </div>/.box -->
            </div><!-- /.col-md-12 -->
            <div class="col-md-12">
             <div class="box-header">
               <h4 class="box-title" style="font-size: 14px"><strong>Yêu cầu cung cấp dữ liệu</strong></h4>
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
                   $sumXmctb = [0, 0];
                   $sumImei = [0, 0];
                   $sumList = [0, 0];

                   foreach($result['detailOther']['security'] as $index=>$unit) {
                      echo '<tr>' .
                        '<td class="text-center">' . ++$index . '</td>' .
                        '<td class="text-center">' . $unit->unit .'</td>';
                      foreach($unit->categories as $key=>$category) {
                        if ($category > 0) {
                          echo '<td class="text-center">' . $category. '</td>';
                        }
                        else {
                          echo '<td></td>';
                        }
                        $sumPurposeUnit[$key] += $category;
                      }
                      if (count($unit->xmctb) > 0) {
                        $sumXmctb[0] += $unit->xmctb[0];
                        $sumXmctb[1] += $unit->xmctb[1];
                        echo '<td class="text-center">'. $unit->xmctb[0] .'</td>';
                        echo '<td class="text-center">'. $unit->xmctb[1]  .'</td>';
                      }
                      else {
                        echo '<td></td><td></td>';
                      }

                      if (count($unit->imei) > 0) {
                        $sumImei[0] += $unit->imei[0];
                        $sumImei[1] += $unit->imei[1];
                        echo '<td class="text-center">'. $unit->imei[0] .'</td>';
                        echo '<td class="text-center">'. $unit->imei[1]  .'</td>';
                      }
                      else {
                        echo '<td></td><td></td>';
                      }

                      if (count($unit->list) > 0) {
                        $sumList[0] += $unit->list[0];
                        $sumList[1] += $unit->list[1];
                        echo '<td class="text-center">'. $unit->list[0] .'</td>';
                        echo '<td class="text-center">'. $unit->list[1]  .'</td>';
                      }
                      else {
                        echo '<td></td><td></td>';
                      }
                      echo '</tr>';
                   }
                  ?>  
                  <tr>
                    <td></td>
                    <td class="text-center"><strong>Cộng</strong></td>
                    @foreach($sumPurposeUnit as $key=>$value)
                      <td class="text-center">{{$value > 0 ? $value:""}}</td>
                    @endforeach
                    <td class="text-center">{{$sumXmctb[0] > 0 ? $sumXmctb[0]:""}}</td>
                    <td class="text-center">{{$sumXmctb[1] > 0 ? $sumXmctb[1]:""}}</td>
                    <td class="text-center">{{$sumImei[0] > 0 ? $sumImei[0]:""}}</td>
                    <td class="text-center">{{$sumImei[1] > 0 ? $sumImei[1]:""}}</td>
                    <td class="text-center">{{$sumList[0] > 0 ? $sumList[0]:""}}</td>
                    <td class="text-center">{{$sumList[1] > 0 ? $sumList[1]:""}}</td>
                  </tr>
                  <tr>
                    <td></td>
                    <td class="text-center"><strong>Tổng cộng</strong></td>
                    <td class="text-center" colspan="{{$categories->count()}}">{{array_sum($sumPurposeUnit)}}</td>
                    <td class="text-center">{{$sumXmctb[0] > 0 ? $sumXmctb[0]:""}}</td>
                    <td class="text-center">{{$sumXmctb[1] > 0 ? $sumXmctb[1]:""}}</td>
                    <td class="text-center">{{$sumImei[0] > 0 ? $sumImei[0]:""}}</td>
                    <td class="text-center">{{$sumImei[1] > 0 ? $sumImei[1]:""}}</td>
                    <td class="text-center">{{$sumList[0] > 0 ? $sumList[0]:""}}</td>
                    <td class="text-center">{{$sumList[1] > 0 ? $sumList[1]:""}}</td>
                  </tr>
                  {{-- Yêu cầu giám sát của lực lượng cảnh sát --}}
                  @if(isset($result['detailOther']['police']) && !empty($result['detailOther']['police']))
                    <tr class="success">
                      <th rowspan="2"`></th>
                      <th rowspan="2"></th>
                      <th class="text-center" colspan="{{$categories->count()}}">Yêu cầu của lực lượng Cảnh sát</th>
                      @for($i = 0 ; $i < 6 ; $i++)
                        <th rowspan="2"></th>
                      @endfor
                    </tr>
                    <tr class="success">
                      <?php
                        foreach($categories  as $index => $category) {
                          echo '<th class="text-center">' . $category->symbol . '</th>';  
                          $sumPurposeUnit[$category->symbol] = 0;   
                          $sumXmctb = [0, 0];
                          $sumImei = [0, 0];
                          $sumList = [0, 0];
                        }
                      ?>
                    </tr>
                    <?php 
                      foreach($result['detailOther']['police'] as $index=>$unit) {
                        echo '<tr>' .
                          '<td class="text-center">' . ++$index . '</td>' .
                          '<td class="text-center">' . $unit->unit .'</td>';
                        foreach($unit->categories as $key=>$category) {
                          if ($category > 0 ) {
                            echo '<td class="text-center">' . $category. '</td>';
                          }
                          else {
                            echo '<td></td>';
                          }
                          $sumPurposeUnit[$key] += $category;
                        }
                        if (count($unit->xmctb) > 0) {
                          $sumXmctb[0] += $unit->xmctb[0];
                          $sumXmctb[1] += $unit->xmctb[1];
                          echo '<td class="text-center">'. $unit->xmctb[0] .'</td>';
                          echo '<td class="text-center">'. $unit->xmctb[1]  .'</td>';
                        }
                        else {
                          echo '<td></td><td></td>';
                        }

                        if (count($unit->imei) > 0) {
                          $sumImei[0] += $unit->imei[0];
                          $sumImei[1] += $unit->imei[1];
                          echo '<td class="text-center">'. $unit->imei[0] .'</td>';
                          echo '<td class="text-center">'. $unit->imei[1]  .'</td>';
                        }
                        else {
                          echo '<td></td><td></td>';
                        }

                        if (count($unit->list) > 0) {
                          $sumList[0] += $unit->list[0];
                          $sumList[1] += $unit->list[1];
                          echo '<td class="text-center">'. $unit->list[0] .'</td>';
                          echo '<td class="text-center">'. $unit->list[1]  .'</td>';
                        }
                        else {
                          echo '<td></td><td></td>';
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
                      <td class="text-center">{{$sumXmctb[0] > 0 ? $sumXmctb[0]:""}}</td>
                      <td class="text-center">{{$sumXmctb[1] > 0 ? $sumXmctb[1]:""}}</td>
                      <td class="text-center">{{$sumImei[0] > 0 ? $sumImei[0]:""}}</td>
                      <td class="text-center">{{$sumImei[1] > 0 ? $sumImei[1]:""}}</td>
                      <td class="text-center">{{$sumList[0] > 0 ? $sumList[0]:""}}</td>
                      <td class="text-center">{{$sumList[1] > 0 ? $sumList[1]:""}}</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td class="text-center"><strong>Tổng cộng</strong></td>
                      <td class="text-center" colspan="{{$categories->count()}}">{{array_sum($sumPurposeUnit)}}</td>
                      <td class="text-center">{{$sumXmctb[0] > 0 ? $sumXmctb[0]:""}}</td>
                      <td class="text-center">{{$sumXmctb[1] > 0 ? $sumXmctb[1]:""}}</td>
                      <td class="text-center">{{$sumImei[0] > 0 ? $sumImei[0]:""}}</td>
                      <td class="text-center">{{$sumImei[1] > 0 ? $sumImei[1]:""}}</td>
                      <td class="text-center">{{$sumList[0] > 0 ? $sumList[0]:""}}</td>
                      <td class="text-center">{{$sumList[1] > 0 ? $sumList[1]:""}}</td>
                    </tr>
                  @endif
               </table>
             </div><!-- /.box-body -->
            </div><!-- /.col-md-12 -->
            <div class="col-sm-12">
              <div class="box-header">
                <h3 class="box-title"><strong>II. NỘI DUNG ĐÃ CUNG CẤP</strong></h3>
              </div><!-- /.box-header -->
              <div class="box-body">
              <style type="text/css">
                p {
                  margin: 0px;
                }
              </style>
                {!! $content !!}
              </div>
            </div>
          </fieldset>
          </form>
        @else
          <p  style="font-size: 16px; margin-left: 10px">Không tìm thấy kết quả từ {{ trim(array_pop($reportrange)) }} đến ngày {{ trim(array_pop($reportrange)) }}</p>  
        @endif
    </div> <!-- </div>/.box -->
  </div><!-- <div class="row"> -->
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