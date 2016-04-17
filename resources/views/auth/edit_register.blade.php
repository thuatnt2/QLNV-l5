	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
    {!! Former::horizontal_open(action('Auth\AuthController@update', $user->id))->id('form-edit') !!}
    {{ method_field('PUT') }}
    <div class="col-sm-offset-3 col-sm-4">
        {!! Former::text('username', 'Tên đăng nhập')->required()->value($user->username)->addClass('input-sm'); !!}
        {!! Former::text('fullname', 'Họ và tên')->required()->value($user->fullname)->addClass('input-sm'); !!}
        {!! Former::select('role')->label('Quyền')->options($roles, $user->role)->addClass('input-sm') !!}
    </div>   
    <div class="form-group">
        <div class="col-lg-offset-4 col-sm-offset-4 col-lg-8 col-sm-8">
             <button type="submit" class="btn btn-success btn-small"><i class="fa fa-edit">&nbsp</i>Sửa</button>
             <button type="reset" class="btn btn-default btn-small"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
             <button type="button" class="btn btn-danger btn-small" onclick="hideForm()" ><i class="fa fa-reply">&nbsp</i>Hủy</button>
        </div>
    </div> 
    {!! Former::close() !!}
    <script>
        function hideForm() {
            $('#form-create').show();
             $('#title-form').text('Form đăng ký');
            $('#form-edit').remove();
        }
    </script>