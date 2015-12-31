<div class="row">
<div class="box">
{!! Former::setOption('automatic_label', false) !!}
{!! Former::setOption('TwitterBootstrap3.labelWidths', array('large' => 2, 'small' => 3)) !!}
 {!! Former::open() !!}
 <fieldset>
    {!! Former::legend('Form') !!}
    <div class="col-sm-4">
        {!! Former::text('test' )->addClass('input-sm')->placeholder('Test') !!}
        {!! Former::text('unit')->addClass('input-sm')->placeholder('Ten don vi') !!}
    </div>
    <div class="col-sm-4">
        {!! Former::text('test1')->addClass('input-sm')->placeholder('Test') !!}
        {!! Former::text('unit1')->addClass('input-sm')->placeholder('Ten don vi') !!}
    </div>
    <div class="col-sm-4">
        {!! Former::text('test2')->addClass('input-sm')->placeholder('Test') !!}
        {!! Former::text('unit2')->addClass('input-sm')->placeholder('Ten don vi') !!}
 
    </div>
    {!! Former::actions()->large_success_submit('Submit')->large_inverse_reset('Reset') !!}        
    </fieldset>
        
        {!! Former::close() !!}    
</div>
    
   
</div>