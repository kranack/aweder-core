<nav id="admin-nav" class="admin-nav col-span-3 row-span-2">
    <div class="admin-nav__wrapper m-col-span-5 m-col-start-8 sm-col-span-5 sm-col-start-2">
        <a href="{{ route('admin.dashboard')}}" class="branding branding--admin m-hidden">
            <span class="icon icon--logo m-hidden">
                @svg('aweder-logo')
            </span>
        </a>
        <ul class="admin-menu flex flex-col">
            <li class="admin-menu__item">
                <a href="{{ route('admin.dashboard') }}" class="admin-menu__link">
                    <span class="admin-menu__icon"></span>Dashboard
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
    </div>
</nav>