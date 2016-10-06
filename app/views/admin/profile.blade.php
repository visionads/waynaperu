@extends('admin.layout')

@section('content')

    <div class="row">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <div class="panel-body">

            <div class="col-md-12 col-lg-12 col-sm-12">
                <div><a class="link btn btn-primary" href="{{ URL::to('user/edit/'.Auth::user()->id) }}"><i class="fa fa-pencil">&nbsp;</i>Edit</a></div><div style="height: 15px;">&nbsp;</div>
                <div class="card">
                    <div class="card-body">
                        @if(isset($user))
                            <div style="position: relative; margin-bottom: 10px;">
                                <div style="width:100px; height:100px; padding: 5px; border-radius:50%; background:#d0d0d0; display: inline-block;">
                                    <img src="{{ URL::to('assets/images/avatar-profile.png') }}" style="width: 90px; height: 90px; border: 1px solid #fff; border-radius: 50%;">
                                </div>
                                <span style="display: inline-block; position: absolute; left:120px; top:30px; font-size: 20px;">
                                    {{ $user->first_name }} {{ $user->last_name }}
                                </span>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <table class="table">
                                        <tr><th width="20%">Username</th><td width="1%">:</td><td width="79%">{{ $user->username }}</td></tr>
                                        <tr><th>Email</th><td>:</td><td>{{ $user->email }}</td></tr>
                                        <tr><th>First Name</th><td>:</td><td>{{ $user->first_name }}</td></tr>
                                        <tr><th>Last Name</th><td>:</td><td>{{ $user->last_name }}</td></tr>
                                        <tr><th>Type</th><td>:</td><td>{{ $user->type }}</td></tr>
                                        <tr><th>Phone</th><td>:</td><td>{{ $user->phone }}</td></tr>
                                        <tr><th>Passport</th><td>:</td><td>{{ $user->passport }}</td></tr>
                                        <tr><th>District</th><td>:</td><td>{{ $user->district }}</td></tr>
                                        <tr><th>City</th><td>:</td><td>{{ $user->city }}</td></tr>
                                        <tr><th>Province</th><td>:</td><td>{{ $user->province }}</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <table class="table bg-primary">
                                        <tr><th width="20%">Registration</th><td width="1%">:</td><td width="79%">{{ $user->created_at }}</td></tr>
                                        <tr><th>Last Update</th><td>:</td><td>{{ $user->updated_at }}</td></tr>
                                        <tr><th>Last Login</th><td>:</td><td>{{ $user->last_login }}</td></tr>
                                        {{--<tr><th>IP Address</th><td>:</td><td>{{ $user->last_login }}</td></tr>
                                        <tr><th>Banned at</th><td>:</td><td>{{ $user->last_login }}</td></tr>--}}
                                    </table>
                                </div>
                            </div>

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
