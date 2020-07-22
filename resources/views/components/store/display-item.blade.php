<div class="inventory__item">
    @if ($item->image)
        <div class="inventory__image">
            <img src="{{ $item->getTemporaryInventoryImageLink() }}" alt="{{ $item->title }}">
        </div>
    @endif
    <div class="inventory__details">
        <header class="inventory__header">
            <h3 class="inventory__title">{{ $item->title }}</h3>
        </header>
        @if ($item->description !== null && !empty($item->description))
            <p class="inventory__description">{{ $item->description }}</p>
        @endif
        <span class="inventory__price">£{{ $item->getFormattedUKPriceAttribute($item->price) }}</span>
        <div class="inventory__button">
            <p class="inventory__add">Add</p>
            <span class="icon icon--add flex margin-left-10">@svg('add')</span>
        </div>
    </div>
</div>

    {{--<div class="menu__description">--}}
        {{--<p class="menu__title font--gibson-semi color--cloudburst">{{ $item->title }} @if ($item->description !== null && !empty($item->description)) - <span>{{ $item->description }}</span>@endif</p>--}}
        {{--<p class="menu__price">£{{ $item->getFormattedUKPriceAttribute($item->price) }}</p>--}}
        {{--@if ($editable === true)--}}
            {{--<div class="menu__add">--}}
                {{--<form method="POST" action="{{ route('store.order.add', [$merchant->url_slug]) }}">--}}
                    {{--@csrf--}}
                    {{--<input type="hidden" name="item" value="{{ $item->id }}" />--}}
                    {{--@if (isset($order))--}}
                        {{--<input type="hidden" name="order_no" value="{{ $order->url_slug }}" />--}}
                    {{--@endif--}}
                    {{--<button type="submit" class="menu__addto color--carnation">Add &plus;</button>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--</div>--}}
{{--</div>--}}
