<nav class="tab-nav tab-nav--dashboard col-span-9 m-col-span-12 sm-col-span-6">
    <ul class="tab-menu">
        <li class="tab-menu__item @if ($current === 'today')tab-menu__item--active @endif">
            <a href="{{ route('admin.dashboard', ['period' => 'today']) }}" class="tab-menu__link">Today</a>
        </li>
        <li class="tab-menu__item @if ($current === 'this-week')tab-menu__item--active @endif">
            <a href="{{ route('admin.dashboard', ['period' => 'this-week']) }}" class="tab-menu__link">This Week</a>
        </li>
        <li class="tab-menu__item @if ($current === 'this-month')tab-menu__item--active @endif">
            <a href="{{ route('admin.dashboard', ['period' => 'this-month']) }}" class="tab-menu__link">This Month</a>
        </li>
    </ul>
</nav>
