@extends('global.admin')
@section('content')
    <header class="dashboard-header col-span-9 m-col-span-12 sm-col-span-6">
        <h1 class="dashboard-title header-one">Orders</h1>
    </header>

    <orders-panel
        :open-orders="{{ json_encode($outstanding->items()) }}"
        :accepted-orders="{{ json_encode($accepted->items()) }}"
        :rejected-orders="{{ json_encode($rejected->items()) }}"
        :fulfilled-orders="{{ json_encode($fulfilled->items()) }}"
    />

@endsection
