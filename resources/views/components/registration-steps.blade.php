<nav class="tab-nav col-span-10 col-start-2 m-col-span-12 m-col-start-1 sm-col-span-6">
    <ul class="tab-menu justify-content-between">
        <li class="tab-menu__item @if ($stage === 'user-details')tab-menu__item--active @endif">User Information</li>
        <li class="tab-menu__item @if ($stage === 'business-details')tab-menu__item--active @endif">Business Details</li>
        <li class="tab-menu__item @if ($stage === 'contact-details')tab-menu__item--active @endif">Contact Numbers</li>
        <li class="tab-menu__item @if ($stage === 'business-address')tab-menu__item--active @endif">Business Address</li>
        <?php /**<li class="tab-menu__item @if ($stage === 'stripe-api')tab-menu__item--active @endif">Stripe API</li>**/?>
    </ul>
</nav>
