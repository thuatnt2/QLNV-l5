<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <style type="text/css">
    tr, td {
      text-align: center;
    }
    table {
      border-collapse: collapse;
    }
    table > tr:first-child {
      background-color: #dff0d8;
    }
    table > tr > td,th {
      border: 1px solid #000000;
    }
  </style>
</head>
<body>
  <tr>
    <td colspan="3" style="font-weight: bold;">
     CÔNG AN TỈNH QUẢNG BÌNH
    </td>
    <td></td>
    <td style="width: 9"></td>
    <td style="width: 9"></td>
    <td colspan="4" style="font-weight: bold;">
      CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM
    </td>
  </tr>
  <tr>
    <td colspan="3">
      PHÒNG KTNV II - ĐỘI BP3
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4">Độc lập - Tự do - Hạnh phúc</td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="4" style="font-style: italic;">
      Quảng Bình, ngày <?php echo date('d') ?> tháng <?php echo date('m') ?> năm <?php echo date('Y') ?>
    </td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td colspan="8" style="text-align: left;">
    Kết quả thực hiện từ ngày  đến ngày 
    </td>  
  </tr>
  <tr></tr>
  <tr></tr>
  @if (isset($result))
    @foreach ($result as $key=> $orders)
    <h3 >{{ ucwords($key) }}</h3>
      <table><!-- Table 1 -->
        <tr>
          <th >STT</th>
          <th >Ngày tháng</th>
          <th >Số Cv đến</th>
          <th >Số Cv đi</th>
          <th>Tên đối tượng</th>
          <th>Số điện thoại/IMEI</th>
          <th >Thời gian yêu cầu</th>
          @if ($key == "giám sát")
            <th>Số bản</th>
          @endif
          <th>Số trang</th>
          <th>Ghi chú</th>
        </tr>
         @foreach ($orders as $index=>$order)
            <tr>
              <td>{{ ++$index }}</td>
              <td>{{ $order->date_order->format('d/m/Y') }}</td>
              <td>{{ $order->number_cv . '/' . $order->unit->symbol}}</td>
              <td>{{ $order->number_cv_pa71 }}</td>
              <td>{{ $order->order_name }}</td>
              <td>
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
                <td>
                  {{  $numberOfCopies }}
                </td>
              @endif
              <td>{{ $numberOfPage }}</td>
              <td>{{ $order->comment }}</td>
            </tr>
          @endforeach
      </table> <!-- End Table1 -->
      @endforeach
  @endif
<!--   </table> -->
</body>  
</html>
