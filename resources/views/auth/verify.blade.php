@extends('global.app')
@section('content')
    <section class="auth">
        <div class="row">
            <div class="content">
                <header class="auth__header col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <h1 class="header-one color-carnation">Verify your email address</h1>
                    <p>A Fresh verification link has been sent to your email address</p>
                </header>
                <form class="col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 inline-flex flex-col margin-bottom-60"
                      id="resend-verification"
                      name="resendVerification"
                      autocomplete="off"
                      action="{{ route('verification.resend') }}"
                      method="POST">
                    <div class="field field--buttons align-items-start margin-top-20">
                        <button type="submit" class="button button-solid--carnation s-width-full">
                            <span class="button__content">Sign in</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
