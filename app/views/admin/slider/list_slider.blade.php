@extends('admin.layout')

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info">
            {{ Session::get('message') }}
        </div>
    @endif
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
    <div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/slider/add">Add Slide</a></div>

    <table class="table table-striped table-hover" id="sample-table-2">
        <tbody>
        @foreach($sliders as $slider)
            <tr>
                <td style="text-align: center">
                    {{ $slider->caption }}
                    <br>
                    <b>Sequence ::</b> {{ $slider->sequence }}
                    <br>
                    @if($slider->status=='active')
                        <a onclick="return confirm('Are you confirm to Inactive slide ?')" href="{{ url('admin/slider/change_status/inactive/'.$slider->id) }}" class="btn btn-primary btn-block btn-xs">Active</a>
                    @elseif($slider->status=='inactive')
                        <a onclick="return confirm('Are you confirm to change Active slide ?')" href="{{ url('admin/slider/change_status/active/'.$slider->id) }}" class="btn btn-primary btn-block btn-xs">Inactive</a>
                    @endif
                    <a href="{{ url('admin/slider/edit/'.$slider->id) }}" class="btn btn-info btn-block btn-xs">Edit</a>
                    <a onclick="return confirm('Are you confirm to delete slide ?')" href="{{ url('admin/slider/delete/'.$slider->id) }}" class="btn btn-danger btn-block btn-xs">Delete</a>
                </td>
                <td width="70%">
                    <img src="{{ asset($slider->path) }}" width="100%" height="200px" alt="">
                </td>
            </tr>
        @endforeach

        </tbody>    
    </table>
</div>
@stop