@extends('admin.layout')

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<div class="panel-body">
	<div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/add_language">Add Language</a></div>
    <div class="card">
        <div class="card-body">
            <table class="table table-striped table-hover" id="datatable1">
                <thead>
                <tr>
                    <th class="center">
                        <div class="checkbox-table">
                            <label>
                                &nbsp;
                            </label>
                        </div></th>

                    <th class="hidden-xs">Name</th>
                    <th class="hidden-xs">Language Code</th>
                    <th class="hidden-xs">Flag</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $lang_count	= count($languages);
                ?>
                @if($lang_count > 0)
                    <?php $count = 1; ?>
                    @foreach ($languages as $language)

                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        {{ $count }}
                                        <?php $count++; ?>
                                    </label>
                                </div></td>
                            <td>{{ $language->name }}</td>

                            <td class="hidden-xs">
                                {{ $language->code }}
                            </td>
                            <td>
                                <img src="{{url('/')}}/uploads/flags/{{ $language->flag }}">
                            </td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="edit_language/<?php echo $language->id; ?>" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$language->id}},'delete_language')"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>
                            <div>No Languages found</div>
                        </td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
