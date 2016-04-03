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
          <td style="width: 10">Số bản tin </td>
          <td style="width: 10">Số trang tin </td>
          <td style="width: 10">Số trang list</td>
          <td  style="width: 13">Số trang xmctb</td>
          <td  style="width: 11">Số trang imei</td>
        </tr>
        <tr>
          <td>Kết quả</td>
          <td>{{ $result['order'] }}</td>
          @foreach ($result['purposes'] as $element)
            <td> {{ $element->purposeOrder }} </td>
          @endforeach
          @foreach ($result['total'] as $total)
            <td> {{ $total->news }} </td>
            <td> {{ $total->pageNews }} </td>
            <td> {{ $total->pageList }} </td>
            <td> {{ $total->pageXmctb }} </td>
            <td> {{ $total->pageImei }} </td>
          @endforeach
        </tr>
    </table> <!-- End Table1 -->
    <tr>
      <td colspan="2" style="text-align: left;">Khối An ninh: {{ $result['security'] }} yêu cầu</td>    
    </tr>
    <table>
      <tr>
          <th>STT</th>
          <th>Tính chất</th>
          <th>Tổng số</th>
          @foreach ($result['ss'] as $index => $ss)
            @foreach ($ss->symbol as $element)
                <th>{{ $element->symbol }}</th>
            @endforeach
            @break;
          @endforeach
      </tr>
      @foreach ($result['ss'] as $index => $ss)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $ss->description }}</td>
          <td>{{ $ss->total }}</td>
          @foreach ($ss->symbol as $element)
                <td>{{ $element->total }}</td>
          @endforeach
        </tr>
      @endforeach
    </table>{{-- end block AN --}}
    <tr>
      <td colspan="2" style="text-align: left;">Khối Cảnh sát: {{ $result['police'] }} yêu cầu</td>    
    </tr>
    <table>
      <tr>
          <th>STT</th>
          <th>Tính chất</th>
          <th>Tổng số</th>
          @foreach ($result['sp'] as $index => $sp)
            @foreach ($sp->symbol as $element)
                <th>{{ $element->symbol }}</th>
            @endforeach
            @break;
          @endforeach
      </tr>
      @foreach ($result['sp'] as $index => $sp)
        <tr>
          <td>{{ ++$index }}</td>
          <td>{{ $sp->description }}</td>
          <td>{{ $sp->total }}</td>
          @foreach ($sp->symbol as $element)
                <td>{{ $element->total }}</td>
          @endforeach
        </tr>
      @endforeach
    </table>{{-- end block CS --}}
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
          <td> {{ $unit->numberNews }} </td>
          <td> {{ $unit->pageNews }} </td>
          <td> {{ $unit->pageList }} </td>
          <td> {{ $unit->pageXmctb }} </td>
          <td> {{ $unit->pageImei }} </td>
        </tr>
      @endforeach
    </table> <!-- End Table2 -->
  @endif
<!--   </table> -->
</body>  
</html>
