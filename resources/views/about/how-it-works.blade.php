@extends('global.app')
@section('content')
    <section class="steps width-full">
        <div class="steps__wrapper swiper-wrapper">
            <section class="steps__item swiper-slide">
                <div class="row">
                    <div class="content">
                        <div class="steps__col steps__col--content col-span-6">
                            <header class="steps__header col-span-5">
                                <h1 class="header-two">1. Simple signup process</h1>
                            </header>
                            <div class="steps__copy col-span-5">

                            </div>
                            <div class="steps__buttons col-span-6">

                            </div>
                        </div>
                        <div class="steps__col steps__col--image col-span-6 col-start-7">

                        </div>
                    </div>
                </div>
            </section>
            <section class="steps__item swiper-slide">
                <div class="row">
                    <div class="content">
                        <div class="steps__col steps__col--content col-span-6">
                            <header class="steps__header col-span-5">
                                <h2 class="header-two">2. Quick and easy ordering</h2>
                            </header>
                            <div class="steps__copy col-span-5">

                            </div>
                            <div class="steps__buttons col-span-6">

                            </div>
                        </div>
                        <div class="steps__col steps__col--image col-span-6 col-start-7">

                        </div>
                    </div>
                </div>
            </section>
            <section class="steps__item swiper-slide">
                <div class="row">
                    <div class="content">
                        <div class="steps__col steps__col--content col-span-6">
                            <header class="steps__header col-span-5">
                                <h2 class="header-two">3. Business benefits</h2>
                            </header>
                            <div class="steps__copy col-span-5">

                            </div>
                            <div class="steps__buttons col-span-6">

                            </div>
                        </div>
                        <div class="steps__col steps__col--image col-span-6 col-start-7">

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </section>
    {{--<section class="how-it-works how-it-works--sign-up">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<div class="col col--lg-12-4 col--lg-offset-12-7 col--l-12-6 col--l-offset-12-7 col--sm-6-6 col--sm-offset-6-1 col--s-6-6 how-it-works__copy">--}}
                    {{--<div class="how-it-works__step">--}}
                        {{--<header class="section-title">--}}
                            {{--<h2 class="header header--five color--carnation spacer-bottom--40">Sign up</h2>--}}
                        {{--</header>--}}
                        {{--<ul>--}}
                            {{--<li class="spacer-bottom--40">Business signs up and provides basic ‘about’ info and (coming soon) payment provider information, or simple sign-up to an online payments provider if they do not already have in place.</li>--}}
                            {{--<li class="spacer-bottom--40">Create simple menu / inventory and set prices</li>--}}
                            {{--<li class="spacer-bottom--40">Consumer facing ordering page automatically generated and published</li>--}}
                        {{--</ul>--}}
                        {{--<a href="{{route('register')}}" class="button button--filled button--filled-carnation">--}}
                            {{--<span class="button__content">Get started with Awe-der</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="how-it-works__image col col--lg-12-4 col--lg-offset-12-2 col--l-12-6 col--l-offset-12-1 col--sm-6-4 col--sm-offset-6-2 col--s-6-6 col--s-offset-6-1">--}}
                    {{--<img src="images/menu-creation.png" alt="easy signup" />--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<section class="how-it-works how-it-works--ordering">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<div class="col col--lg-12-4 col--lg-offset-12-2 col--l-12-6 col--l-offset-12-1 col--sm-6-6 col--sm-offset-6-1 col--s-6-6 col--s-offset-6-1 how-it-works__copy">--}}
                    {{--<div class="how-it-works__step">--}}
                        {{--<header class="section-title">--}}
                            {{--<h2 class="header header--five color--carnation spacer-bottom--40">Ordering</h2>--}}
                        {{--</header>--}}
                        {{--<ul>--}}
                            {{--<li class="spacer-bottom--40">Consumer navigates to order page (web or mobile)</li>--}}
                            {{--<li class="spacer-bottom--40">Selects items to purchase and add any special requirements</li>--}}
                            {{--<li class="spacer-bottom--40">Checks out and (coming soon) provide payment details</li>--}}
                            {{--<li class="spacer-bottom--40">Notification sent to business, allowing them to accept or reject the order</li>--}}
                            {{--<li class="spacer-bottom--40">If order is accepted, business provides pickup / delivery time and payment is processed</li>--}}
                            {{--<li class="spacer-bottom--40">Consumer receives email, confirming order and notifying them of collection / delivery details</li>--}}
                        {{--</ul>--}}
                        {{--<a href="{{route('register')}}" class="button button--filled button--filled-carnation">--}}
                            {{--<span class="button__content">Get started with Awe-der</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="how-it-works__image col col--lg-12-4 col--lg-offset-12-7 col--l-12-6 col--l-offset-12-7 col--sm-6-4 col--sm-offset-6-2 col--s-6-6 col--s-offset-6-1">--}}
                    {{--<img src="images/simple-ordering.png" alt="orders" />--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    {{--<section class="how-it-works how-it-works--benefits">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<div class="col col--lg-12-4 col--lg-offset-12-7 col--l-12-6 col--l-offset-12-7 col--sm-6-6 col--sm-offset-6-1 col--s-6-6 how-it-works__copy">--}}
                    {{--<div class="how-it-works__step">--}}
                        {{--<header class="section-title">--}}
                            {{--<h3 class="header header--five color--carnation spacer-bottom--40">Business Benefits</h3>--}}
                        {{--</header>--}}
                        {{--<ul>--}}
                            {{--<li class="spacer-bottom--40">No major change to operational processes or requirement for additional equipment</li>--}}
                            {{--<li class="spacer-bottom--40">Reduces interpersonal interaction in line with government guidelines</li>--}}
                            {{--<li class="spacer-bottom--40">Streamlines business operations and leaves staff to focus on core activities</li>--}}
                        {{--</ul>--}}
                        {{--<a href="{{route('register')}}" class="button button--filled button--filled-carnation">--}}
                            {{--<span class="button__content">Get started with Awe-der</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<div class="how-it-works__image col col--lg-12-4 col--lg-offset-12-2 col--l-12-6 col--l-offset-12-1 col--sm-6-4 col--sm-offset-6-2 col--s-6-6 col--s-offset-6-1">--}}
                    {{--<img src="images/dashboard-benefits.png" alt="awe-der menu" />--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection
