  {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(action('OrderController@update', $order->id))->id('form-edit') !!}
        <fieldset>
        {!! Former::legend('Thêm yêu cầu giám sát') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
                ->value($order->date_order->format('d/m/Y'))
                
            !!}
            {!! Former::text('number_cv', 'Số công văn yêu cầu')
                ->required()
                ->addClass('input-sm')
                ->value($order->number_cv)
            !!}
            {!! Former::select('unit', 'Đơn vị yêu cầu')
                ->options($units, $order->unit_id)
                ->addClass('input-sm')
            !!}
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')
                ->required()
                ->addClass('input-sm')
                ->value($order->number_cv_pa71)
            !!}
            {!! Former::text('order_name', 'Tên đối tượng')
                ->required()
                ->addClass('input-sm')
                ->value($order->order_name)
            !!}
          
        </div> 
        <div class="col-sm-4">
            {!! Former::text('order_phone[]', 'Số điện thoại ĐT')
                ->append('<i class="fa fa-plus add_phone"></i>')
                ->required()
                ->addClass('input-sm phone')
                ->addGroupClass('phone_order')
            !!}
            {!! Former::select('category', 'Loại đối tượng')
                ->options($categories, $order->category_id)
                ->addClass('input-sm')
            !!}
            {!! Former::select('kind')->label('Tính chất')->options($kinds, $order->kind_id)->addClass('input-sm') !!}
            {!! Former::checkboxes('purpose[]','Mục đích yêu cầu')
                ->checkboxes($purposes)
                ->inline()
                ->check($checked)
            !!}
            {!! Former::text('date_request', 'Thời gian yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
                ->value($order->date_begin->format('d/m/Y') .'-'. $order->date_end->format('d/m/Y'))
             !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('customer_name', 'Tên trinh sát')
                ->addClass('input-sm')
                ->value($order->customer_name)
            !!}
            {!! Former::text('customer_phone', 'Số điện thoại TS')
                ->append('<i class="fa fa-phone"></i>')
                ->addClass('input-sm phone')
                ->value($order->customer_phone) 
            !!}
           {!! Former::file('file','File đính kèm')->accept('doc', 'docx', 'xls', 'xlsx', 'pdf') !!}
           {!! Former::select('user', 'Người nhận yêu cầu')
                ->options($users, $order->user_id)
                ->addClass('input-sm')
            !!}
           {!! Former::textarea('comment')->label('Ghi chú') ->value($order->comment)!!}
        </div>
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
                <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-edit">&nbsp</i>Sửa</button>
                 <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
                 <button type="button" class="btn btn-danger btn-sm" onclick="hideForm()" ><i class="fa fa-reply">&nbsp</i>Hủy</button>
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