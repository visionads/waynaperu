<div class="row">
    <div class="col-md-12">
        <div class="col-md-6">
            <div class="form-group">
                <label for="number">{{ trans('provider.phone_number') }}</label>
                {{ Form::text('number',null,['class'=>'form-control','required']) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="number">{{ trans('provider.type') }}</label>
                {{ Form::select('type',['1'=>trans('provider.telephone'),'2'=>'RPC','3'=>'RPM'],null,['class'=>'form-control']) }}
            </div>
        </div>
    </div>
</div>
