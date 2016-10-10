<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="date_of_inscription">Date of Inscription</label>
            {{ Form::input('date','date_of_inscription',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="blog_comments">Blog Comments</label>
            {{ Form::text('blog_comments',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="experience_review">Experience Review</label>
            {{ Form::text('experience_review',null,['class'=>'form-control']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="amount_of_purchase">Amount of Purchase</label>
            {{ Form::text('amount_of_purchase',null,['class'=>'form-control']) }}
        </div>
    </div>
</div>
