@foreach($products as $product)
    <!--<div class="col-xs-12 col-sm-3 col-md-3">-->
    <div class="item-grid">
        <a href="{{ route('category_experience_id', array(Str::slug($product->category_name), Str::slug($product->product_title), $product->product_id)) }}" title="{{ $product->product_title }}">
            <div class="bloque-box">
                <div class="bloque-image" style="position: relative">
                    <?php
                        $new_price = 0;
                        $discount=getLocPrice($product->product_id,'price3');
                        $adult_price = getLocPrice($product->product_id,'price1');
                        if($discount!='0.00'){
                            $price= $adult_price-(($adult_price/100)*$discount);
                            $new_price=makePrintablePrice($price);
                        }else{
                            $adult_price=makePrintablePrice($adult_price);
                        }
                    ?>
                    <img src="{{ asset('uploads/products/'.$product->image) }}" alt="Exploor" class="img-responsive">
                    @if(isset($discount) && $discount!=0.00)
                        <div class="profit-price">{{ number_format($discount,2) }}%</div>
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
                    @if(isset($discount) && $discount!=0.00)
                        <p class="price-old">{{ $adult_price }}</p>
                        <p class="price">{{ $new_price }}</p>
                    @else
                        <p class="price-old-null">&nbsp;</p>
                        <p class="price">{{ $adult_price }}</p>
                    @endif
                    <p class="location"><span><img src="{{ asset('images/icon/location.png') }}" alt="location"></span>
                        {{ getLocCount($product->product_id) }}
                    </p>
                </div>
            </div>
        </a>
    </div>
@endforeach