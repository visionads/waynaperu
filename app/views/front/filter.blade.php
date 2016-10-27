@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')         
<!-- Page Content -->         
<div id="page-content-wrapper">
	<div class="container-fluid">
		<div class="page_paggination">
			<ol class="breadcrumb">
				<li><a href="{{ route('home') }}" title="Home">{{ trans('text.home') }}</a></li>
				<li class="active">{{ trans('text.filter')}}</li>
			</ol>
		</div>
		<br>
        <div class="row">
            @include('front.form-filter')
        </div>
        <br>
 		<!-- Filter -->
		<div class="como-toggle">               
			<ul class="categories">                     
				<h2 class="sidebar-brand"> {{ trans('text.categories') }}</h2>                     
				@if(count($categories)>0)
					@foreach($categories as $category)
					<li>
						<span class="gas" style="background-image:url({{ asset('uploads/categories/'.$category->icon) }})"></span>
						<a href="#">{{ $category->title }}</a>
					</li>
					@endforeach
				@endif
			</ul>               
		</div>
		<!-- catory grid-->               
		<div class="bloque">                  
			<div class="row">                  	
				@include('front._productList')
			</div><!--bloque end here-->
		</div>
	</div>
</div>
@stop
