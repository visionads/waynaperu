@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
    <div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/faq/add">Add New FAQ</a></div>
    <table class="table table-striped table-hover" id="sample-table-2">
        <thead>
        <tr>
            <th class="center">
                <div class="checkbox-table">
                    <label>
                        FAQ ID
                    </label>
                </div></th>

            <th class="hidden-xs">Question</th>
            <th class="hidden-xs">State</th>
            <th class="hidden-xs">Answer</th>
            <th class="hidden-xs">Language</th>
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
            <td>
                @if($faq->state == '1')
                   Published
                @else
                   Unpublished
                @endif    
            </td>

            <td class="hidden-xs">
                {{ substr(strip_tags($faq->ans), 0, 20) }}
            </td>
            
             <td>
                    {{ $faq->name }}
            </td>
            <td class="center">
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="{{ URL::to('/') }}/admin/faq/edit/{{ $faq->faq_id }}" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$faq->faq_id}},'faq/del')"><i class="fa fa-times fa fa-white"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>    
           
    </table>
</div>

@stop
