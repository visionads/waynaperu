@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')         
<!-- Page Content -->         
<div id="page-content-wrapper">
    <div class="container-fluid">
        {{--<br>--}}
        <!--como end here-->
        <div class="como">
            <div class="row">
                <div class="heading col-md-12">
                    <h2>{{ $how_wayna_work->title }}</h2>
                </div>
                {{ $how_wayna_work->description }}                  
            </div>
        </div>        
        <div class="row">
            @include('front.form-filter')
        </div>
        <!-- catory grid--> 
        <div class="row clearfix">
            @include('front._productList')
        </div>
        <!--bloque end here-->

    </div>
</div>

@stop
