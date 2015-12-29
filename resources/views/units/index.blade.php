@extends('layouts.master')
@section('content')
<div class="row">
    <div class="box">
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::horizontal_open(url('units')) !!}
        <fieldset>
        {!! Former::legend('Form tạo mới đơn vị') !!}
        <div class="col-sm-offset-3 col-sm-4">
            {!! Former::text('unit', 'Tên đơn vị')->required()->addClass('input-sm'); !!}
            {!! Former::text('symbol', 'Ký hiệu')->required()->addClass('input-sm'); !!}
            {!! Former::radios('block', 'Thuộc khối')
            ->radios([
                'An ninh' => ['value' => 'AN'],
                'Cảnh sát' => ['value' => 'CS']
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
                        <th class="text-center class="text-center"">Khối</th>
                        <th class="text-center class="text-center"">Ngày tạo</th>
                        <th class="text-center class="text-center"">Ngày sửa</th>
                        <th class="text-center class="text-center"">Thao tác</th>
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
                            <form class="pull-left" action="{{ action('UnitController@edit', $unit->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('GET') }}
                                <button class="btn btn-warning btn-xs fa fa-edit" title="Sửa"></button>
                            </form>
                            <!-- TODO: Delete Button -->
                            <form class="pull-right" action="{{ url('units', $unit->id) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button class="btn btn-danger btn-xs fa fa-trash" title="Xóa"></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div>
    
@endsection
