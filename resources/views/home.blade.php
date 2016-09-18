@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
<div class="row">
	<div class="box">
		 <div class="box-header text-center">
            <h3 class="box-title" style="color: red; font-weight: bold;">PHÂN CÔNG GIÁM SÁT</h3>
        </div>
	</div>
	<?php $color = ["box-success", "box-info", "box-danger", "box-warning", "box-default", "box-primary"]?>
	@foreach ($users as $index=>$user)
		<?php 
			$i = $index;
			if($i > 5) $i = 0;
		?>
		<div class="col-sm-4">
			<div class="box {{ $color[$i] }} box-solid">
                <div class="box-header with-border">
                  <h3 class="box-title">{{ $user->fullname }}</h3>
                  <span class="pull-right">{{ $user->total }}</span>
                </div><!-- /.box-header -->
                <table class="table table-bordered table-striped">
                <thead>
	                <tr>
	                	<th class="text-center">STT</th>
	                	<th class="text-center">Họ tên</th>
	                	<th class="text-center">Số ĐT</th>
	                	<th class="text-center">Thời gian y/c</th>
	                	<th class="text-center">Tính chất</th>
	                </tr>
                </thead>
	                <tbody>
	                <?php $count = 1; ?>
	                @foreach ($managers as $manager)
	                	@if ($manager->manager == $user->id)
		                	<tr>
		                		<td class="text-center">{{ $count++ }}</td>
		                		<td class="text-center">{{ $manager->order_name }}</td>
		                		<td class="text-center">
		                			@foreach ($manager->phones as $phone)
                                        {{ $phone->number }} <br> 
                                    @endforeach
                                </td>
		                		<td class="text-center">{{ $manager->date_begin->format('d/m/Y') .' &rarr; ' . $manager->date_end->format('d/m/Y') }}</td>
		                		<td class="text-center">{{ $manager->kind->symbol }}</td>
		                	</tr>
	                	@endif
	                @endforeach
	                </tbody>
                </table>
            </div>
		</div>
	@endforeach
	
</div>
@stop
@section('javascript')
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
