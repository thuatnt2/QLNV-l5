@extends('layouts.master')
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Kí hiệu</th>
                    <th>Mô tả</th>
                    <th>Khối</th>
                    <th>Ngày tạo</th>
                    <th>Ngày sửa</th>
                    <th>Thao tác</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($units as $index => $unit)
                <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $unit->symbol }}</td>
                    <td>{{ $unit->description }}</td>
                    <td>{{ $unit->block }}</td>
                    <td>{{ $unit->created_at }}</td>
                    <td>{{ $unit->updated_at }}</td>
                    <td width="6%">
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
@endsection
