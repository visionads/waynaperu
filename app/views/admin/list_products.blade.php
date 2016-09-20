@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	<div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/product/add">Add New Product</a></div>
    <table class="table table-striped table-hover" id="sample-table-2">
        <thead>
        <tr>
            <th class="center">
                <div class="checkbox-table">
                    <label>
                        Product ID
                    </label>
                </div></th>

            <th class="hidden-xs">Title</th>
            <th class="hidden-xs">Mini Description</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        
        @foreach ($products as $product)

        <tr>
            <td class="center">
                <div class="checkbox-table">
                    <label>
                        {{ $product->product_id }}
                       
                    </label>
                </div></td>
            <td>{{ $product->title }}</td>
            

            <td class="hidden-xs">
                {{ substr(strip_tags($product->mini_description), 0, 20) }}
            </td>
            
             
            <td class="center">
                <div class="visible-md visible-lg hidden-sm hidden-xs">
                    <a href="{{ URL::to('/') }}/admin/product/edit/{{ $product->product_id }}" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                    
                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$product->product_id}},'product/delete')"><i class="fa fa-times fa fa-white"></i></a>
                </div>
            </td>
        </tr>
        @endforeach
        </tbody>	
           
    </table>
</div>

@stop
