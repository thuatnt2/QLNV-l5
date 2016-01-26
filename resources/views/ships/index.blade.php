@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
	<div class="box row-form">
		{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::horizontal_open(url('categories'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Giao Lisr-XMCTB') !!}
        <div class="col-sm-offset-3 col-sm-4">
            
        </div>    
        </fieldset>
        {!! Former::close() !!}
	</div>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
            <h3 class="box-title">DS List-XMCTB đã giao</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Loại đối tượng</th>
                        <th class="text-center">Kí hiệu</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ships as $index => $ship)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $ship->description }}</td>
                        <td class="text-center">{{ $ship->symbol }}</td>
                        <td class="text-center">{{ $ship->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $ship->updated_at->format('d/m/Y') }}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('shipController@edit', $ship->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('shipController@destroy', $ship->id) }}" title="Xóa"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
	</div>
</div>
@stop
@section('javascript')
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop