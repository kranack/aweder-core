<header class="admin-header col-span-9 col-start-4 m-col-span-12 m-col-start-1 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-9 m-grid-cols-12 sm-grid-cols-6">
    <div id="admin__greeting" class="admin__greeting flex align-items-center col-span-3 col-start-7 m-col-span-5 m-col-start-8 sm-col-start-2 s-col-span-6 s-col-start-1">
        <span class="avatar avatar--small margin-right-10">
            <img src="{{ $merchant->getTemporaryLogoLink() }}" alt="{{ $merchant->name }}" />
        </span>
        <p class="admin__name flex align-items-center">Welcome {{ $merchant->name }}</p>
        <span class="admin__trigger hidden m-flex margin-left-20">
            <span class="admin__burger"></span>
        </span>
    </div>
</header>