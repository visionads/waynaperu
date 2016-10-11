@extends('admin.layout')
@section('content')
    <div class="panel-body">
        <div class="card">
            <div class="card-body">
    <!-- page start-->
                <h3>
                    Activities of all users
                </h3>

                    {{-------------- Filter :Ends -------------------------------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> ID </th>
                                <th> User Name </th>
                                <th> User Type </th>
                                <th> Action Name </th>
                                <th> Action URL </th>
                                <th> Action Details </th>
                                <th> Action Table</th>
                                <th> Date </th>
                                <th> Modified BY </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $values)
                                    <tr class="gradeX">
                                        <td>{{ $serial }}</td>
                                        <td>
                                            <a href="{{ url('profile/'.$values['relUser']->id) }}">
                                                {{ $values['relUser']->first_name.' '.$values['relUser']->last_name }}
                                            </a>
                                        </td>
                                        <td>{{ucfirst($values['relUser']->type)}}</td>
                                        <td>{{ucfirst($values->action_name)}}</td>
                                        <td>{{ucfirst($values->action_url)}}</td>
                                        <td>{{ $values->action_details }}</td>
                                        <td>{{ $values->action_table }}</td>
                                        <td>{{ $values->date }}</td>
                                        <td>{{ $values->username }}</td>

                                    </tr>
                                    <?php $serial++; ?>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <span class="pull-right">{{ $activities->links() }}</span>
            </div>
        </div>
    </div>
    <!-- page end-->



@stop