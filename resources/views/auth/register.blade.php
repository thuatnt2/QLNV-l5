@extends('layouts.master')
@section('css')

{{-- DateRangepicker --}}
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
    <div class="box row-form">
        <div class="row">
            <div class="col-sm-11">
                <span style="padding-left: 8px;font-size: 18px;" id="title-form">Form Đăng ký</span>
           </div>
        </div>
        <hr>
        {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('register'))->id('form-create') !!}
        <div class="col-sm-4 col-sm-offset-3">
            {!! Former::text('username', 'Tên đăng nhập')->required()->addClass('input-sm'); !!}
            {!! Former::text('fullname', 'Họ và tên')->required()->addClass('input-sm'); !!}
            {!! Former::select('role')->label('Quyền')->options($roles)->addClass('input-sm') !!}
        </div> 
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
               <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus">&nbsp</i>Thêm</button>
               <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
           </div>
        </div>
        {!! Former::close() !!}
    </div>
</div>
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách người dùng</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
            <table id="sortTable" class="table table-bordered table-striped">
                <thead>
                    <tr class="success">
                        <th class="text-center">STT</th>
                        <th class="text-center">Họ và tên</th>
                        <th class="text-center">Tên đăng nhập</th>
                        <th class="text-center">Quyền</th>
                        <th class="text-center">Ngày tạo</th>
                        <th class="text-center">Ngày sửa</th>
                        <th class="text-center">Reset Password</th>
                        <th class="text-center">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $index => $user)
                <tr>
                    <td class="text-center">{{ ++$index }}</td>
                    <td class="text-center">{{ $user->fullname }}</td>
                    <td class="text-center">{{ $user->username }}</td>
                    <td class="text-center">{{ $user->role }}</td>
                    <td class="text-center">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="text-center">{{ $user->updated_at->format('d/m/Y') }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-success btn-xs">Reset</button>
                    </td>
                    <td class="text-center"width="6%">
                            <button class="btn btn-warning btn-xs fa fa-edit" data-url="{{ action('Auth\AuthController@edit', $user->id) }}" type="button" title="Sửa"></button>
                            <!-- TODO: Delete Button -->
                            &nbsp
                            <button class="btn btn-danger btn-xs fa fa-trash" data-toggle="modal" data-target="#confirmModal" data-url="{{ action('Auth\AuthController@destroy', $user->id) }}" title="Xóa"></button>
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
