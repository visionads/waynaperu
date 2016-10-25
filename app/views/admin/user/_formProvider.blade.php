<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="vat_number">{{ trans('provider.vat_number') }}</label>
            {{ Form::text('vat_number',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="incharge">{{ trans('provider.person_in_charge') }}</label>
            {{ Form::text('incharge',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="contact_expire_date">{{ trans('provider.date_of_closing_contract') }}</label>
            {{ Form::input('date','contact_expire_date',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="contact_valid_until">{{ trans('provider.contract_valid_until') }}</label>
            {{ Form::text('contact_valid_until',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
