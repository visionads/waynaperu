<div class="row">
    <?php
    isset($user)?$readonly= 'readonly':$readonly='';
    isset($user)?$required= 'required':$required='';
    ?>
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
    <div class="col-md-12">
        <div class="form-group">
            <label for="username">User Name</label>
            {{ Form::text('username',null,['class'=>'form-control','required',$k]) }}
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            {{ Form::email('email',null,['class'=>'form-control','required',$k]) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            {{ Form::password('password',['class'=>'form-control','id'=>'password']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="c_password">Confirm Password</label>
            {{ Form::password('c_password',['class'=>'form-control','id'=>'c_password']) }}
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="type">User Type</label>
            {{ Form::select('type',['client'=>'Client','provider'=>'Provider','admin'=>'Admin'],null,['class'=>'form-control','required']) }}
        </div>
    </div>
</div>
