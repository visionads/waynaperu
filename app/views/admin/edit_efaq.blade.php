<div class="card">    <div class="card-body">        <form id="edit_faq">            <input type="hidden" name="product_id" value="{{ $loc->product_id }}">            <input type="hidden" name="faq_id" value="{{ $loc->id }}">            <fieldset>                <div class="col-md-8 col-lg-8 col-sm-12">                    <div class="tabbable-panel">                        <div class="tabbable-line">                            <ul class="nav nav-tabs ">                                @foreach($faqs as $index => $faq)                                    <li class="@if($index == 0) active @endif">                                        <a href="#edit_{{ $faq->lang_name }}" data-toggle="tab"> {{ $faq->lang_name }} </a>                                    </li>                                @endforeach                            </ul>                            <div class="tab-content">                                @foreach($faqs as $index => $faq)                                    <div class="tab-pane @if($index == 0)active @endif" id="edit_{{ $faq->lang_name }}">                                        <div class="form-group">                                            {{ Form::label('que', 'Question', array('class' => 'col-sm-3 control-label')) }}                                            <div class="col-sm-9">                                                <input type="text" name="que[{{ $faq->id }}]" placeholder="Question" class="form-control" value="{{ $faq->que }}"/>                                                {{ $errors->first('que['. $faq->id .']') }}                                            </div>                                        </div>                                        <div class="form-group">                                            {{ Form::label('ans', 'Answer', array('class' => 'col-sm-3 control-label')) }}                                            <div class="col-sm-9">                                                <textarea name="ans[{{ $faq->id }}]" class="editor form-control" placeholder="Answer" >{{ $faq->ans }}</textarea>                                                {{ $errors->first('ans['. $faq->id .']') }}                                            </div>                                        </div>                                    </div>                                @endforeach                            </div>                        </div>                    </div>                </div>            </fieldset>        </form>    </div></div>