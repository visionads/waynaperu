<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">First name</label>
            {{ Form::text('first_name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name">Last name</label>
            {{ Form::text('last_name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="dob">Date of Birth</label>
            {{ Form::input('date','dob',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="passport">Passport</label>
            {{ Form::text('passport',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="direction">Direction</label>
            {{ Form::text('direction',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="flat">Flat</label>
            {{ Form::text('flat',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="department">Department</label>
            {{ Form::text('department',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="district">District</label>
            {{ Form::text('district',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city">City</label>
            {{ Form::text('city',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="province">Province</label>
            {{ Form::text('province',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="address">Address</label>
            {{ Form::textarea('address',null,['class'=>'form-control','rows'=>3]) }}
        </div>
    </div>
</div>
