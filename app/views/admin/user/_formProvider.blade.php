<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="vat_number">VAT Number</label>
            {{ Form::text('vat_number',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="incharge">Person In-charge</label>
            {{ Form::text('incharge',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="contact_expire_date">Date of Closing Contract</label>
            {{ Form::input('date','contact_expire_date',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="contact_valid_until">Contract Valid Until</label>
            {{ Form::text('contact_valid_until',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
