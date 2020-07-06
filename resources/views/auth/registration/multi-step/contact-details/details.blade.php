@extends('global.app')
@section('content')
    <section class="register register--contact-details">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'contact-details'"/>
                <form
                class="form-inline col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-6 m-grid-cols-10 sm-grid-cols-6"
                id="register"
                name="register"
                autocomplete="off"
                action="{{ route('register.contact-details.post') }}"
                method="POST">
                    @csrf
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('mobile-number') field--error @enderror">
                        <label class="label label--float" for="mobile-number">Mobile number (This remains private and may be used for future notifications)<sup>*</sup></label>
                        <input type="tel" name="mobile-number" tabindex="7" id="mobile-number" value="{{ old('mobile-number') }}" placeholder="Mobile number (private)" class="text-input" />
                        @error('mobile-number')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('customer-phone-number') field--error @enderror">
                        <label class="label label--float" for="customer-phone-number">Contact number (this is shown to customers)<sup>*</sup></label>
                        <input type="tel" name="customer-phone-number" tabindex="8" id="customer-phone-number" value="{{ old('customer-phone-number') }}" placeholder="Contact number" class="text-input" />
                        @error('customer-phone-number')
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
