<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="first_name">{{ trans('provider.first_name') }}</label>
            {{ Form::text('first_name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="last_name">{{ trans('provider.last_name') }}</label>
            {{ Form::text('last_name',null,['class'=>'form-control','required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="dob">{{ trans('provider.date_of_birth') }}</label>
            {{ Form::input('date','dob',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="passport">{{ trans('provider.passport') }}</label>
            {{ Form::text('passport',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="direction">{{ trans('provider.direction') }}</label>
            {{ Form::text('direction',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="flat">{{ trans('provider.flat') }}</label>
            {{ Form::text('flat',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="department">{{ trans('provider.department') }}</label>
            {{ Form::text('department',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="district">{{ trans('provider.district') }}</label>
            {{ Form::text('district',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="city">{{ trans('provider.city') }}</label>
            {{ Form::text('city',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="province">{{ trans('provider.province') }}</label>
            {{ Form::text('province',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="address">{{ trans('provider.address') }}</label>
            {{ Form::textarea('address',null,['class'=>'form-control','rows'=>3]) }}
        </div>
    </div>
</div>
