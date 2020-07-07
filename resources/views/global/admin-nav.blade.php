<nav class="admin-nav col-span-2 row-span-2 l-col-span-3">
    <a href="{{ route('admin.dashboard')}}" class="branding branding--admin">
        <span class="icon icon--logo">
            @svg('aweder-logo')
        </span>
    </a>
    <ul class="admin-menu">
        <li class="admin-menu__item">
            <a href="{{ route('admin.dashboard') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span>Merchant dashboard
            </a>
        </li>
        <li class="admin-menu__item">
            <a href="{{ route('admin.orders.view-all') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span>Orders
            </a>
        </li>
        <li class="admin-menu__item">
            <a href="{{ route('admin.inventory') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span>Inventory
            </a>
        </li>
        <li class="admin-menu__item">
            <a href="{{ route('admin.opening-hours') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span>Opening hours
            </a>
        </li>
        <li class="admin-menu__item">
            <a href="{{ route('admin.details.edit') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span>Business Details
            </a>
        </li>
        <li class="admin-menu__item">
            <a href="{{ route('logout') }}" class="admin-menu__link">
                <span class="admin-menu__icon"></span> Logout
            </a>
        </li>
    </ul>
</nav>