@if ($order->purpose->group == 'monitor')
    @foreach($order->phones as $index=> $phone)
    @if($detail)
        <div class="col-sm-11" style="padding-left: 0px">
            <span>{{ $phone->number}}</span>
        </div>
    @endif
    
    <span class="btn btn-{{ $phone->status }} btn-xs" data-toggle="modal" data-target="#statusModal" data-url="{{ action('OrderController@updateStatus', $phone->id) }}" data-status="{{ $phone->status }}" data-number="{{ $phone->number }}" >
        @if ($phone->status == 'success')
            <i class="fa fa-link " title="Kết nối"></i>
        @elseif($phone->status == 'warning')
            <i class="fa fa-hourglass-half" title="Đang chờ"></i>
        @else
            <i class="fa fa-times" title="Đóng hoặc không kết nôi" ></i>
        @endif
    </span>
    <br>
    @endforeach
@else 
    @foreach($order->phones as $index=> $phone)
    @if($detail)
        <div class="col-sm-11" style="padding-left: 0px">
            <span>{{ $phone->number}}</span>
        </div>
    @endif
    
    <span class="btn btn-{{ $phone->status }} btn-xs" data-toggle="modal" data-target="#statusModal" data-url="{{ action('OrderController@updateStatus', $phone->id) }}" data-status="{{ $phone->status }}" data-number="{{ $phone->number }}" >

        @if ($phone->status == 'success')
            <i class="fa fa-check " title="Đã giao"></i>
        @elseif($phone->status == 'warning')
            <i class="fa fa-hourglass-half" title="Đang chờ"></i>
        @else
            <i class="fa fa-times" title="Đóng hoặc không kết nôi" ></i>
        @endif
    </span>
    <br>
    @endforeach
@endif