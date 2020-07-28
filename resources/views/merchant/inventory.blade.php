@extends('global.app')
@section('content')
    <section class="hero background-off-white border-silver border-width-1 border-bottom-solid">
        <div class="row">
            <div class="content align-items-center">
                <header class="hero__header col-span-5 col-start-2 l-col-start-1 m-col-span-7 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 margin-bottom-15">
                    <h1 class="header-one color-carnation">{{ $merchant->name }}</h1>
                </header>
                <x-merchant-opening-hours :opening-hours="$merchant->openingHours" />
                <div class="hero__merchant-delivery wrap col-span-5 col-start-2 l-col-start-1 m-col-span-7 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    @if ($merchant->doesMerchantAllowDeliveryAndCollection())
                    <p class="margin-right-40"><span class="icon icon--pinpoint">@svg('pinpoint', 'fill-casablanca')</span>We deliver within a {{ $merchant->delivery_radius }} mile radius</p>
                    <p class="margin-right-40"><span class="icon icon--delivery">@svg('delivery', 'fill-casablanca')</span>£{{ $merchant->getFormattedUKPriceAttribute($merchant->delivery_cost) }}</p>
                    <p><span class="icon icon--collection">@svg('collection', 'fill-casablanca')</span>Collection available</p>
                    @elseif ($merchant->deliveryOnly())

                    @endif
                </div>
                <div class="hero__merchant-address col-span-5 col-start-2 l-col-start-1 m-col-span-7 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <p class="margin-bottom-5">{{ $merchant->address }}</p>
                    <p><a href="tel:{{ $merchant->contact_number }}" class="color-cloud-burst text-underline">{{ $merchant->contact_number }}</a></p>
                </div>
                @if ($merchant->description  !== null)
                    <div class="hero__copy col-span-4 col-start-2 l-col-span-5 l-col-start-1 m-col-span-6 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 margin-top-50">
                        <p>{{ $merchant->description }}</p>
                    </div>
                @endif
                @if ($merchant->logo !== null)
                    <div class="hero__image hero__image--border hero__image--square inline-flex col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 m-col-start-8 sm-col-span-2 sm-col-start-3 s-col-start-1 row-span-5 row-start-1 sm-row-start-5 sm-margin-top-50 s-row-start-5">
                        <img src="{{ $merchant->getTemporaryLogoLink() }}" alt="{{ $merchant->name }}">
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="menu flex flex-col">
        <header class="menu__categories">
            <div class="row flex align-content-stretch">
                <div class="content align-content-stretch">
                    @if (!$merchant->categories->isEmpty() && $merchant->categories->count() > 1)
                        <nav class="menu__nav inline-flex align-content-stretch col-span-6 col-start-2 l-col-start-1">
                            <ul class="menu__cat-list">
                                @foreach ($merchant->categories as $category)
                                    @if (!$category->inventoriesAvailable->isEmpty())
                                        <li class="menu__cat-item">
                                            <a href="#{{$category->title}}" class="menu__cat-link">{{ $category->title }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </nav>
                    @endif
                    @if (isset($order))
                        @if (!$order->items->isEmpty())
                            <div class="menu__cart menu__cart--added col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-hidden">
                                <span class="icon icon--logo-mark flex margin-right-20">@svg('aweder-logo-small')</span>
                                <p>Add more items - £{{ $order->getFormattedUKPriceAttribute($order->total_cost) }}</p>
                            </div>
                        @endif
                    @else
                        <div class="menu__cart col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-hidden">
                            <span class="icon icon--logo-mark flex margin-right-20">@svg('aweder-logo-small')</span>
                            <p>Your order is empty</p>
                        </div>
                    @endif
                </div>
            </div>
        </header>
        <div class="menu__listing padding-bottom-140 sm-padding-bottom-60">
            <div class="row">
                <div class="content align-items-start">
                    @if (!$merchant->categories->isEmpty())
                        <div class="inventory col-span-6 col-start-2 l-col-start-1 m-col-span-7 sm-col-span-6 padding-top-100">
                            @foreach ($merchant->categories as $category)
                                @if (!$category->inventoriesAvailable->isEmpty())
                                    <div class="inventory__categories inline-flex flex-col width-full" id="{{$category->title}}">
                                        <header class="inventory__category-name">
                                            <h2 class="header-three">{{$category->title}}</h2>
                                        </header>
                                        {{--@TODO add if sub category--}}
                                        <div class="inventory__sub-categories width-full">
                                            <h3 class="inventory__sub-title">Sub category</h3>
                                            <div class="inventory__group width-full">
                                                @foreach ($category->inventoriesAvailable as $inventory)
                                                    <inventory-item
                                                        @added=""
                                                        item-id="{{ $inventory->id }}"
                                                        title="{{ $inventory->title }}"
                                                        description="{{ $inventory->description }}"
                                                        price="{{ $inventory->getFormattedUKPriceAttribute($inventory->price) }}"
                                                        {{-- image="{{ $inventory->getTemporaryInventoryImageLink() }}" --}}
                                                        :editable="{{ $editable ? 'true' : 'false' }}"
                                                    ></inventory-item>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if (isset($order))
                        @if (!$order->items->isEmpty())
                        <div class="cart panel panel--radius-bottom background-off-white col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-col-span-6 sm-col-start-1">
                            <div class="cart__service flex align-items-center">
                                <div class="field field--radio">
                                    <input type="radio" name="service" id="delivery" class="radio-input hidden">
                                    <label for="delivery" class="radio radio--standard">
                                        <span class="radio__icon radio__icon--small"></span>
                                        <span class="radio__label radio__label--small">Delivery</span>
                                    </label>
                                </div>
                                <div class="field field--radio">
                                    <input type="radio" name="service" id="collection" class="radio-input hidden">
                                    <label for="collection" class="radio radio--standard">
                                        <span class="radio__icon radio__icon--small"></span>
                                        <span class="radio__label radio__label--small">Collection</span>
                                    </label>
                                </div>
                            </div>
                            <div class="cart__order">
                                <div class="cart__item">
                                    <div class="cart__line">
                                        <p class="cart__title">{{ $item->inventory->title }}</p>
                                        <div class="increment increment--small">
                                            <span class="increment__type increment__type--down">@svg('minus', 'fill-casablanca')</span>
                                            <input type="text" class="increment__value" value="{{ $item->quantity }}" />
                                            <span class="increment__type increment__type--up">@svg('add', 'fill-casablanca')</span>
                                        </div>
                                        <span class="cart__price text-right">£{{ $item->getFormattedUKPriceAttribute($item->price) }}</span>
                                    </div>
                                    <div class="cart__options">
                                        <h5 class="cart__option-title">Sauces</h5>
                                        <div class="cart__option-item">
                                            <p class="cart__subtitle">
                                                <span class="icon icon-add">@svg('add', 'fill-cloud-burst')</span>
                                                Curry sauce</p>
                                            <span class="cart__price text-right">£1.95</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="subtotal">
                                <div class="subtotal__item">
                                    <p class="subtotal__title">Subtotal</p>
                                    <span class="cart__price text-right">£{{ $order->getFormattedUKPriceAttribute($order->total_cost) }}</span>
                                </div>
                                <div class="subtotal__item subtotal__item--light">
                                    <p class="subtotal__title">Delivery</p>
                                    <span class="cart__price text-right">£{{ $merchant->getFormattedUKPriceAttribute($merchant->delivery_cost) }}</span>
                                </div>
                            </div>
                            <div class="total">
                                <div class="total__item">
                                    <p class="total__title">Total</p>
                                    <span class="cart__price text-right">£{{ $order->getFormattedUKPriceAttribute($order->total_cost, $merchant->delivery_cost) }}</span>
                                </div>
                            </div>
                            <div class="cart__buttons">
                                <button class="button button-solid--carnation">
                                    <span class="button__content">Place order</span>
                                </button>
                            </div>
                        </div>
                        @endif
                    @else
                        <div class="cart cart--empty panel panel--radius-bottom background-off-white col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-col-span-6 sm-col-start-1 sm-hidden">
                            <div class="cart__buttons">
                                <button class="button button-outline--silver">
                                    <span class="button__content">Place order</span>
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="button button-solid--carnation hidden menu__view" id="menu__view">
                <span class="button__icon button__icon--left">@svg('aweder-logo-small')</span>
                <span class="button__content">View order</span>
                <span class="separator separator--small"></span>
                <span class="button__price">£12.00</span>
            </div>
        </div>
    </section>
@endsection
