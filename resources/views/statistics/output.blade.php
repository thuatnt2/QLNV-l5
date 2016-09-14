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
    Kết quả thực hiện từ ngày {{ $result['startDate'] }} đến ngày {{ $result['endDate'] }}
    </td>  
  </tr>
  <tr></tr>
  <tr></tr>
  @if (isset($result))
    <tr>
        <td colspan="8" style="text-align: left;">Kết quả chung</td> 
    </tr>
    <table><!-- Table 1 -->
        <tr>
          <td  style="width: 10">Nội dung</td>
          <td  style="width: 11">Tổng số y/c</td>
          @foreach ($result['purposes'] as $element)
            <td> {{ ucwords($element->symbol) }} </td>
          @endforeach
        </tr>
        <tr>
          <td>Kết quả</td>
          <td>{{ $result['order'] }}</td>
          @foreach ($result['purposes'] as $element)
            <td> {{ $element->purposeOrder }} </td>
          @endforeach
        </tr>
    </table> <!-- End Table1 -->
    @foreach ($result['blocks'] as $block)
      @if ($block['total'] > 0)
        <tr>
          <td colspan="2" style="text-align: left;">{{ $block['nameBlock'] . ': '. $block['total'] }} yêu cầu</td>    
        </tr>
        <table>
          <tr>
              <th>STT</th>
              <th>Tính chất</th>
              <th>Tổng số</th>
              @foreach ($block['detail'] as $index => $ss)
                @foreach ($ss->symbol as $element)
                    <th class="text-center">{{ $element->symbol }}</th>
                @endforeach
                @break;
              @endforeach
          </tr>
          @foreach ($block['detail'] as $index => $ss)
            @if ($ss->total > 0)
              <tr>
                <td class="text-center">{{ ++$index }}</td>
                <td class="text-center">{{ $ss->description }}</td>
                <td class="text-center">{{ $ss->total }}</td>
                @foreach ($ss->symbol as $element)
                      <td class="text-center">{{ $element->total }}</td>
                @endforeach
              </tr>
            @endif
          @endforeach
        </table>{{-- end block  --}}
      @endif
    @endforeach
    <tr>
      <td colspan="2" style="text-align: left;">Cụ thể từng đơn vị</td>    
    </tr>
    <table>  <!-- Table 2 -->
        <tr>
          <th>STT</th>
          <th>Tên đơn vị</th>
          <th>Tổng số y/c</th>
          <th>Số bản tin</th>
          <th>Số trang tin</th>
          <th style="width: 10">Số trang list</th>
          <th style="width: 11">Số trang xmctb</th>
          <th style="width: 11">Số trang imei</th>
        </tr>
      @foreach ($result['units'] as $index => $unit)
        <tr>
          <td> {{ ++$index }} </td>
          <td> {{ $unit->symbol }} </td>
          <td> {{ $unit->total }} </td>
          <td> {{ isset($unit->numberNews) && $unit->numberNews > 0 ? $unit->numberNews:"" }} </td>
          <td> {{ isset($unit->pageNews) && $unit->pageNews > 0 ?  $unit->pageNews:""}} </td>
          <td> {{ isset($unit->pageList) && $unit->pageList > 0 ? $unit->pageList:"" }} </td>
          <td> {{ isset($unit->pageXmctb) && $unit->pageXmctb > 0 ? $unit->pageXmctb:"" }} </td>
          <td> {{ isset($unit->pageImei) && $unit->pageImei > 0 ? $unit->pageImei:"" }} </td>
        </tr>
      @endforeach
    </table> <!-- End Table2 -->
  @endif
<!--   </table> -->
</body>  
</html>
