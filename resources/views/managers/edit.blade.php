	{!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
    {!! Former::horizontal_open(action('DashBoardController@update', $id))->id('form-edit') !!}
    {{ method_field('PUT') }}
    <fieldset>
    {!! Former::legend('Form sửa phân công') !!}
    <div class="col-sm-offset-3 col-sm-4">
            {!! Former::select('user', 'Tên cán bộ')->options($users, $id)->addClass('input-sm'); !!}
            <?php 
                foreach ($orders as $key => $value) {
                    $managers[$key] = $value;
                }
            ?>
            {!! Former::multiselect('order', 'Danh sách đối tượng')->options($managers, array_keys($managers))->addClass('input-sm'); !!}
            <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit">&nbsp</i>Sửa</button>
                 <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                 <button type="button" class="btn btn-danger btn-sm" onclick="hideForm()" ><i class="fa fa-reply">&nbsp</i>Hủy</button>
           </div>
        </div>  
        </div>    
    </fieldset>
    {!! Former::close() !!}
    <script>
        function hideForm() {
            $('#form-create').show();
            $('#form-edit').remove();
        }
    </script>
