<?php if(!isset($classes)){$classes='col-lg-3 col-md-3 col-sm-4 col-4';}?>

<div class="{{$classes}} mb-4">
    <?php 
       $typeid=$product->slug;
       
       $hw = App\Models\wishlist::where('product_id', $product->id)->where('user_id', auth()->id())->first();
       $is_wishlist_active = $hw ? true : false;
       
       if ($product->reviews->count() > 0) {
           $average_rating = $product->reviews->sum('rating') / $product->reviews->count();
       } else {
           $average_rating = 0;
       }
    ?>

    <style>
        .corp-card-{{$product->id}} {
            background: #ffffff;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
            position: relative;
            display: flex;
            flex-direction: column;
            height: 100%;
            min-height: 280px;
        }
        .corp-card-{{$product->id}}:hover {
            box-shadow: 0 8px 16px rgba(0,0,0,0.06);
            transform: translateY(-4px);
            border-color: #e2e8f0;
        }
        .corp-card-{{$product->id}} .corp-thumb {
            position: relative;
            width: 100%;
            height: 170px;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 8px;
        }
        .corp-card-{{$product->id}} .corp-thumb img {
            max-height: 100%;
            max-width: 100%;
            object-fit: contain;
            transition: transform 0.4s ease;
        }
        .corp-card-{{$product->id}}:hover .corp-thumb img {
            transform: scale(1.03);
        }
        .corp-card-{{$product->id}} .corp-badge {
            position: absolute;
            top: 8px;
            left: 8px;
            background: #e11d48;
            color: #fff;
            font-size: 10px;
            font-weight: 600;
            padding: 3px 6px;
            border-radius: 4px;
            z-index: 2;
        }
        .corp-card-{{$product->id}} .corp-details {
            padding: 10px 12px;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            border-top: 1px solid #f8f9fa;
        }
        .corp-card-{{$product->id}} .corp-title {
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            margin-bottom: 6px;
            line-height: 1.3;
            height: 34px;
            overflow: hidden;
            text-decoration: none;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            transition: color 0.2s;
        }
        .corp-card-{{$product->id}} .corp-title:hover {
            color: var(--primary_color, #0ea5e9);
        }
        .corp-card-{{$product->id}} .corp-price-wrap {
            margin-bottom: 6px;
            display: flex;
            align-items: baseline;
            gap: 6px;
        }
        .corp-card-{{$product->id}} .corp-price {
            font-size: 15px;
            font-weight: 700;
            color: #0f172a;
        }
        .corp-card-{{$product->id}} .corp-price-old {
            font-size: 12px;
            color: #94a3b8;
            text-decoration: line-through;
        }
        .corp-card-{{$product->id}} .corp-rating {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-bottom: 6px;
            color: #f59e0b;
            font-size: 10px;
        }
        .corp-card-{{$product->id}} .corp-rating .far {
            color: #cbd5e1;
        }
        .corp-card-{{$product->id}} .corp-actions {
            display: flex;
            gap: 8px;
            margin-top: auto;
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
        .corp-card-{{$product->id}}:hover .corp-actions {
            opacity: 1;
            transform: translateY(0);
        }
        @media (max-width: 991px) {
            .corp-card-{{$product->id}} .corp-actions {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .corp-card-{{$product->id}} .corp-btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 42px;
            padding: 0 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: 1px solid #e2e8f0;
            background: #fff;
            color: #475569;
            text-decoration: none;
        }
        .corp-card-{{$product->id}} .corp-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .corp-card-{{$product->id}} .corp-btn-cart {
            background: var(--primary_color, #0f172a);
            color: #fff;
            border-color: transparent;
        }
        .corp-card-{{$product->id}} .corp-btn-cart:hover {
            background: #1e293b;
            color: #fff;
            border-color: transparent;
        }
        .corp-card-{{$product->id}} .corp-btn-cart.pre-order {
            background: #ef4444;
        }
        .corp-card-{{$product->id}} .corp-btn-wish {
            flex: 0 0 auto;
            width: 42px;
            padding: 0;
            background: transparent !important;
            border: transparent !important;
            font-size: 20px;
        }
        .corp-card-{{$product->id}} .corp-btn-wish.active {
            color: #e11d48;
        }
        .corp-card-{{$product->id}} .corp-btn-wish:hover {
            color: #e11d48;
        }
        .corp-card-{{$product->id}} .corp-quick-view {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            background: rgba(255,255,255,0.95);
            color: #334155;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 500;
            opacity: 0;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            z-index: 3;
        }
        .corp-card-{{$product->id}} .corp-thumb:hover .corp-quick-view {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        .corp-card-{{$product->id}} .corp-quick-view:hover {
            background: var(--primary_color, #0f172a);
            color: #fff;
        }
        .corp-card-{{$product->id}} .corp-extra-msg {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
        }
    </style>

    <div class="corp-card-{{$product->id}}">
        <div class="corp-thumb">
            @if($product->discount_price > 0)
                @if($product->dis_type == '2')
                    @php($discount_text = round((($product->regular_price - $product->discount_price) / $product->regular_price) * 100).'% OFF')
                @else
                    @php($currency_icon = setting('CURRENCY_ICON') ? setting('CURRENCY_ICON') : '৳')
                    @php($discount_text = $currency_icon . ($product->regular_price - $product->discount_price) . ' OFF')
                @endif
                <div class="corp-badge">{{ $discount_text }}</div>
            @endif
            
            <a href="{{route('product.details', $product->slug)}}">
                <img src="{{asset('uploads/product/'.$product->image)}}" alt="Product Image">
            </a>
            
            <a href="{{route('product.details', $product->slug)}}" class="corp-quick-view">
                <i class="icofont icofont-search"></i> Quick View
            </a>
        </div>
        
        <div class="corp-details">
            <div class="corp-rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($average_rating))
                        <i class="fas fa-star"></i>
                    @elseif($i - 0.5 == $average_rating)
                        <i class="fas fa-star-half-alt"></i>
                    @else
                        <i class="far fa-star"></i>
                    @endif
                @endfor
            </div>
            
            <a href="{{route('product.details', $product->slug)}}" class="corp-title">
                {{implode(' ', array_slice(explode(' ', $product->title), 0, 10))}}...
            </a>
            
            <div class="corp-price-wrap">
                @if($product->discount_price > 0 || $product->price)
                    <div class="corp-price" style="color: var(--primary_color)">{{ setting('CURRENCY_ICON') ?? '৳' }}{{ $product->price ?? $product->discount_price }}</div>
                    <div class="corp-price-old">{{ setting('CURRENCY_ICON') ?? '৳' }}{{ $product->regular_price }}</div>
                @else
                    <div class="corp-price" style="color: var(--primary_color)">{{ setting('CURRENCY_ICON') ?? '৳' }}{{ $product->regular_price }}</div>
                @endif
            </div>

            @if ($product->prdct_extra_msg)
                <div class="corp-extra-msg">{{ $product->prdct_extra_msg }}</div>
            @endif

            <div class="corp-actions">
                @if($product->quantity <= '0')
                    <a href="{{route('product.details', $product->slug)}}" class="corp-btn corp-btn-cart pre-order">
                        Pre Order
                    </a>
                @else
                    @if($product->sheba != 1)
                        <button type="button" class="corp-btn corp-btn-cart redirect" data-url="{{route('product.info', $product->slug)}}" id="productInfo" title="Add To Cart">
                            <i class="fal fa-shopping-cart"></i> Add to Cart
                        </button>
                    @endif
                @endif
                
                <form action="{{route('wishlist.add')}}" method="post" id="submit_payment_form{{$typeid}}" style="margin:0;">
                    @csrf
                    <input type="hidden" name="product_id" value="{{$product->slug}}"> 
                    <button type="submit" class="corp-btn corp-btn-wish redirect {{ $is_wishlist_active ? 'active' : '' }}" title="Wishlist">
                        <i class="{{ $is_wishlist_active ? 'fas' : 'fal' }} fa-heart"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('js')
<script>
    // form submit 
    $(document).on('submit', '#submit_payment_form{{$typeid}}', function(e) {
            e.preventDefault();
            
            let action   = $(this).attr('action');
            var formData = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                dataType: "JSON",
                beforeSend: function() {
                    loader(true);
                },
                success: function (response) {
                    responseMessage(response.alert, response.message, response.alert.toLowerCase())
                },
                complete: function() {
                    loader(false);
                },
                error: function (xhr) {
                    if (xhr.status == 422) {
                        if (typeof(xhr.responseJSON.errors) !== 'undefined') {
                            
                            $.each(xhr.responseJSON.errors, function (key, error) { 
                                $('small.'+key+'').text(error);
                                $('#'+key+'').addClass('is-invalid');
                            });
                            responseMessage('Error', xhr.responseJSON.message, 'error')
                        }

                    }else  if (xhr.status == 401) {
                         alert('please login');
                         window.location = '/login';

                    }  else {
                        responseMessage(xhr.status, xhr.statusText, 'error')
                    }
                }
            });
        });

        // response message hande
        if (typeof responseMessage !== 'function') {
            function responseMessage(heading, message, icon) {
                $.toast({
                    heading: heading,
                    text: message,
                    icon: icon,
                    position: 'top-right',
                    stack: false
                });
            }
        }

        // loader handle this function
        if (typeof loader !== 'function') {
            function loader(status) {
                if (status == true) {
                    $('#loading-image').removeClass('d-none').addClass('d-block');

                } else {
                    $('#loading-image').addClass('d-none').removeClass('d-block');
                }
            }
        }
</script>
@endpush