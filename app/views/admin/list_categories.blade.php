@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	<div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/category/add">Add Category</a></div>
    <table class="table table-striped table-hover" id="sample-table-2">
        <thead>
        <tr>
            <th class="center">
                
                        category ID
                   </th>

            <th >Title</th>
            <th>Description</th>
            <th>Orders</th>
            
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php 
        $cat_count = count($categories); 
        ?>        
        @if($cat_count > 0)
        @foreach ($categories as $category)

        <tr>
            <td class="center">
               
                        {{ $category->cat_id }}
                       
                  </td>
            <td>{{ $category->title }}</td>

            <td >
                {{ substr(strip_tags($category->description), 0, 20) }}
            </td>
            <td>
                {{ $category->orders }}
            </td>
            {{-- <td>{{ $category->code }}</td> --}}
             
            <td class="center">
                <div class="">
                    <a href="{{ URL::to('/') }}/admin/category/edit/{{ $category->cat_id }}" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    
                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$category->cat_id}},'category/delete')"><i class="fa fa-times fa fa-white"></i></a>
                </div>
                
            </td>
        </tr>
        @endforeach
        @else 
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>
                <div>No Categories found</div>
            </td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        @endif      
        </tbody>
           
    </table>
</div>

@stop
