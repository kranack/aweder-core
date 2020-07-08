@extends('global.app')

@section('content')
    <section class="auth">
        <div class="row">
            <div class="content">
                <header class="auth__header col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1">
                    <h1 class="header-one color-carnation margin-bottom-40">Reset password</h1>
                    <p>Enter your login email address and we’ll send you an email with instructions on how to reset your password.</p>
                </header>
                <form class="col-span-6 col-start-4 sm-col-span-4 sm-col-start-2 s-col-span-6 s-col-start-1 inline-flex flex-col margin-bottom-60"
                      id="confirm-email"
                      name="confirmEmail"
                      autocomplete="off"
                      action="{{ route('password.email') }}"
                      method="POST">
                    @csrf
                    <div class="field @error('password') field--error @enderror">
                        <label for="email" class="label label--float">Email<sup>*</sup></label>
                        <input type="email" name="email" id="email" class="text-input" placeholder="Email" value="{{ old('email') }}" />
                        @error('email')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--buttons align-items-start margin-top-20 s-align-items-stretch">
                        <button type="submit" class="button button-solid--carnation">
                            <span class="button__content">Reset password</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
