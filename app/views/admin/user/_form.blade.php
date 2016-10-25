<div class="row">
    <?php
    isset($user)?$readonly= 'readonly':$readonly='';
    isset($user)?$required= 'required':$required='';
    ?>
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
    <div class="col-md-12">
        <div class="form-group">
            <label for="username">{{ trans('provider.username') }}</label>
            {{ Form::text('username',null,['class'=>'form-control',$required,$readonly]) }}
        </div>
        <div class="form-group">
            <label for="email">{{ trans('provider.email') }}</label>
            {{ Form::email('email',null,['class'=>'form-control',$required,$readonly]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">{{ trans('provider.password') }}</label>
            {{ Form::password('password',['class'=>'form-control','id'=>'password']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="c_password">{{ trans('provider.confirm_password') }}</label>
            {{ Form::password('c_password',['class'=>'form-control','id'=>'c_password']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="type">{{ trans('provider.user_type') }}</label>
            {{ Form::select('type',['client'=>'Client','provider'=>'Provider','admin'=>'Admin'],null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>
