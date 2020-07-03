<header class="site-header">
    <div class="row flex justify-content-center">
        <div class="content">
            <div class="col col-span-3 sm-col-span-2 site-branding">
                <a href="{{ route('home')}}">
                    <span class="icon icon--logo s-hidden">
                        @svg('aweder-logo')
                    </span>
                    <span class="icon icon--logo-mobile hidden s-flex">
                        @svg('aweder-logo-small')
                    </span>
                </a>
            </div>
            @include('global/navigation')
        </div>
    </div>
</header>
