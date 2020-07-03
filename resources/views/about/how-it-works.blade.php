@extends('global.app')
@section('content')
    <section class="steps">
        <div class="row">
            <div class="content">
                <div class="steps__col steps__col--content col-span-6">
                    <div class="steps__wrapper">
                        <header class="steps__header col-span-5 m-col-span-6">
                            <h1 class="steps__title">Register</h1>
                            <h2 class="steps__subtitle header-two"><span class="steps__number">1.</span>Simple sign up process</h2>
                        </header>
                        <div class="steps__content col-span-5 s-col-span-6">
                            <ul class="steps__list">
                                <li class="steps__list-item">Business signs up and provides basic ‘about’ info and (coming soon) payment provider information, or simple sign-up to an online payments provider if they do not already have in place</li>
                                <li class="steps__list-item">Create simple menu / inventory and set prices</li>
                                <li class="steps__list-item">Consumer facing ordering page automatically generated and published</li>
                            </ul>
                        </div>
                        <div class="steps__buttons col-span-5 s-col-span-6">
                            <a href="{{route('register')}}" class="button button-solid--ecru-white">
                                <span class="button__content">Get started with awe-der!</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="steps__col steps__col--image col-span-6 sm-row-start-1">
                    <div class="steps__wrapper">
                        <div class="steps__image col-span-4 col-start-2 l-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                            <img src="images/menu-creation.png" alt="easy signup" class="width-full" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="steps">
        <div class="row">
            <div class="content">
                <div class="steps__col steps__col--content col-span-6 m-col-span-6">
                    <div class="steps__wrapper">
                        <header class="steps__header col-span-5 m-col-span-6">
                            <h2 class="steps__title">Ordering</h2>
                            <h3 class="steps__subtitle header-two"><span class="steps__number">2.</span>Quick and easy ordering</h3>
                        </header>
                        <div class="steps__content col-span-5 s-col-span-6">
                            <ul class="steps__list">
                                <li class="steps__list-item">Consumer navigates to order page (web or mobile)</li>
                                <li class="steps__list-item">Selects items to purchase and add any special requirements</li>
                                <li class="steps__list-item">Checks out and (coming soon) provide payment details</li>
                                <li class="steps__list-item">Notification sent to business, allowing them to accept or reject the order</li>
                                <li class="steps__list-item">If order is accepted, business provides pickup / delivery time and payment is processed</li>
                                <li class="steps__list-item">Consumer receives email, confirming order and notifying them of collection / delivery details</li>
                            </ul>
                        </div>
                        <div class="steps__buttons col-span-5 s-col-span-6">
                            <a href="{{route('register')}}" class="button button-solid--ecru-white">
                                <span class="button__content">Get started with awe-der!</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="steps__col steps__col--image col-span-6 sm-row-start-1">
                    <div class="steps__wrapper">
                        <div class="steps__image col-span-4 col-start-2 l-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                            <img src="images/simple-ordering.png" alt="orders" class="width-full" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="steps">
        <div class="row">
            <div class="content">
                <div class="steps__col steps__col--content col-span-6 m-col-span-6">
                    <div class="steps__wrapper">
                        <header class="steps__header col-span-5 m-col-span-6">
                            <h2 class="steps__title">Benefits</h2>
                            <h3 class="steps__subtitle header-two"><span class="steps__number">3.</span>Business benefits</h3>
                        </header>
                        <div class="steps__content col-span-5 s-col-span-6">
                            <ul class="steps__list">
                                <li class="steps__list-item">No major change to operational processes or requirement for additional equipment</li>
                                <li class="steps__list-item">Reduces interpersonal interaction in line with government guidelines</li>
                                <li class="steps__list-item">Streamlines business operations and leaves staff to focus on core activities</li>
                            </ul>
                        </div>
                        <div class="steps__buttons col-span-5 s-col-span-6">
                            <a href="{{route('register')}}" class="button button-solid--ecru-white">
                                <span class="button__content">Get started with awe-der!</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="steps__col steps__col--image col-span-6 sm-row-start-1">
                    <div class="steps__wrapper">
                        <div class="steps__image col-span-4 col-start-2 l-col-span-5 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                            <img src="images/dashboard-benefits.png" alt="awe-der menu" class="width-full" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection