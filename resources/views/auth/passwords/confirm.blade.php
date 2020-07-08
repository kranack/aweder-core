@extends('global.app')

@section('content')
    <section class="auth">
        <div class="row">
            <div class="content">
                <header class="auth__header col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <h1 class="header-one color-carnation margin-bottom-40">Reset password</h1>
                    <p>Please confirm your password before continuing.</p>
                </header>
                <form class="col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 inline-flex flex-col margin-bottom-60"
                      id="confirm"
                      name="confirm"
                      autocomplete="off"
                      action="{{ route('login') }}"
                      method="POST">
                    @csrf
                    <div class="field @error('password') field--error @enderror">
                        <label for="password" class="label label--float">Password<sup>*</sup></label>
                        <input type="password" name="password" id="password" class="text-input" placeholder="Password" />
                        @error('password')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--checkbox margin-top-10">
                        <input type="checkbox" name="remember" id="remember" class="checkbox-input hidden">
                        <label for="remember" class="checkbox">
                            <span class="checkbox__icon checkbox__icon--small">@svg('tick', 'stroke-cloud-burst')</span>
                            <span class="checkbox__label checkbox__label--small">Remember Me</span>
                        </label>
                    </div>
                    <div class="field field--buttons align-items-start margin-top-20 s-align-items-stretch">
                        <button type="submit" class="button button-solid--carnation">
                            <span class="button__content">Confirm password</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                    <div class="flex margin-top-60">
                        <a href="{{ route('password.request') }}" class="body-large text-underline color-cloud-burst">Forgotten your password?</a>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
