<div class="form-group">
    {{ Form::label('caption','Caption') }}
    {{ Form::text('caption',null,['class'=>'form-control']) }}
</div>
<div class="form-group">
    {{ Form::label('sequence','Sequence') }}
    {{ Form::input('number','sequence',null,['class'=>'form-control','min'=>0]) }}
</div>
<div class="form-group">
    {{ Form::label('status','Status :') }}
    {{ Form::radio('status','active',null,['required'=>'required']) }} Active
    {{ Form::radio('status','inactive',null,['required'=>'required']) }} Inactive
</div>