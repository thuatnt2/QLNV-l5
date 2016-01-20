  {!! Former::setOption('TwitterBootstrap3.labelWidths', ['large' => 4, 'small' => 4]) !!}
        {!! Former::open_for_files(url('orders'))->id('form-create') !!}
        <fieldset>
        {!! Former::legend('Thêm yêu cầu giám sát') !!}
        <div class="col-sm-4">
            {!! Former::text('created_at', 'Ngày yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
                
             !!}
            {!! Former::text('number_cv', 'Số công văn yêu cầu')->required()->addClass('input-sm'); !!}
            {!! Former::select('unit')->label('Đơn vị yêu cầu')->options($units)->addClass('input-sm') !!}
            {!! Former::text('number_cv_pa71', 'Số công văn PA71')->required()->addClass('input-sm'); !!}
            {!! Former::text('order_name', 'Tên đối tượng')->required()->addClass('input-sm'); !!}
          
        </div> 
        <div class="col-sm-4">
            {!! Former::text('order_phone[]', 'Số điện thoại ĐT')
                ->append('<i class="fa fa-plus add_phone"></i>')
                ->required()
                ->addClass('input-sm phone')
                ->addGroupClass('phone_order')
             !!}
            {!! Former::select('category')->label('Loại đối tượng')->options($categories)->addClass('input-sm') !!}
            {!! Former::select('kind')->label('Tính chất')->options($kinds)->addClass('input-sm') !!}
            {!! Former::checkboxes('purpose[]','Mục đích yêu cầu')
                ->checkboxes($purposes)
                ->inline()
            !!}
            {!! Former::text('date_request', 'Thời gian yêu cầu')
                ->required()
                ->addClass('input-sm daterange')
             !!}
        </div>
        <div class="col-sm-4">
            {!! Former::text('customer_name', 'Tên trinh sát')->addClass('input-sm'); !!}
            {!! Former::text('customer_phone', 'Số điện thoại TS')
                ->append('<i class="fa fa-phone"></i>')
                ->addClass('input-sm phone'); 
            !!}
           {!! Former::file('file','File đính kèm')->accept('doc', 'docx', 'xls', 'xlsx', 'pdf') !!}
           {!! Former::select('user')->label('Người nhận yêu cầu')->options($users)->addClass('input-sm') !!}
           {!! Former::textarea('comment')->label('Ghi chú') !!}
        </div>
        <div class="form-group">
            <div class="col-lg-offset-5 col-sm-offset-5 col-lg-8 col-sm-8">
               <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-plus">&nbsp</i>Thêm</button>
               <button type="reset" class="btn btn-default btn-sm"><i class="fa fa-refresh">&nbsp</i>Làm mới</button>
           </div>
            </div>
        </fieldset>
        {!! Former::close() !!}