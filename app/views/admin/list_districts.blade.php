@extends('admin.layout')@section('content')<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"><div class="panel-body">	<div><a class="link btn btn-primary" href="{{ URL::to('/') }}/admin/district/add">Add District</a></div>    <div class="card">        <div class="card-body">            <table class="table table-striped table-hover" id="datatable1">                <thead>                <tr>                    <th class="center">                        <div class="checkbox-table">                            <label>                                &nbsp;                            </label>                        </div></th>                    <th class="hidden-xs">Name</th>                    <th></th>                </tr>                </thead>                <tbody>                <?php                $lang_count	= count($districts);                ?>                @if($lang_count > 0)                    <?php $count = 1; ?>                    @foreach ($districts as $district)                        <tr>                            <td class="center">                                <div class="checkbox-table">                                    <label>                                        {{ $count }}                                        <?php $count++; ?>                                    </label>                                </div></td>                            <td>{{ $district->name }}</td>                            <td class="center">                                <div class="visible-md visible-lg hidden-sm hidden-xs">                                    <a href="{{ URL::to('/') }}/admin/district/edit/<?php echo $district->id; ?>" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>                                    <a href="#" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return common_delete({{$district->id}},'district/delete')"><i class="fa fa-times fa fa-white"></i></a>                                </div>                            </td>                        </tr>                    @endforeach                @else                    <tr>                        <td>&nbsp;</td>                        <td>&nbsp;</td>                        <td>                            <div>No District found</div>                        </td>                        <td>&nbsp;</td>                        <td>&nbsp;</td>                    </tr>                @endif                </tbody>            </table>        </div>    </div></div>@stop