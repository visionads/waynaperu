@extends('admin.layout')

@section('content')

    <div class="row">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <div class="panel-body">

            <div class="col-md-12 col-lg-12 col-sm-12">
                <div>
                    @if(Session::get('type')=='admin')
                        <a class="link btn btn-warning" href="{{ URL::to('users/'.$user->type) }}"><i class="fa fa-arrow-left"></i> {{ trans('provider.back') }}</a>
                    @endif
                <a href="{{ URL::route('edit-profile',$user->id) }}" class="btn btn-info btn-blue tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-user"></i> {{ trans('provider.edit_profile') }}</a>
                <!-- <a href="{{ URL::to('/') }}/admin/page/delete/{{ $user->page_id }}" class="btn btn-xs btn-red tooltips" data-placement="top" data-original-title="Remove" ><i class="fa fa-times fa fa-white"></i></a> -->

                    <a class="link btn btn-info" href="{{ URL::to('user/edit/'.$user->id) }}"><i class="fa fa-pencil">&nbsp;</i>{{ trans('provider.edit') }}</a>
                    <a class="link btn btn-primary" href="{{ URL::route('user-activity',$user->id) }}">{{ trans('provider.user_activity') }}</a>
                    @if($user['type']!=='client')
                        <a class="link btn btn-success" href="{{ URL::route('products-provider',$user->id) }}">{{ trans('provider.product_list') }}</a>
                        <a class="link btn btn-success" href="{{ URL::route('orders-provider',$user->id) }}">{{ trans('provider.order_list') }}</a>
                    @endif

                </div>
                <div style="height: 15px;">&nbsp;
                </div>
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
{{--                                        <tr><th width="20%">{{ trans('provider.username') }}</th><td width="1%">:</td><td width="79%">{{ $user->username }}</td></tr>--}}
                                        <tr><th>{{ trans('provider.email') }}</th><td>:</td><td>{{ $user->email }}</td></tr>
                                        <tr><th>{{ trans('provider.first_name') }}</th><td>:</td><td>{{ $user->first_name }}</td></tr>
                                        <tr><th>{{ trans('provider.last_name') }}</th><td>:</td><td>{{ $user->last_name }}</td></tr>
                                        <tr><th>{{ trans('provider.date_of_birth') }}</th><td>:</td><td>{{ $user->dob }}</td></tr>
                                        <tr><th>{{ trans('provider.type') }}</th><td>:</td><td>{{ $user->type }}</td></tr>
                                        <tr><th>{{ trans('provider.phone') }}</th><td>:</td><td>{{ $user->phone }}</td></tr>
                                        <tr><th>{{ trans('provider.passport') }}</th><td>:</td><td>{{ $user->passport }}</td></tr>
                                        <tr><th>{{ trans('provider.department') }}</th><td>:</td><td>{{ $user->department }}</td></tr>
                                        {{--<tr><th>Flat</th><td>:</td><td>{{ $user->flat }}</td></tr>--}}
                                        <tr><th>{{ trans('provider.direction') }}</th><td>:</td><td>{{ $user->direction }}</td></tr>
                                        {{--<tr><th>Address</th><td>:</td><td>{{ $user->address }}</td></tr>--}}
                                        <tr><th>{{ trans('provider.district') }}</th><td>:</td><td>{{ $user->district }}</td></tr>
                                        <tr><th>{{ trans('provider.city') }}</th><td>:</td><td>{{ $user->city }}</td></tr>
                                        <tr><th>{{ trans('provider.province') }}</th><td>:</td><td>{{ $user->province }}</td></tr>
                                    </table>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ URL::route('add-phone',$user->id) }}" class="btn btn-info btn-blue btn-xs tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-phone"></i> {{ trans('provider.add_phone') }}</a>
                                    <table class="table bg-primary">
                                        <tr>
                                            <th class="text-center" colspan="2">{{ trans('provider.contact_numbers') }}</th>
                                        </tr>
                                        <?php if(count($user['relPhoneNumber']) > 0) { ?>
                                        {{--@if()--}}
                                            @foreach($user['relPhoneNumber'] as $phoneNumber)
                                                <tr>
                                                    <td>{{ $phoneNumber->number }}</td>
                                                    <td>
                                                        <a href="{{ url('user/edit_phone/'.$phoneNumber->id) }}" class="btn btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
                                                        <a onclick="return confirm('Are you confirm to delete this phone number ?')" href="{{ url('user/delete_phone/'.$phoneNumber->id) }}" class="btn btn-sm" title="Delete"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            {{--@enfif--}}
                                        <?php } ?>
                                    </table>

                                    {{--@if($user->type != 'admin')--}}
                                        <a href="{{ URL::route('add-bank',$user->id) }}" class="btn btn-info btn-blue btn-xs tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-institution"></i> {{ trans('provider.add_bank') }}</a>
                                        <table class="table bg-warning">
                                            <tr>
                                                <th>{{ trans('provider.bank_name') }}</th>
                                                <th>{{ trans('provider.account_number') }}</th>
                                                <th>{{ trans('provider.action') }}</th>
                                            </tr>
                                            @if(count($user['relBankAccount'])>0)
                                                @foreach($user['relBankAccount'] as $bankAccount)
                                                    <tr>
                                                        <td>{{ $bankAccount->name.' ('.$bankAccount->account_type.')' }} </td>
                                                        <td>{{ $bankAccount->account_number }}</td>
                                                        <td>
                                                            <a href="{{ url('user/edit_bank/'.$bankAccount->id) }}" class="btn btn-sm"><i class="fa fa-pencil"></i></a>
                                                            <a onclick="return confirm('Are you confirm to delete this bank account ?')" href="{{ url('user/delete_bank/'.$bankAccount->id) }}" class="btn btn-sm"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </table>
                                        @if($user['type']=='client')
                                            @if(count($user['relClient'])>0)
                                                <a href="{{ URL::route('add-additional-info',$user->id) }}" class="btn btn-info btn-blue btn-xs tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i> {{ trans('provider.additional_info') }}</a>
                                                <table class="table bg-info">
                                                    <tr>
                                                        <th>{{ trans('provider.date_of_inscription') }}</th>
                                                        <td>{{ $user['relClient']->date_of_inscription }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.blog_comments') }}</th>
                                                        <td>{{ $user['relClient']->blog_comments }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.experience_review') }}</th>
                                                        <td>{{ $user['relClient']->experience_review }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.amount_of_purchase') }}</th>
                                                        <td>{{ $user['relClient']->amount_of_purchase }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @elseif($user['type']=='provider' && !empty($user['relProvider']))
                                            @if(count($user['relProvider'])>0)
                                                <a href="{{ URL::route('add-additional-info',$user->id) }}" class="btn btn-info btn-blue btn-xs tooltips" data-placement="top" data-original-title="Edit"><i class="fa fa-edit"></i> {{ trans('provider.additional_info') }}</a>

                                                <table class="table bg-info">
                                                    <tr>
                                                        <th colspan="2" class="text-center">{{ trans('provider.additional_info') }}</th>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.vat_number') }}</th>
                                                        <td>{{ $user['relProvider']->vat_number }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.in_charge') }}</th>
                                                        <td>{{ $user['relProvider']->incharge }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.date_of_closing_contact') }}</th>
                                                        <td>{{ $user['relProvider']->contact_expire_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>{{ trans('provider.contact_valid_until') }}</th>
                                                        <td>{{ $user['relProvider']->contact_valid_until }}</td>
                                                    </tr>
                                                </table>
                                            @endif
                                        @endif
                                    {{--@endif--}}
                                    <table class="table bg-danger">
                                        <tr><th width="20%">{{ trans('provider.registration') }}</th><td width="1%">:</td><td width="79%">{{ $user->created_at }}</td></tr>
                                        <tr><th>{{ trans('provider.last_update') }}</th><td>:</td><td>{{ $user->updated_at }}</td></tr>
                                        <tr><th>{{ trans('provider.last_login') }}</th><td>:</td><td>{{ $user->last_login }}</td></tr>
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
