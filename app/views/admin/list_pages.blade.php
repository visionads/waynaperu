@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	<div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/page/add">Add New Content</a></div>
    <div class="card">
        <div class="card-body">
            {{--<table class="table table-striped table-hover" id="sample-table-2 example">--}}
            <table class="table table-striped table-hover" id="dtable">
                <thead>
                <tr>
                    <th class="center">
                        <div class="checkbox-table">
                            <label>
                                Page ID
                            </label>
                        </div></th>

                    <th class="hidden-xs">Title</th>
                    <th class="hidden-xs">State</th>
                    <th class="hidden-xs">Description</th>
                    <th class="hidden-xs">Language</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @foreach ($list_pages as $page)

                    <tr>
                        <td class="center">
                            <div class="checkbox-table">
                                <label>
                                    {{ $page->page_id }}

                                </label>
                            </div></td>
                        <td>{{ $page->title }}</td>
                        <td>
                            @if($page->state == '1')
                                Published
                            @else
                                Unpublished
                            @endif
                        </td>

                        <td class="hidden-xs">
                            {{ substr(strip_tags($page->description), 0, 20) }}
                        </td>

                        <td>
                            {{ $page->name }}
                        </td>
                        <td class="center">
                            <div class="visible-md visible-lg hidden-sm hidden-xs">
                                <a href="{{ URL::to('/') }}/admin/page/edit/{{ $page->page_id }}" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                <!-- <a href="{{ URL::to('/') }}/admin/page/delete/{{ $page->page_id }}" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" ><i class="fa fa-times fa fa-white"></i></a> -->
                                <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$page->page_id}},'page/del')"><i class="fa fa-times fa fa-white"></i></a>
                            </div>
                        </td>
                    </tr>

                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
@stop
