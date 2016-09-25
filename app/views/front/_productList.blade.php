@foreach($products as $product)
    <!--<div class="col-xs-12 col-sm-3 col-md-3">-->
    <div class="item-grid">
        <a href="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($product->product_title), $product->product_id)) }}" title="{{ $product->product_title }}">
            <div class="bloque-box">
                <div class="bloque-image" style="position: relative">
                    <?php
                    $profit = 0;
                    $old = getLocPrice2Fresh($product->product_id);
                    //$old = 50;
                    $new = getLocPriceFresh($product->product_id);
                    $diff = $old - $new;
                    if($old != 0){
                        $profit = (($old-$new)*100)/$old;
                    }
                    ?>
                    <img src="{{ asset('uploads/products/'.$product->image) }}" alt="Exploor" class="img-responsive">
                    @if(isset($profit) != 0)
                        @if($profit != 0)
                            <div class="profit-price">{{ number_format($profit,2) }}%</div>
                        @endif
                    @endif

                </div>
                <div class="bloque-caption">
                    <span class="icon" @if(getProIcon($product->product_id) !='') style="background-image:url({{ asset('uploads/categories/'.getProIcon($product->product_id)) }})"@endif>&nbsp; </span>
                    <div class="bloque-caption-text">
                        <h2>{{ str_limit($product->product_title, $limit = 25, $end = '...') }}</h2>
                        <span class="bdr"></span>
                        <div class="clearfix"></div>
                        <p>{{ str_limit($product->mini_description, $limit = 40, $end = '...') }}</p>
                    </div>
                </div>
                <div class="desed">
                    <p class="price-old">{{ getLocPrice2($product->product_id) }}</p>
                    <p class="price">{{ getLocPrice($product->product_id) }}</p>
                    <p class="location"><span><img src="{{ asset('images/icon/location.png') }}" alt="location"></span>
                        {{ getLocCount($product->product_id) }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@endforeach