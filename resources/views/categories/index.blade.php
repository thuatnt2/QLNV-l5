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
        {!! Former::legend('Thêm loại đối tượng') !!}
        <div class="col-sm-offset-3 col-sm-4">
            {!! Former::text('description', 'Loại đối tượng')->required()->addClass('input-sm'); !!}
            {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm'); !!}
            <div class="form-group">
                <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
                     <button type="submit" class="btn btn-success btn-small"><i class="fa fa-plus">&nbsp</i>Thêm</button>
                     <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                </div>
            </div>
        </div>    
        </fieldset>
        {!! Former::close() !!}
	</div>
</div>
<div class="row">
	<div class="box">
		<div class="box-header">
            <h3 class="box-title">Danh sách loại đối tượng</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Loại đối tượng</th>
                        <th class="text-center">Kí hiệu</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $index => $category)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $category->description }}</td>
                        <td class="text-center">{{ $category->symbol }}</td>
                        <td class="text-center">{{ $category->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $category->updated_at->format('d/m/Y') }}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('CategoryController@edit', $category->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('CategoryController@destroy', $category->id) }}" title="Xóa"></button>
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