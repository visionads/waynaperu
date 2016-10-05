@extends('admin.layout')

@section('content')
    <div class="panel-body">
        <div><a class="link btn btn-primary" href="{{ URL::route('add-user') }}">Add New User</a></div>
        <div class="card">
            <div class="card-body">
                <table class="table table-striped table-hover" id="sample-table-2">
                    <thead>
                    <tr>
                        <th class="center">
                            <div class="checkbox-table">
                                <label>
                                    Page ID
                                </label>
                            </div></th>

                        <th class="hidden-xs">Name</th>
                        <th class="hidden-xs">Email</th>
                        <th class="hidden-xs">Phone</th>
                        <th class="hidden-xs">Type</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)

                        <tr>
                            <td class="center">
                                <div class="checkbox-table">
                                    <label>
                                        {{ $serial }}

                                    </label>
                                </div></td>
                            <td>{{ $user->first_name.' '.$user->last_name }}</td>
                            <td>
                                {{ $user->email }}
                            </td>

                            <td class="hidden-xs">
                                {{ $user->phone }}
                            </td>

                            <td>
                                {{ $user->type }}
                            </td>
                            <td class="center">
                                <div class="visible-md visible-lg hidden-sm hidden-xs">
                                    <a href="{{ URL::route('edit-user',$user->id) }}" class="btn btn-xs btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i></a>
                                    <!-- <a href="{{ URL::to('/') }}/admin/page/delete/{{ $user->page_id }}" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" ><i class="fa fa-times fa fa-white"></i></a> -->
                                    <a href="{{ URL::route('delete-user',$user->id) }}" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" onclick="return confirm('Are you confirm to delete this user ?')"><i class="fa fa-times fa fa-white"></i></a>
                                </div>
                            </td>
                        </tr>

                        <?php $serial++; ?>
                    @endforeach
                    </tbody>
                    {{ $users->links() }}
                </table>
            </div>
        </div>
    </div>
@stop
