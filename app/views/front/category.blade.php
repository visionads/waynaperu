@extends('front.layout')
@extends('front.header')
@extends('front.footer')
@section('content')         
<!-- Page Content -->        
<div id="page-content-wrapper">           
   <div class="container-fluid"> 
       <!-- Filter -->
  <div class="mobile_filter">
  <form action="{{ route('filter') }}" method="get" id="filter_form">
    <ul class="sidebar-nav filtro">
        <h2 class="sidebar-brand">{{ trans('text.filter') }}</h2>
        <li role="presentation" class="dropdown p-r">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span class="pr">
              @if(Input::has('min-price'))
                S/.{{ Input::get('min-price')}}
                @if(Input::has('max-price'))
                  - {{ Input::get('max-price') }}
                @else
                  Above
                @endif
              @else
                {{ trans('text.price') }}
              @endif                     
            </span>
            <input type="hidden" <?php if(Input::has('min-price')){?> name="min-price" <?php }?> id="min-price" value="<?php if(Input::has('min-price')){ echo Input::get('min-price');}?>">
            <input type="hidden" <?php if(Input::has('max-price')){?> name="max-price"
                <?php }?> id="max-price" value="<?php if(Input::has('max-price')){ echo Input::get('max-price');}?>">
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
                <input type="hidden"
                    <?php if(Input::has('tag')){?> name="tag"
                    <?php }?> id="tag" value="
                    <?php if(Input::has('tag')){ echo Input::get('tag');}?>">
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
              <input type="hidden"
                  <?php if(Input::has('category')){?> name="category"
                  <?php }?> id="category" value="
                  <?php if(Input::has('category')){ echo Input::get('category');}?>">
                  <span class="glyphicon glyphicon-triangle-bottom"></span>
          </a>
          <ul class="dropdown-menu categoriess">
            @if(count($categories)>0)
                @foreach($categories as $category)
                  <li data-catid="{{ $category->cat_id }}"> {{ $category->title }}</li>
                @endforeach
            @endif
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
                    <input type="hidden" 
                        <?php if(Input::has('disttid')){?> name="disttid"
                        <?php }?> id="disttid" value="
                        <?php if(Input::has('disttid')){ echo Input::get('disttid');}?>">
                        <span class="glyphicon glyphicon-triangle-bottom"></span>
            </a>
            <ul class="dropdown-menu distt">                      
                @if(count($districts)>0)
                    @foreach($districts as $district)
                      <li data-disttid="{{ $district->id }}"> {{ $district->name }}</li>
                    @endforeach
                @endif
            </ul>
        </li>
        </ul>
    </form>
    </div>
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
          
          <div class="caategory-p-wrapper row">
              <div class="col-md-12 col-sm-12">
                <div class="page_paggination">                  
                  <div class="row">                      
                    <div class="col-md-12">                           
                      <ol class="breadcrumb">                              
                        <li><a href="{{ route('home') }}" title="Home">{{ trans('text.home') }}</a></li>
                        <li class="active">{{ trans('text.category')}}</li>                           
                      </ol>                      
                    </div>                  
                  </div>              
                </div><!--como end here-->               
                <!-- catory grid-->               
                <div class="bloque">                 
                  <div class="row">                      
                    <div class="col-lg-12 col-sm-12">                        
                      <div class="cat-title">                           
                        <h1>{{ isset($cat->title) ? $cat->title : null }}</h1>
                      </div>                        
                    </div>                       
                
                    <div class="cat-description">                           
                      <div class="col-lg-7 col-sm-7">{{ isset($cat->description) ? $cat->description : null }}</div>
                      <div class="col-lg-5 col-sm-5">
                          <div class="cate_image_bdr">
                            @if(isset($cat->image))
                              <img src="{{ asset('uploads/categories/'.$cat->image) }}" alt="{{ $cat->title }}">
                            @endif
                          </div>
                       </div>
                    </div>                   
                  </div>                  
                                           
                 <div class="row">                     
                       <div class="col-lg-12 col-sm-12 cat-filters">                        
                           <div class="row span-15"> <div class="col-md-12"> <div class="price_filter-title">{{ trans('text.sort_by') }}:</div></div> </div>                       
                           <div class="price-filter">{{ trans('text.sort_by_price') }}
                               <span class="up-caret sort" data-sort="myorder:asc"></span> 
                               <span class="caret1 sort" data-sort="myorder:desc"></span>  
                           </div>                        
                           <div class="popular-filter">{{ trans('text.sort_by_popularity') }}  
                                <span class="caret1 sort" data-sort="myhits:desc"></span>  
                           </div>                     
                        </div>   
                  </div>
                 
                 <div class="row categoryy">
                        @include('front._productList')
                  </div><!--bloque end here-->            
              </div>
           </div>
       </div>        
</div>
@stop
