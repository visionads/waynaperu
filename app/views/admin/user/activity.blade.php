@extends('admin.layout')
@section('content')
    <div class="panel-body">
        <div class="card">
            <div class="card-body">
    <!-- page start-->
                <h3>
                    {{ trans('provider.activities_of') }} {{ $user->first_name.' '.$user->last_name }}
                </h3>

                    {{-------------- Filter :Ends -------------------------------------------}}
                    <div class="table-primary">
                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                            <thead>
                            <tr>
                                <th> {{ trans('provider.id') }} </th>
                                <th> {{ trans('provider.action_name') }} </th>
                                <th> {{ trans('provider.action_URL') }} </th>
                                <th> {{ trans('provider.action_details') }} </th>
                                <th> {{ trans('provider.action_table') }}</th>
                                <th> {{ trans('provider.date') }} </th>
                                <th> {{ trans('provider.modified_by') }} </th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($activities as $values)
                                    <tr class="gradeX">
                                        <td>{{ $serial }}</td>
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
                <a href="{{ url('profile/'.$user->id) }}" class="btn btn-warning">{{ trans('provider.back') }}</a>
            </div>
        </div>
    </div>
    <!-- page end-->



@stop