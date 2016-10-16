<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="name">Name</label>
            {{ Form::text('name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="account_number">Account Number</label>
            {{ Form::text('account_number',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="account_type">Account Type</label>
            {{ Form::select('account_type',['external'=>trans('text.external_bank'),'internal'=>trans('text.internal_bank')],null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
