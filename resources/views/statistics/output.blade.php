<html>
<head>
  <meta charset="utf-8">
  <style type="text/css">
    tr, td {
      text-align: center;
    }
/*    table {
      border-collapse: collapse;
    }
    table, td, th {
      border: 1px solid black;
    }*/
  </style>
</head>
<body>
  <tr>
    <td colspan="2">
      <strong style="font-size: 14px">CÔNG AN TỈNH QUẢNG BÌNH</strong>PHÒNG KTNV II - ĐỘI BP3
    </td>
    <td></td>
    <td></td>
    <td colspan="4">
      <strong style="font-size: 14px">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</strong>
      Độc lập - Tự do - Hạnh phúc
    </td>
  </tr>
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td>
      <i>Quảng Bình, ngày <?php echo date('d') ?> tháng <?php echo date('m') ?> năm <?php echo date('Y') ?></i>
    </td>
  </tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr></tr>
  <tr>
    <td>Kết quả thực hiện từ ngày</td>  
  </tr>
  <table>
  @if (isset($result))
    <tr>
        <td>Kết quả chung</td> 
    </tr>
    <tr style="background-color: #dff0d8;">
      <td>Nội dung</td>
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
    <tr>
      <td>Cụ thể từng đơn vị</td>    
    </tr>
    <tr style="background-color: #dff0d8;">
      <td>STT</td>
      <td>Tên đơn vị</td>
      <td>Số yêu cầu</td>
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
  @endif
  </table>
</body>  
</html>
