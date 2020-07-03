@extends('global.app')
@section('content')
    <section class="auth">
        <div class="row">
            <div class="content">
                <header class="auth__header col-span-6 col-start-4">
                    <h1 class="header-one color-carnation">Login</h1>
                </header>
                <form class="col-span-6 col-start-4 inline-flex flex-col"
                      id="signUpForm"
                      name="signUpForm"
                      autocomplete="off"
                      action="{{ route('login') }}"
                      method="POST">
                    <div class="field">
                        <label for="email" class="label label--float">Email<sup>*</sup></label>
                        <input type="email" name="email" id="email" class="text-input" placeholder="Email address" value="{{ old('email') }}" />
                        @error('email')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field">
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
                    <div class="field field--buttons align-items-start margin-top-20">
                        <button type="submit" class="button button-solid--carnation">
                            <span class="button__content">Merchant login</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{--<section class="login">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<div class="login__form col col--lg-12-6 col--lg-offset-12-4 col--l-12-6 col--l-offset-12-4 col--m-12-11 col--m-offset-12-1 col--sm-6-6 col--sm-offset-6-1 col--s-6-6">--}}
                    {{--<header class="col col--lg-12-6 col--lg-offset-12-2 col--l-12-6 col--l-offset-12-1 col--m-12-11 col--m-offset-12-1 col--sm-6-6 col--sm-offset-6-1 col--s-6-6">--}}
                        {{--<h1 class="header header--three color--carnation spacer-bottom--40">Login</h1>--}}
                    {{--</header>--}}
                    {{--<form--}}
                            {{--id="signUpForm"--}}
                            {{--class="form form--background"--}}
                            {{--name="signUpForm"--}}
                            {{--autocomplete="off"--}}
                            {{--action="{{ route('login') }}"--}}
                            {{--method="POST">--}}
                        {{--@csrf--}}
                        {{--<div class="field @error('email') input-error @enderror">--}}
                            {{--<label for="email">Email</label>--}}
                            {{--<input type="email" name="email" id="email" value="{{ old('email') }}" />--}}
                            {{--@error('email')--}}
                            {{--<p class="form__validation-error">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        {{--<div class="field @error('password') input-error @enderror">--}}
                            {{--<label for="password">Password</label>--}}
                            {{--<input type="password" name="password" id="password"/>--}}
                            {{--@error('password')--}}
                            {{--<p class="form__validation-error">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        {{--<div class="field field--checkbox">--}}
                            {{--<input type="checkbox" name="remember" id="remember">--}}
                            {{--<label for="remember">--}}
                                {{--<span class="checkbox-item">@svg('tick', 'icon-lg')</span>--}}
                                {{--Remember Me--}}
                            {{--</label>--}}
                        {{--</div>--}}
                        {{--<div class="field field--button">--}}

                        {{--</div>--}}
                    {{--</form>--}}
                    {{--@if (Route::has('password.request'))--}}
                        {{--<div class="forgotten-password">--}}
                            {{--<a href="{{ route('password.request') }}">Forgot your password?</a>--}}
                        {{--</div>--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}

@endsection

