@extends('global.app')
@section('content')
    <section class="register register--user-details">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'user-details'"/>
                <form
                class="form-inline col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-6 m-grid-cols-10 sm-grid-cols-6"
                id="register"
                name="register"
                autocomplete="off"
                action="{{ route('register.user-details.post') }}"
                method="POST">
                @csrf
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('email')field--error @enderror">
                        <label class="label label--float" for="email">Email<sup>*</sup></label>
                        <input type="email" name="email" id="email" tabindex="1"  value="{{ old('email') }}" placeholder="Email" class="text-input" />
                        @error('email')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('password')field--error @enderror">
                        <label class="label label--float" for="password">Enter a strong password<sup>*</sup></label>
                        <input type="password" name="password" tabindex="2"  id="password" placeholder="Password" class="text-input" />
                        @error('password')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('password-confirmeds')field--error @enderror">
                        <label class="label label--float" for="password-confirmed">Confirm password<sup>*</sup></label>
                        <input type="password" name="password-confirmed" tabindex="3"  id="password-confirmed" placeholder="Confirm password" class="text-input" />
                        @error('password-confirmed')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--buttons col-span-6 m-col-span-10 sm-col-span-6 align-items-start s-align-items-stretch margin-top-20">
                        <button type="submit" class="button button-solid--carnation s-width-full">
                            <span class="button__content">Next</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
