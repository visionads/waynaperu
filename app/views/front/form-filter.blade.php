<div class="clearix">
    <div class="text-left">
        <form action="{{ route('filter') }}" method="get" id="filter_form">
            <ul class="sidebar-nav filtro" style="text-align: center;">
                <h2>
                    <div class="fltr-header">
                        <span>{{ trans('text.filter') }}</span>
                    </div>
                </h2>
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

                    @if(isset($categories))
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
                        <input type="hidden" <?php if(Input::has('disttid')){?> name="disttid"<?php }?> id="disttid" value="<?php if(Input::has('disttid')){ echo Input::get('disttid');}?>">
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
                <li role="presentation" class="dropdown p-r">                  
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                        <span class="pr">
                        @if(Input::has('min-price'))
                            @if(Input::has('max-price'))
                             @if(Input::get('max-price') == 'above')
                             {{ trans('text.above') }}   S/. {{ Input::get('min-price')}}
                             @else
                             S/. {{ Input::get('min-price')}}       - {{ Input::get('max-price') }}   
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
            </ul>
        </form>
    </div>
</div>