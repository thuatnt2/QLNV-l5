@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('css/app.css') }}">
@stop
@section('content')
@include('partials.flash')
@include('partials.confirm')
<div class="row">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Danh sách đối tượng được giao</h3>
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
