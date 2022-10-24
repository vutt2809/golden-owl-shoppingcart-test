<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GoldenOwl Sneaker</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;900&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body class="antialiased">
        <div class="app">
            <div class="main-content">
                <div class="card">
                    <div class="card-top">
                        <img src="{{ asset('images/nike.png') }}" alt="" class="card-logo">
                    </div>
                    <div class="card-title">
                        Our products
                    </div>
                    <div class="card-body">
                        <div class="list-shoes">
                            @foreach ($shoes as $shoe)
                            <div class="shoe-item">
                                <div class="shoe-image" style="background-color: {{ $shoe['color']}}">
                                    <img src="{{ $shoe['image'] }}" alt="">
                                </div>
                                <div class="shoe-name">{{ $shoe['name'] }}</div>
                                <div class="shoe-description">
                                    {{ $shoe['description'] }}
                                </div>
                                <div class="shoe-action">
                                    <div class="shoe-price">${{ $shoe['price'] }}</div>
                                    @if (!isset($shoe['incart']))
                                        <a href="{{ route('cart.add', $shoe['id']) }}" class="shoe-btn btn-add-to-cart">Add to cart</a>                                       
                                    @else
                                        <div class="shoe-check">
                                            <img src="{{ asset('images/check.png') }}" alt="">                              
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-top">
                        <img src="{{ asset('images/nike.png') }}" alt="" class="card-logo">
                    </div>
                    <div class="card-title">
                        Your cart
                        <p class="cart-total">${{number_format($total, 2, '.', '.')}}</p>
                    </div>
                    <div class="card-body">
                        <div class="list-shoes">
                            @if ($cart)
                                @foreach ($cart as $key => $cartItem)
                                <div class="cart-item">
                                    <input type="hidden" name="id" value="{{ $key }}">
                                    <div class="cart-image" style="background-color: {{ $cartItem['color']}}">
                                        <img src="{{ $cartItem['image'] }}" alt="">
                                    </div>
                                    <div class="cart-info">
                                        <div class="cart-name">{{ $cartItem['name'] }}</div>
                                        <div class="cart-price">${{ $cartItem['price'] }}</div>
                                        <div class="cart-action">
                                            <div class="cart-action-left">
                                                <div class="cart-action-btn">
                                                    <a href="{{ route('cart.decrease', $key) }}" class="btn-increase">
                                                        <img src="{{ asset('images/minus.png') }}" alt="">
                                                    </a>
                                                </div>
                                                
                                                <span class="cart-number"> {{ $cartItem['quantity'] }}</span>
                                                
                                                <div class="cart-action-btn">
                                                    <a href="{{ route('cart.increase', $key) }}" class="btn-decrease" ">
                                                        <img src="{{ asset('images/plus.png') }}" alt="">
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="cart-action-right cart-action-btn">
                                                <a href="{{ route('cart.remove', $key) }}" class="btn-remove">
                                                    <img src="{{ asset('images/trash.png') }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else 
                                <div class="cart-empty">Your cart is empty.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>

        // $(document).ready(function() {
        //     $('.btn-remove').click(function (e) {
        //         e.preventDefault();

        //         let shoeId = $('input[name="id"]').val();
                
        //         $.ajax({
        //             type: 'GET',
        //             url: '/cart/remove/' + shoeId,
        //             data: {
        //                 id: shoeId
        //             },
        //             success: (data) => {
                        
        //             }
        //         });
        //     })
        // })
    </script>
</html>
