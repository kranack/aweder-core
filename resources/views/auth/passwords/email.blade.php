@extends('global.app')

@section('content')
<section class="login">
    <div class="row">
        <div class="content">
            <div class="login__form col col--lg-12-6 col--lg-offset-12-4 col--l-12-6 col--l-offset-12-4 col--m-12-11 col--m-offset-12-1 col--sm-6-6 col--sm-offset-6-1 col--s-6-6">
                <header class="col col--lg-12-6 col--lg-offset-12-2 col--l-12-6 col--l-offset-12-1 col--m-12-11 col--m-offset-12-1 col--sm-6-6 col--sm-offset-6-1 col--s-6-6">
                    <h1 class="header header--three color--carnation spacer-bottom--40">Reset password</h1>
                </header>
                <p>Enter your login email address and we’ll send you an email with instructions on how to reset your password.</p>
                <form
                    id="signUpForm"
                    name="signUpForm"
                    class="form"
                    autocomplete="off"
                    action="{{ route('password.email') }}"
                    method="POST">
                    @csrf

                    <div class="field @error('email') input-error @enderror">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" />
                        @error('email')
                        <p class="form__validation-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--button">
                        <button type="submit" class="button button--icon-right button--filled button--filled-carnation button--start">
                            <span class="button__content">Reset password</span>
                            <span class="icon icon-right">@svg('arrow-right')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
