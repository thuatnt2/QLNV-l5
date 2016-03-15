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
    table > tr > td {
      border: 1px solid #000000;
    }
  </style>
</head>
<body>
  <tr>
    <td colspan="2" style="font-weight: bold;">
     CÔNG AN TỈNH QUẢNG BÌNH
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3" style="font-weight: bold;">
      CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM
    </td>
  </tr>
  <tr>
    <td colspan="2">
      PHÒNG KTNV II - ĐỘI BP3
    </td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3">Độc lập - Tự do - Hạnh phúc</td>
  </tr>
  <tr></tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td colspan="3" style="font-style: italic;">
      Quảng Bình, ngày <?php echo date('d') ?> tháng <?php echo date('m') ?> năm <?php echo date('Y') ?>
    </td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td colspan="8" style="text-align: left;">
    Kết quả thực hiện từ ngày {{ $result['startDate'] }} đến ngày {{ $result['endDate'] }}
    </td>  
  </tr>
  <tr></tr>
  
  @if (isset($result))
    <tr>
        <td colspan="8" style="text-align: left;">Kết quả chung</td> 
    </tr>
    <tr></tr>
    <table><!-- Table 1 -->
        <tr>
          <td >Nội dung</td>
          <td>Tổng số yêu cầu</td>
          <td>Yêu cầu giám sát</td>
          <td>Yêu cầu list</td>
          <td>Tổng số bản tin </td>
          <td>Tổng số trang tin </td>
          <td>Tổng số trang list</td>
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
          @endforeach
        </tr>
    </table> <!-- End Table1 -->
   
    <tr></tr>
    <tr>
      <td colspan="2" style="text-align: left;">Cụ thể từng đơn vị</td>    
    </tr>
    <tr></tr>
    <table>  <!-- Table 2 -->
        <tr>
          <td>STT</td>
          <td>Tên đơn vị</td>
          <td>Tổng số yêu cầu</td>
          <td>Giám sát</td>
          <td>List </td>
          <td>Số bản tin</td>
          <td>Số trang tin</td>
          <td>Số trang list</td>
        </tr>
      @foreach ($result['units'] as $index => $unit)
        <tr>
          <td> {{ ++$index }} </td>
          <td> {{ $unit->symbol }} </td>
          <td> {{ $unit->total }} </td>
          <td> {{ $unit->numberNews }} </td>
          <td> {{ $unit->pageNews }} </td>
          <td> {{ $unit->pageList }} </td>
        </tr>
      @endforeach
    </table> <!-- End Table2 -->
  @endif
  </table>
</body>  
</html>
