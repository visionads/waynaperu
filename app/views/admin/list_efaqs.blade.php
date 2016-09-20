@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	
    <div class=""><button data-toggle="modal" data-target="#addFaqModal" class="btn btn-primary center-block">Add New Faq</button></div>
    @if(count($faqs) > 0)
    <table class="table table-striped table-hover" id="sample-table-2">
        <thead>
        <tr>
            <th class="center">
                <div class="checkbox-table">
                    <label>
                        FAQ ID
                    </label>
                </div></th>

            <th >Question</th>
            
            <th></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach ($faqs as $faq)

        <tr>
            <td class="center">
                <div class="checkbox-table">
                    <label>
                        {{ $faq->faq_id }}
                       
                    </label>
                </div></td>
            <td>{{ $faq->que }}</td>
           
            <td class="center">
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a data-faqid ="{{ $faq->faq_id }}" class="editfaq btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                   
                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$faq->faq_id}},'efaq/delete')"><i class="fa fa-times fa fa-white"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
       
        </tbody>	
           
    </table>
     @else
        <p> No FAQ Found. </p>
     @endif
</div>



{{-- Add FAQ --}}
<!-- line modal -->
<div class="modal fade" id="addFaqModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Add FAQ</h3>
        </div>
        <div class="modal-body">

           <form id="add_faq">
               <input type="hidden" name="product_id" value="{{ $product_id }}">
                <fieldset>
                    <div class="col-md-8 col-lg-8 col-sm-12">
                        <div class="tabbable-panel">
                            <div class="tabbable-line">
                                <ul class="nav nav-tabs ">
                                    @foreach($languages as $index => $language)
                                        <li class="@if($index == 0) active @endif">
                                            <a href="#{{ $language->name }}" data-toggle="tab"> {{ $language->name }} </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content">
                                    @foreach($languages as $index => $language)
                                        <div class="tab-pane @if($index == 0)active @endif" id="{{ $language->name }}">
                                            
                                            <div class="form-group">
                                                {{ Form::label('que', 'Question', array('class' => 'col-sm-3 control-label')) }}
                                                
                                                <div class="col-sm-9">
                                                     <input type="text" name="que[{{ $language->code }}]" placeholder="Question" class="form-control"/>
                                                    {{ $errors->first('que['. $language->code .']') }}
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                {{ Form::label('ans', 'Answer', array('class' => 'col-sm-3 control-label')) }}
                                                
                                                <div class="col-sm-9">
                                                    <textarea name="ans[{{ $language->code }}]" class="form-control" placeholder="Answer" ></textarea>
                                                    {{ $errors->first('ans['. $language->code .']') }}
                                                   
                                                </div>
                                            </div>
                                           
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </fieldset>
            </form>
        </div>

        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                </div>
                
                <div class="btn-group" role="group">
                    <button type="button" data-dismiss="modal" id="saveFaq" class="btn btn-default btn-hover-green" data-action="save" role="button">Save</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

{{-- Edit FAQ --}}
<!-- line modal -->
<div class="modal fade" id="editFaqModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
            <h3 class="modal-title" id="lineModalLabel">Edit FAQ</h3>
        </div>
        <div class="modal-body">

           
        </div>
        <div class="modal-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" data-dismiss="modal" id="updateFaq" class="btn btn-default btn-hover-green" data-action="save" role="button">Update</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function(){

    $("#saveFaq").on("click",function(){

        var data = $('form#add_faq').serialize();
        var URL = '{{ route("save_efaq") }}';
        $.post(URL,data,function(response){
            // console.log(response)
        },"json")
    });
    $("#updateFaq").on("click",function(){

        var data = $('form#edit_faq').serialize();
        var URL = '{{ route("update_efaq") }}';
        $.post(URL,data,function(response){
            // console.log(response)
        },"json")
    });
    $('#addFaqModal, #editFaqModal').on('hidden.bs.modal', function () {
        location.reload();
    })


    $('a.editfaq').on('click', function() {
        $('#editFaqModal').modal('show');
        var faq_id = $(this).data('faqid');
        var product_id  = {{ $product_id }};
        var URL = '{{ URL::to('/') }}/admin/efaq/'+product_id+'/edit/'+faq_id;
        
        $.get(URL, function(response){
            // console.log(response);
            $('#editFaqModal .modal-body').html(response);
        });

    })

});
</script>
@stop
