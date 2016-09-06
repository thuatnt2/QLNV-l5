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
        {!! Former::horizontal_open(url('units'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Form tạo mới đơn vị') !!}
        <div class="col-sm-offset-3 col-sm-4">
            {!! Former::text('description', 'Tên đơn vị')->required()->addClass('input-sm'); !!}
            {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm'); !!}
            {!! Former::radios('block', 'Thuộc khối')
            ->radios([
                'An ninh' => ['value' => 'AN', 'checked' => true],
                'Cảnh sát' => ['value' => 'CS'],
                'Địa phương' => ['value' => 'ĐP']
            ])
            ->inline()
             !!}
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
            <h3 class="box-title">Danh sách đơn vị yêu cầu</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th class="text-center">STT</th>
                        <th class="text-center">Tên đơn vị</th>
                        <th class="text-center">Kí hiệu</th>
                        <th class="text-center">Khối</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($units as $index => $unit)
                    <tr>
                        <td class="text-center">{{ ++$index }}</td>
                        <td class="text-center">{{ $unit->description }}</td>
                        <td class="text-center">{{ $unit->symbol }}</td>
                        <td class="text-center">{{ $unit->block }}</td>
                        <td class="text-center">{{ $unit->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">{{ $unit->updated_at->format('d/m/Y') }}</td>
                        <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('UnitController@edit', $unit->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('UnitController@destroy', $unit->id) }}" title="Xóa"></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
    
@stop
@section('javascript')
{{-- app.js --}}
<script src="{{ URL::asset('js/app.js') }}"></script>
@stop
