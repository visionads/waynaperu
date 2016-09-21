@section('sidebar')      
<div id="wrapper">        
	<!-- Sidebar -->         
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">         
		<span class="glyphicon glyphicon-menu-left"></span>
		<span class="glyphicon glyphicon-menu-right"></span>
	</a>         
	<div id="sidebar-wrapper">
	    <form action="{{ route('filter') }}" method="get" id="filter_form">            
	    <ul class="sidebar-nav filtro">               
		    <h2 class="sidebar-brand">{{ trans('text.filter') }}</h2>               
		    <li role="presentation" class="dropdown p-r">                  
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">                  
				    <span class="pr">                     
				    @if(Input::has('min-price'))                     
				   		                     
					    @if(Input::has('max-price')) 
					     @if(Input::get('max-price') == 'above')
					     {{ trans('text.above') }}   S/. {{ Input::get('min-price')}}
					     @else                       
					     S/. {{ Input::get('min-price')}}   	- {{ Input::get('max-price') }}   
					     @endif
					    @else                           
					    	{{ trans('text.above') }}   S/. {{ Input::get('min-price')}}                       
					    @endif                     
				    @else                     
				    	{{ trans('text.price') }}                     
				    @endif                     
	    			</span> 
	    			<input type="hidden"<?php if(Input::has('min-price')){?> name="min-price"<?php }?> id="min-price" value="<?php if(Input::has('min-price')){ echo Input::get('min-price');}?>">
	    			<input type="hidden"<?php if(Input::has('max-price')){?> name="max-price"<?php }?> id="max-price" value="<?php if(Input::has('max-price')){ echo Input::get('max-price');}?>">
	    			<span class="glyphicon glyphicon-triangle-bottom"></span>
	    		</a>                  
	    		<ul class="dropdown-menu price-range">                     
		    		<li data-minprice="0" data-maxprice="79">S/.0-79</li>                     
		    		<li data-minprice="80"  data-maxprice="199">S/.80-199</li>               
		    		<li data-minprice="200" data-maxprice="499">S/.200-499</li>
		    		<li data-minprice="500" data-maxprice="">{{ trans('text.above') }} S/.500 </li>                  
	    		</ul>               
	    	</li>               
	    	<li role="presentation" class="dropdown tags">                  
	    		<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">                 
		    		<span class="tag">                     
			    		@if(Input::has('tag'))                       
			    			{{ trans('text.for_whom_'.Input::get('tag')) }}                     
			    		@else                        
			    			 {{ trans('text.for_whom') }}                     
			    		@endif                     
		    		</span> 
		    		<input type="hidden"<?php if(Input::has('tag')){?> name="tag"<?php }?> id="tag" value="<?php if(Input::has('tag')){ echo Input::get('tag');}?>">
		    		<span class="glyphicon glyphicon-triangle-bottom"></span>    
	    		</a>                  
	    		<ul class="dropdown-menu tags">                     
		            <li data-tag="all">{{ trans('text.for_whom_all') }}</li>
		            <li data-tag="men">{{ trans('text.for_whom_men') }}</li>
		            <li data-tag="women">{{ trans('text.for_whom_women') }}</li>
		            <li data-tag="children">{{ trans('text.for_whom_children') }}</li>
		            <li data-tag="couples">{{ trans('text.for_whom_couples') }}</li>
		            <li data-tag="groups">{{ trans('text.for_whom_groups') }}</li>
	    		</ul>               
	    	</li>               
	    	<li role="presentation" class="dropdown cats">                  
	    		<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">                  
		    		<span class="cat">                     
			    		@if(Input::has('category'))                        
			    			{{ getCatName(Input::get('category'))}}                     
			    		@else                        
			    			{{ trans('text.categories') }}                     
			    		@endif                     
		    		</span>  
		    		<input type="hidden"<?php if(Input::has('category')){?> name="category"<?php }?> id="category" value="<?php if(Input::has('category')){ echo Input::get('category');}?>">
		    		<span class="glyphicon glyphicon-triangle-bottom"></span>  
	    		</a>                  
	    		<ul class="dropdown-menu categoriess">                      
		    		@foreach($categories as $category)                        
		    			<li data-catid="{{ $category->cat_id }}"> {{ $category->title }}</li>   
		    		@endforeach                  
	    		</ul>               
	    	</li>               
	    	<li role="presentation" class="dropdown distts">                  
	    	<a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">                  
		    	<span class="distt">                      
			    	@if(Input::has('disttid'))                        
			    		{{ getDisttName(Input::get('disttid'))}}                     
			    	@else                        
			    		{{ trans('text.district') }}                     
			    	@endif                     
		    	</span>  
		    	<input type="hidden" <?php if(Input::has('disttid')){?> name="disttid"<?php }?> id="disttid" value="<?php if(Input::has('disttid')){ echo Input::get('disttid');}?>">
		    	<span class="glyphicon glyphicon-triangle-bottom"></span>  
	    	</a>                  
	    	<ul class="dropdown-menu distt">                      
		    	@foreach($districts as $district)                        
		    		<li data-disttid="{{ $district->id }}"> {{ $district->name }}</li>
		    	@endforeach                  
	    	</ul>               
	    </li>            
	</ul>            
	</form>            
	<!--filtro menu end here-->            
	<ul class="categories">               
		<h2 class="sidebar-brand"> {{ trans('text.categories') }}</h2>               
		@foreach($categories as $category)               
		<li>                  
			<a href="{{ route('category', array($category->cat_id)) }}">                   
				<span class="gas" style="background-image:url({{ asset('uploads/categories/'.$category->icon) }})"></span>                   
				<em>{{ $category->title }}</em>                 
			</a>               
		</li>               
		@endforeach            
	</ul>            
	<ul class="sidebar-nav esp">               
		<li class="sidebar-brand">{{ trans('text.specials') }}</li>
		<li><a href="{{ route('special', array('for_two')) }}">{{ trans('text.specials_for_two') }}</a></li>
		<li><a href="{{ route('special', array('best_seller')) }}">{{ trans('text.specials_best_seller') }}</a></li>               
		<li><a href="{{ route('special', array('with_discount')) }}">{{ trans('text.specials_with_discount') }}</a></li>               
		<li><a href="{{ route('special', array('new')) }}">{{ trans('text.specials_new') }}</a> </li>            
		</ul>        
		</div>         
		<!-- /#sidebar-wrapper -->
@stop
