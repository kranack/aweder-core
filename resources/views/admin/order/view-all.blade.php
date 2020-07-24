@extends('global.admin')
@section('content')
<header class="margin-bottom-80 col-span-12">
    <h1 class="header-one color-carnation">Orders</h1>
</header>
<div class="col-span-12">
    <orders-panel
        :open-orders="{{ json_encode($outstanding->items()) }}"
        :accepted-orders="{{ json_encode($accepted->items()) }}"
        :rejected-orders="{{ json_encode($rejected->items()) }}"
        :fulfilled-orders="{{ json_encode($fulfilled->items()) }}"
    />
</div>
@endsection
