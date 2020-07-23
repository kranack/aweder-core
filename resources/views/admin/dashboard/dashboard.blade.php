@extends('global.admin')
@section('content')
    <header class="dashboard-header dashboard-header--copy col-span-9 m-col-span-12 sm-col-span-6">
        <h1 class="dashboard-title header-one">Dashboard</h1>
        <p>Your merchant order page is <a target="_blank" href="{{ route('store.menu.view', $merchant->url_slug) }}">{{ route('store.menu.view', $merchant->url_slug) }}</a></p>
    </header>
    <section class="dashboard-content width-full col-span-9 m-col-span-12 sm-col-span-6 inline-grid grid-cols-9 m-grid-col-12 sm-grid-cols-6">
        <x-dashboard-order-filtering-component :period="$period" :filteredStatus="$statusFilter"/>
        <div class="metric col-span-9 m-col-span-12 sm-col-span-6">
            <div class="metric__item">
               <p>New orders</p>
                <span class="metric__count">{{ $dashboardMetrics['New Order'] }}</span>
            </div>
            <div class="metric__item">
                <p>Processing</p>
                <span class="metric__count">{{ $dashboardMetrics['Processing'] ?? 0 }}</span>
            </div>
            <div class="metric__item">
                <p>Completed</p>
                <span class="metric__count">{{ $dashboardMetrics['Completed'] ?? 0 }}</span>
            </div>
            <div class="metric__item">
                <p>Rejected</p>
                <span class="metric__count">{{ $dashboardMetrics['Rejected'] ?? 0 }}</span>
            </div>
        </div>
        <div class="dashboard-filters col-span-9 m-col-span-12 sm-col-span-6 inline-flex align-items-end">
            <div class="dashboard__filter margin-right-40">
                <form action={{ route('admin.dashboard') }} method="GET" id="dashboard-status-sort">
                    <div class="field field--select field--select-button">
                        <span class="select-icon icon icon--sort
                        @if ($sort === 'asc')icon--sort-asc @endif
                        @if ($sort === 'desc')icon--sort-desc @endif">
                            @svg('sort', 'fill-cloud-burst')</span>
                        <select name="sort" id="dashboard-status-filter-select"
                                class="select select--button">
                            <option value="">Sort</option>
                            <option value="asc"
                            @if ($sort === 'asc')
                            selected
                            @endif
                            >Ascending</option>
                            <option value="desc"
                            @if ($sort === 'desc')
                            selected
                            @endif
                            >Descending</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="dashboard__filter margin-right-40">
                <form action={{ route('admin.dashboard') }} method="GET" id="dashboard-status-filter">
                    <div class="field field--select field--select-button">
                        <span class="select-icon icon icon--filter">@svg('filter', 'fill-cloud-burst')</span>
                        <select name="status" id="dashboard-status-filter-select"
                                class="select select--button">
                            <option value="">Filter orders</option>
                            @foreach ($filterOptions as $option => $label)
                            <option value={{ $option }}
                            @if ($option === $statusFilter)
                            selected
                            @endif
                            >{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            <x-dashboard-search-component/>
        </div>
        <div class="dashboard-table col-span-9 m-col-span-12 sm-col-span-6">
            <table class="table width-full">
                <thead>
                    <tr>
                        <th>
                            <div class="table__cell">Status</div>
                        </th>
                        <th>
                            <div class="table__cell">Date</div>
                        </th>
                        <th>
                            <div class="table__cell">Order #</div>
                        </th>
                        <th>
                            <div class="table__cell">Type</div>
                        </th>
                        <th>
                            <div class="table__cell">Customer</div>
                        </th>
                        <th>
                            <div class="table__cell"></div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>
                            <div class="table__cell font-gibson-med">
                                {{--@TODO add different classes to the status div--}}
                                <span class="status status--new"></span>
                                <a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->getNiceFrontendStatus() }}</a>
                            </div>
                        </td>
                        <td>
                            <div class="table__cell">
                                {{$order->order_submitted->format('d M, H:i')}}
                            </div>
                        </td>
                        <td>
                            <div class="table__cell">
                                <a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->url_slug }}</a>
                            </div>
                        </td>
                        <td>
                            <div class="table__cell">
                                {{$order->getIsDeliveryOrCollection()}}
                            </div>
                        </td>
                        <td>
                            <div class="table__cell">
                                <a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->customer_name }}</a>
                            </div>
                        </td>
                        <td>
                            <div class="table__cell">
                                <a href="{{ route('admin.view-order', $order->url_slug) }}" class="button button--small button-solid--cloud-burst">
                                    <span class="button__content">View order</span>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
    {{--<header class="dashboard__header col col--lg-12-10 col--sm-6-6 admin-inner-grid">--}}
        {{--<div class="dashboard__title col col--lg-12-6 col--sm-6-6">--}}
            {{--<h1 class="header header--three color--carnation">Dashboard</h1>--}}
        {{--</div>--}}
        {{--<div class="dashboard__intro col col--lg-12-5 col--sm-6-5">--}}
            {{--@if ($showSignUpDashboardMessage === true)--}}
            {{--<p>Welcome to Awe-der, setup is complete and your order page is now live at <a href="{{ route('store.menu.view', $merchant->url_slug) }}">{{ route('store.menu.view', $merchant->url_slug) }}</a>.</p>--}}
            {{--<p>This is the dashboard where you can view and process all orders as well as change any settings</p>--}}
            {{--@else--}}
            {{--<p>Your merchant order page is <a target="_blank" href="{{ route('store.menu.view', $merchant->url_slug) }}">{{ route('store.menu.view', $merchant->url_slug) }}</a></p>--}}
            {{--@endif--}}
        {{--</div>--}}
    {{--</header>--}}
    {{--<section class="dashboard__content">--}}
        {{--<x-dashboard-order-filtering-component :period="$period" :filteredStatus="$statusFilter"/>--}}
        {{--<div class="col col--lg-12-10 dashboard__metrics">--}}
            {{--<div class="metric">--}}
                {{--<p>New Orders</p> <span class="metric__count">{{ $dashboardMetrics['New Order'] }}</span>--}}
            {{--</div>--}}
            {{--<div class="metric">--}}
                {{--<p>Processing</p> <span class="metric__count">{{ $dashboardMetrics['Processing'] ?? 0 }}</span>--}}
            {{--</div>--}}
            {{--<div class="metric">--}}
                {{--<p>Completed</p> <span class="metric__count">{{ $dashboardMetrics['Completed'] ?? 0 }}</span>--}}
            {{--</div>--}}
            {{--<div class="metric">--}}
                {{--<p>Rejected</p> <span class="metric__count">{{ $dashboardMetrics['Rejected'] ?? 0 }}</span>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@if (!$orders->isEmpty())--}}
        {{--<div class="col col--lg-12-10 col--sm-6-6 dashboard__filtering">--}}
            {{--<div class="dashboard__filter">--}}
                {{--<form action={{ route('admin.dashboard') }} method="GET" id="dashboard-status-sort">--}}
                    {{--<select name="sort" id="dashboard-status-filter-select">--}}
                        {{--<option value="">Sort</option>--}}
                        {{--<option value="asc"--}}
                        {{--@if ($sort === 'asc')--}}
                            {{--selected--}}
                        {{--@endif--}}
                        {{-->Ascending</option>--}}
                        {{--<option value="desc"--}}
                        {{--@if ($sort === 'desc')--}}
                            {{--selected--}}
                        {{--@endif--}}
                        {{-->Descending</option>--}}
                    {{--</select>--}}
                    {{--<span class="icon icon--filter">@svg('sort')</span>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<div class="dashboard__filter">--}}
                {{--<form action={{ route('admin.dashboard') }} method="GET" id="dashboard-status-filter">--}}
                    {{--<select name="status" id="dashboard-status-filter-select">--}}
                        {{--<option value="">Filter orders</option>--}}
                        {{--@foreach ($filterOptions as $option => $label)--}}
                            {{--<option value={{ $option }}--}}
                            {{--@if ($option === $statusFilter)--}}
                                    {{--selected--}}
                                    {{--@endif--}}
                            {{-->{{ $label }}</option>--}}
                        {{--@endforeach--}}
                    {{--</select>--}}
                    {{--<span class="icon icon--filter">@svg('filter')</span>--}}
                {{--</form>--}}
            {{--</div>--}}
            {{--<x-dashboard-search-component/>--}}
        {{--</div>--}}
        {{--<div class="col col--lg-12-10 col--sm-6-6 dashboard__table">--}}
            {{--<table class="dashboard__table">--}}
                {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Ordered</th>--}}
                        {{--<th>Order #</th>--}}
                        {{--<th>Type</th>--}}
                        {{--<th>Status</th>--}}
                        {{--<th>Customer</th>--}}
                        {{--<th>Total</th>--}}
                    {{--</tr>--}}
                {{--</thead>--}}
                {{--<tbody>--}}
                    {{--@foreach ($orders as $order)--}}
                    {{--<tr>--}}
                        {{--<td>{{$order->order_submitted->format('d M, H:i')}}</td>--}}
                        {{--<td><a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->url_slug }}</a></td>--}}
                        {{--<td>{{$order->getIsDeliveryOrCollection()}}</td>--}}
                        {{--<td><a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->getNiceFrontendStatus() }}</a></td>--}}
                        {{--<td><a href="{{ route('admin.view-order', $order->url_slug) }}">{{ $order->customer_name }}</a></td>--}}
                        {{--<td>--}}
                        {{--@if ($order->is_delivery === 1)--}}
                            {{--&pound;{{$order->getFormattedUKPriceAttribute($order->total_cost, $order->delivery_cost)}}--}}
                        {{--@else--}}
                            {{--&pound;{{$order->getFormattedUKPriceAttribute($order->total_cost)}}--}}
                        {{--@endif--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--@endforeach--}}
                {{--</tbody>--}}
            {{--</table>--}}
        {{--</div>--}}
        {{--@endif--}}
    {{--</section>--}}
@endsection
