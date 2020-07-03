<nav class="site-nav col-span-9 col sm-col-span-4">
    <input type="checkbox" id="menu-trigger" class="hidden" />
    <label class="site-nav__burger hidden sm-flex" for="menu-trigger">
        <span class="site-nav__burger-wrapper">
            <span></span>
        </span>
    </label>
    <ul class="site-menu">
        <li class="site-menu__item">
            <a href="{{ route('about.how-it-works') }}" class="site-menu__link">How it works</a>
        </li>
        <li class="site-menu__item">
            <a href="{{ route('login') }}" class="site-menu__link site-menu__button site-menu__button--outline">Merchant login</a>
        </li>
        <li class="site-menu__item">
            <a href="{{ route('register') }}" class="site-menu__link site-menu__button site-menu__button--solid">Merchant signup</a>
        </li>
    </ul>
</nav>
