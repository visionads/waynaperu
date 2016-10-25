<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">{{ trans('provider.name') }}</label>
            {{ Form::text('name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="account_number">{{ trans('provider.account_number') }}</label>
            {{ Form::text('account_number',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="account_type">{{ trans('provider.account_type') }}</label>
            {{ Form::select('account_type',['external'=>trans('text.external_bank'),'internal'=>trans('text.internal_bank')],null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
