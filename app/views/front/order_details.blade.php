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


                <h4 class="title2">{{ trans('text.order_details') }}</h4>

                <div class="tabs_inner_wrapper">

                    <div class="tab_content_main">
                        <div class="row custom_bg">
                            <div class="col-md-12">

                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">

                                        <!-- tab content -->
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">Order</legend>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Order Number:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ $order->order_number }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="status" class="col-sm-12 col-md-4 control-label">Order Status:</label>
                                                        <div class="col-sm-12 col-md-8">

                                                            <strong style="line-height:42px;">{{ $order->status }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Total Qty:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">{{ $order->qty }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-sm-12 col-md-4 control-label">Total Price:</label>
                                                        <div class="col-sm-12 col-md-8">
                                                            <strong style="line-height:42px;">s./ <?php echo sprintf('%.2f', $order->price / 100); ?></strong>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">User</legend>
                                                    @if($order->user_id == NULL)
                                                        <p>This Order is by guest user and You can get his details on "Order Items" section.</p>
                                                    @else
                                                        <?php $user = getUserInfo($order->user_id);?>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">Name:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                @if($user->first_name != '' || $user->last_name != '' )
                                                                    <strong style="line-height:42px;">{{ $user->first_name }} {{ $user->last_name }}</strong>
                                                                @else
                                                                    <strong style="line-height:42px;">User didn't add his Name</strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">Email:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                <strong style="line-height:42px;">{{ $user->email }} </strong>
                                                            </div>
                                                        </div>
                                                        <div style="clear:both"></div>
                                                        <div class="form-group">
                                                            <label  class="col-sm-12 col-md-4 control-label">Address:</label>
                                                            <div class="col-sm-12 col-md-8">
                                                                @if($user->direction != '')
                                                                    <strong >#{{ $user->flat }}, {{ $user->direction }}<br/> {{ $user->city }}, {{ $user->district }}<br/>{{ $user->province }} </strong>
                                                                @else
                                                                    <strong style="line-height:42px;">User Didn't add his address. </strong>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif
                                                </fieldset>
                                            </div>
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <fieldset class="scheduler-border">
                                                    <legend class="scheduler-border">Order Items</legend>
                                                    @foreach($order_items as $item)
                                                        <div class="col-md-12 col-lg-12 col-sm-12">
                                                            <fieldset class="scheduler-border">
                                                                <legend class="scheduler-border">{{ getExpName($item->product_id) }} -<small>{{ getLocName($item->loc_id) }}</small></legend>
                                                                <div style="clear:both"></div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>PDF Qty:</strong> {{ $item->pdf_qty }}
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>PDF Price:</strong> s./ {{ $item->pdf_price }}
                                                                </div>
                                                                <div style="clear:both"></div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Mail Qty:</strong> {{ $item->mail_qty }}
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Mail Price:</strong> s./ {{ $item->mail_price }}
                                                                </div>
                                                                <div style="clear:both"></div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Gift Qty:</strong> {{ $item->gift_qty }}
                                                                </div>
                                                                <div class="col-md-6 col-lg-6 col-sm-12">
                                                                    <strong>Gift Price:</strong> s./ {{ $item->gift_price }}
                                                                </div>
                                                                <div class="col-md-12 col-lg-12 col-sm-12">
                                                                    <?php $details = json_decode($item->details);
                                                                    //  echo "<pre>";print_r($details);die;

                                                                    ?>
                                                                    @if(count($details)>0)
                                                                        @foreach($details as $key => $detail)
                                                                            <?php  //echo "<pre>";print_r($detail);die; ?>
                                                                            @if($key == 'pdf')
                                                                            <h6>PDF:</h6>
                                                                            @endif
                                                                            @if($key == 'mail')
                                                                            <h6>MAIL:</h6>
                                                                            @endif
                                                                            @if($key == 'gift')
                                                                            <h6>GIFT:</h6>
                                                                            @endif
                                                                            @foreach($detail as $k => $v)
                                                                            @if($key == 'pdf')
                                                                            <?php $count = 1; ?>
                                                                            @foreach($v as $i => $j)
                                                                                <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                                                                <?php $count++; ?>
                                                                            @endforeach
                                                                            <hr>
                                                                            @endif
                                                                            @if($key == 'mail')
                                                                                <?php $count = 1; ?>
                                                                                @foreach($v as $i => $j)
                                                                                    <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                                                                    <?php $count++; ?>
                                                                                @endforeach
                                                                                <hr>
                                                                            @endif
                                                                            @if($key == 'gift')
                                                                                <?php $count = 1; ?>
                                                                                @foreach($v as $i => $j)
                                                                                    <p>{{ $count }}. <strong>{{ $k }}:</strong> {{ $j }}</p>
                                                                                    <?php $count++; ?>
                                                                                @endforeach
                                                                                <hr>
                                                                            @endif
                                                                        @endforeach
                                                                        @endforeach
                                                                    @endif
                                                                </div>

                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                </fieldset>
                                            </div>
                                        </div>
                                        <a href="{{ URL::previous() }}" class="btn btn-warning">Back</a>

                                    </div>
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
