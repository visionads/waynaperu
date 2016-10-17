<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-group">
                <label for="number">Phone Number</label>
                {{ Form::text('number',null,['class'=>'form-control','required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="number">Type</label>
                {{ Form::select('phone_type',['1'=>'Telephone','2'=>'RPC','3'=>'RPM'],null,['class'=>'form-control']) }}
            </div>
        </div>
    </div>
</div>
