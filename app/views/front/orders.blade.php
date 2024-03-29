@extends('front.layout')
@extends('front.header')
@extends('front.sidebar')
@extends('front.footer')
@section('content')

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <div class="tab_wrapper">
                <div class="page_paggination">
                    <div class="row">
                        <div class="col-md-12">
                            <ol class="breadcrumb">
                                <li><a href="{{ route('home') }}" title="Home">{{trans('text.home')}}</a></li>
                                <li class="active">{{trans('text.profile')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <h4 class="title2">{{ trans('text.orders') }}</h4>

                <div class="tabs_inner_wrapper">

                    <div class="tab_content_main">
                        <div class="row custom_bg">
                            <div class="col-md-12">

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">

                                        <!-- tab content -->
                                        <table class="table table-striped table-hover" id="sample-table-2">
                                            <thead>
                                            <tr>

                                                <th class="hidden-xs">{{ trans('provider.order_number') }}</th>
                                                <th class="hidden-xs">{{ trans('provider.order_status') }}</th>
                                                <th class="hidden-xs">{{ trans('provider.order_price') }}</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $lang_count	= count($orders);
                                            ?>
                                            @if($lang_count > 0)
                                                @foreach ($orders as $order)
                                                    <tr>

                                                        <td><a href="{{ URL::to('order',$order->id) }}">{{ isset($order->order_number) ? $order->order_number : null }}</a></td>
                                                        <td>{{ isset($order->status) ? $order->status : null }}</td>
                                                        <td>s./ <?php echo number_format($order->price,2); ?></td>

                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td>
                                                        <div>No Order found</div>
                                                    </td>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                        {{ $orders->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->
@stop
