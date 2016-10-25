<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_of_inscription">{{ trans('provider.date_of_inscription') }}</label>
            {{ Form::input('date','date_of_inscription',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="blog_comments">{{ trans('provider.blog_comments') }}</label>
            {{ Form::text('blog_comments',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="experience_review">{{ trans('provider.experience_review') }}</label>
            {{ Form::text('experience_review',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="amount_of_purchase">{{ trans('provider.amount_of_purchase') }}</label>
            {{ Form::text('amount_of_purchase',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
