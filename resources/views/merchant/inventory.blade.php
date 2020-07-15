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
        <div class="menu__listing padding-bottom-140 sm-padding-bottom-0">
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
                                        <h3 class="inventory__subcategory">Sub category</h3>
                                        @foreach ($category->inventoriesAvailable as $inventory)
                                            <x-display-item :item="$inventory" :editable="$editable" :merchant="$merchant" :order="$order ?? null" />
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    @endif
                    @if (isset($order))
                        @if (!$order->items->isEmpty())
                        <div class="cart panel panel--radius-bottom background-off-white col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-col-span-6 sm-col-start-1">

                        </div>
                        @endif
                    @else
                        <div class="cart cart--empty panel panel--radius-bottom background-off-white col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-col-span-6 sm-col-start-1">
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
                                    <p class="cart__title">Prawn crackers</p>
                                    <div class="increment increment--small">
                                        <span class="increment__type increment__type--down">@svg('minus', 'fill-casablanca')</span>
                                        <span class="increment__value">1</span>
                                        <span class="increment__type increment__type--up">@svg('add', 'fill-casablanca')</span>
                                    </div>
                                    <span class="cart__price text-right">£1.95</span>
                                </div>
                            </div>

                            {{--<div class="cart__sbuttons">--}}
                                {{--<button class="button button-outline--silver">--}}
                                    {{--<span class="button__content">Place order</span>--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="button button-solid--carnation hidden sm-flex menu__view" id="menu__view">
                <span class="button__icon button__icon--left">@svg('aweder-logo-small')</span>
                <span class="button__content">View order</span>
                <span class="separator separator--small"></span>
                <span class="button__price">£12.00</span>
            </div>
        </div>
    </section>
    {{--<section class="ordering">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<div class="col--lg-12-6 col--lg-offset-12-2 col--sm-6-6 col--sm-offset-6-1 menu">--}}
                    {{--@if (!$merchant->categories->isEmpty())--}}
                        {{--@foreach ($merchant->categories as $category)--}}
                            {{--@if (!$category->inventoriesAvailable->isEmpty())--}}
                                {{--<div class="menu__item" id="{{$category->title}}">--}}
                                    {{--<header class="menu__item-header">--}}
                                        {{--<h4 class="header header--five color--cloudburst spacer-bottom--50">{{ $category->title }}</h4>--}}
                                    {{--</header>--}}
                                    {{--<div class="menu__section">--}}
                                        {{--@foreach ($category->inventoriesAvailable as $inventory)--}}
                                            {{--<x-display-item :item="$inventory" :editable="$editable" :merchant="$merchant" :order="$order ?? null" />--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        {{--@endforeach--}}
                    {{--@endif--}}
                {{--</div>--}}

                {{--<div class="col--lg-12-4 col--lg-offset-12-9 col--m-12-4 col--m-offset-12-9 col--sm-6-6 col--sm-offset-6-1 order">--}}
                    {{--@if (isset($order))--}}
                        {{--@if (!$order->items->isEmpty())--}}
                            {{--@foreach ($order->items as $item)--}}
                                {{--<div class="order__menu">--}}
                                    {{--<dl class="order__menu-list">--}}
                                        {{--<dd class="order__title">{{ $item->inventory->title }}</dd>--}}
                                        {{--<dd class="order__price">{{ $item->quantity }} * &pound;{{ $item->getFormattedUKPriceAttribute($item->price) }}</dd>--}}
                                    {{--</dl>--}}
                                    {{--@if ($editable === true)--}}
                                        {{--<form method="POST" action="{{ route('store.menu.remove-item', ['merchant' => $merchant->url_slug, 'order' => $order->url_slug]) }}" class="form form--order-remove">--}}
                                            {{--@csrf--}}
                                            {{--<input type="hidden" name="item" value="{{ $item->inventory->id }}" />--}}
                                            {{--@if (isset($order))--}}
                                                {{--<input type="hidden" name="order_no" value="{{ $order->url_slug }}" />--}}
                                            {{--@endif--}}
                                            {{--<div class="field field--button">--}}
                                                {{--<button type="submit" class="button button--icon button--outline button--remove">--}}
                                                    {{--<span class="icon icon--remove">--}}
                                                       {{--@svg('remove')--}}
                                                   {{--</span>--}}
                                                {{--</button>--}}
                                            {{--</div>--}}
                                        {{--</form>--}}
                                    {{--@endif--}}
                                {{--</div>--}}
                            {{--@endforeach--}}

                                {{--<div class="order__total">--}}
                                    {{--<p class="order__total-no-delivery"><span>Total:</span>--}}
                                        {{--£{{ $order->getFormattedUKPriceAttribute($order->total_cost) }}</p>--}}
                                    {{--<p class="order__total-delivery"><span>Delivery Cost:</span>--}}
                                        {{--&pound;{{ $merchant->getFormattedUKPriceAttribute($merchant->delivery_cost) }}</p>--}}
                                    {{--<p class="order__total-with-delivery"><span>Total:</span>--}}
                                        {{--£{{ $order->getFormattedUKPriceAttribute($order->total_cost, $merchant->delivery_cost) }}</p>--}}
                                {{--</div>--}}
                            {{--<div class="order__completion">--}}
                                {{--@if ($editable === true)--}}
                                {{--<form method="POST" action="{{ route('store.order.submit', ['merchant' => $merchant->url_slug, 'order' => $order->url_slug]) }}" class="form form--delivery">--}}
                                    {{--@csrf--}}
                                    {{--<input type="hidden" name="order_no" value="{{ old('order_no', $order->url_slug) }}" />--}}
                                    {{--<div class="field">--}}
                                        {{--<label  for="note">Add any special instructions or restrictions for the restaurant, e.g. allergies or intolerances.</label>--}}
                                        {{--<textarea id="note" name="customer_note">{{ old('customer_note') }}</textarea>--}}
                                    {{--</div>--}}
                                    {{--@if ($merchant->doesMerchantAllowDeliveryAndCollection())--}}
                                        {{--<div class="field field--wrapper field--wrapper-radio">--}}
                                            {{--<div class="field field--radio field--radio-small">--}}
                                                {{--<input type="radio" class="collection-choice" data-collection-type="delivery"--}}
                                                       {{--name="collection_type"--}}
                                                       {{--@if (old('collection_type') === 'delivery') checked="checked"--}}
                                                       {{--@endif id="allow-delivery" value="delivery">--}}
                                                {{--<label for="allow-delivery">Delivery</label>--}}
                                            {{--</div>--}}
                                            {{--<div class="field field--radio field--radio-small">--}}
                                                {{--<input type="radio" class="collection-choice" data-collection-type="collection"--}}
                                                       {{--name="collection_type" id="allow-collection"--}}
                                                       {{--@if (old('collection_type') === 'collection') checked="checked"--}}
                                                       {{--@endif value="collection">--}}
                                                {{--<label for="allow-collection">Collection</label>--}}
                                            {{--</div>--}}
                                            {{--@error('collection_type')--}}
                                            {{--<span class="form__validation-error">{{ $message }}</span>--}}
                                            {{--@enderror--}}
                                        {{--</div>--}}
                                        {{--@if ($merchant->doesMerchantAllowDeliveryAndCollection())--}}
                                            {{--<div class="field delivery--wrapper">--}}
                                                {{--<p>Delivery within a {{ $merchant->delivery_radius }} mile radius</p>--}}
                                            {{--</div>--}}
                                        {{--@endif--}}
                                    {{--@elseif ($merchant->deliveryOnly())--}}
                                        {{--<input type="hidden" name="collection_type" id="allow-collection"--}}
                                               {{--@if (old('collection_type') === 'delivery') checked="checked"--}}
                                               {{--@endif value="delivery">--}}
                                    {{--@else--}}
                                        {{--<input type="hidden" name="collection_type" id="allow-collection"--}}
                                               {{--@if (old('collection_type') === 'collection') checked="checked"--}}
                                               {{--@endif value="collection">--}}
                                    {{--@endif--}}
                                    {{--@error('collection_type')--}}
                                    {{--<p class="form__validation-error">{{ $message }}</p>--}}
                                    {{--@enderror--}}

                                    {{--<div class="field">--}}
                                        {{--@error('order_time')--}}
                                        {{--<span class="form__validation-error">{{ $message }}</span>--}}
                                        {{--@enderror--}}
                                        {{--<span class="label">Requested Order Time</span>--}}
                                        {{--<div class="select-wrapper">--}}
                                            {{--<div class="field field--select">--}}
                                                {{--<select name="order_time[hour]" class="select">--}}
                                                    {{--@for ($i = 0; $i <= 23; $i++)--}}
                                                        {{--<option value="{{ $i < 10 ? '0' . $i : $i }}"--}}
                                                                {{--@if (old('order_time.hour') == $i) selected @endif>{{ $i < 10 ? '0'--}}
                                                {{--. $i--}}
                                                {{--: $i }}--}}
                                                        {{--</option>--}}
                                                    {{--@endfor--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                            {{--<span>:</span>--}}
                                            {{--<div class="field field--select">--}}
                                                {{--<select name="order_time[minute]" class="select">--}}
                                                    {{--@for ($i = 0; $i < 12; $i++)--}}
                                                        {{--<option value="{{ $i * 5 < 10 ? '0' . $i * 5 : $i * 5}}"--}}
                                                                {{--@if (old('order_time.minute') == $i * 5) selected @endif>{{ $i * 5 <--}}
                                                {{--10--}}
                                                {{--? '0' . $i * 5 : $i * 5 }}--}}
                                                        {{--</option>--}}
                                                    {{--@endfor--}}
                                                {{--</select>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="field field--button">--}}
                                        {{--<button type="submit" class="button button--icon-right button--filled button--filled-carnation ">--}}
                                            {{--<span class="button__content">Place order</span>--}}
                                            {{--<span class="icon icon-right">@svg('arrow-right')</span>--}}
                                        {{--</button>--}}
                                    {{--</div>--}}
                                {{--</form>--}}
                                    {{--@endif--}}
                            {{--</div>--}}
                        {{--@endif--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection
