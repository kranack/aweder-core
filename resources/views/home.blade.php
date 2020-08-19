@extends('global.app')
@section('content')
    <section class="hero background-ecru-white-3 margin-bottom-80 l-margin-bottom-60">
        <div class="row">
            <div class="content align-items-center">
                <header class="hero__header col-span-6 col-start-2 l-col-start-1 m-col-span-7 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 s-text-center">
                    <h1 class="header-one color-carnation">Quickly move your business to accepting online orders for pickup or delivery.</h1>
                </header>
                <div class="hero__copy col-span-4 col-start-2 l-col-span-5 l-col-start-1 m-col-span-6 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 margin-top-40 sm-margin-top-60 s-text-center">
                    <p class="body-xlarge color-carnation">Simple online order taking for small businesses with payment acceptance and pickup / delivery confirmation.</p>
                </div>
                <div class="hero__image col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-4 m-col-start-9 sm-col-start-2 row-span-2 row-start-1 sm-row-start-2 sm-row-span-1 sm-margin-top-60">
                    <span class="icon icon--logo-mark">
                        @svg('aweder-logo-small')
                    </span>
                </div>
            </div>
        </div>
    </section>
    <section class="feature">
        <div class="row">
            <div class="content align-items-center">
                <header class="feature__header col-span-5 col-start-7 m-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 sm-row-start-1">
                    <h2 class="header-two color-carnation">Simple and seamless</h2>
                </header>
                <div class="feature__copy col-span-5 col-start-7 m-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 sm-row-start-3">
                    <p>In this time of uncertainty during the Covid-19 outbreak, we want to help as many small businesses such as Restaurants, Pubs, Cafes and Retailers survive. Pivoting your business to a takeaway or remote service model can be daunting the Awe-der platform is here to make this as simple and seamless as possible without incurring unnecessary expense.</p>
                </div>
                <div class="feature__buttons col-span-5 col-start-7 m-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 sm-row-span-1 sm-row-start-4">
                    <a href="{{route('about.how-it-works')}}" class="button button-outline--carnation">
                        <span class="button__content">How it works</span>
                    </a>
                </div>
                <div class="feature__image col-span-4 col-start-2 l-col-span-5 l-col-start-1 sm-col-span-4 sm-col-start-2 row-span-3 row-start-1 sm-row-span-1 sm-row-start-2">
                    <img src="images/simple-menu.png" alt="awe-der menu" class="width-full" />
                </div>
            </div>
        </div>
    </section>
    <section class="feature">
        <div class="row">
            <div class="content align-items-center">
                <header class="feature__header col-span-5 col-start-2 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <h2 class="header-two color-carnation">We&acute;re here to help you</h2>
                </header>
                <div class="feature__copy col-span-5 col-start-2 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <p>At Awe-der we want to get you up and running online as soon as possible, allowing your business to focus on supporting the community in these uncertain times. Here are some of the features we can offer:</p>
                    <ul class="feature__list">
                        <li class="feature__list-item">
                            <span>Menu / Product listing</span>
                            Quickly add your products with descriptions and prices.
                        </li>
                        <li class="feature__list-item">
                            <span>Order acceptance and pickup timing confirmation</span>
                            View and accept incoming orders from your dashboard.
                        </li>
                        <li class="feature__list-item">
                            <span>Online payment integration</span>
                            Support for Stripe to quickly and securely take online payments at the point of order.
                        </li>
                        <li class="feature__list-item">
                            <span>Instant on-boarding and setup for businesses</span>
                            Setup your online store with ease and start selling!
                        </li>
                    </ul>
                </div>
                <div class="feature__buttons col-span-5 col-start-2 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <a href="{{route('register')}}" class="button button-solid--carnation">
                        <span class="button__content">Get started with Awe-der</span>
                    </a>
                </div>
                <div class="feature__image col-span-4 col-start-8 l-col-span-5 sm-col-span-4 sm-col-start-2 row-span-3 row-start-1 sm-row-span-1 sm-row-start-2">
                    <img src="images/dashboard-benefits.png" alt="orders" class="width-full" />
                </div>
            </div>
        </div>
    </section>
@endsection
