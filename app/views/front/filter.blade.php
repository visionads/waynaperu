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
				@foreach($categories as $category)		               
				<li>		                  
					<span class="gas" style="background-image:url({{ asset('uploads/categories/'.$category->icon) }})"></span>		
					<a href="#">{{ $category->title }}</a>		               
				</li>		               
				@endforeach                  
			</ul>               
		</div>
		<!-- catory grid-->               
		<div class="bloque">                  
			<div class="row">                  	
				@foreach($products as $product)                     
				<div class="item-grid">
					<a href="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($product->product_title), $product->product_id)) }}" title="{{ $product->product_title }}">
						<div class="bloque-box">                           
							<div class="bloque-image">
								<img src="{{ asset('uploads/products/'.$product->image) }}" alt="blog" class="img-responsive">
							</div>                           
							<div class="bloque-caption">                              
								<div class="desed">                                 
									<span>{{ trans('text.from') }}</span>
									<p class="price">{{ getLocPrice($product->product_id) }}</p>
									<p class="location"><span>
										<img src="{{ asset('images/icon/location.png') }}" alt="location"></span>{{ getLocCount($product->product_id) }}
									</p>                              
								</div>                              
								<span class="icon"  @if(getProIcon($product->product_id) !='') style="background-image:url({{ asset('uploads/categories/'.getProIcon($product->product_id)) }})"@endif>&nbsp;</span>
								<div class="bloque-caption-text">
									<h2>{{ str_limit($product->product_title, $limit = 25, $end = '...') }}</h2>
									<span class="bdr"></span>
									<div class="clearfix"></div>
									<p>{{ str_limit($product->mini_description, $limit = 50, $end = '...') }}</p>
								</div>                          
							</div>                        
						</div>                     
					</a>                     
				</div>                     
				@endforeach                  
			</div>               
		</div><!--bloque end here-->            
	</div>         
</div>
@stop
