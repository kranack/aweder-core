@extends('global.app')
@section('content')
    <section class="register register--business-address">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'business-address'"/>
                <form
                class="form-inline col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-6 m-grid-cols-10 sm-grid-cols-6"
                id="register"
                name="register"
                autocomplete="off"
                action="{{ route('register.business-address.post') }}"
                method="POST">
                    @csrf
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('address-name-number') field--error @enderror">
                        <label class="label label--float" for="address-name-number">Building number or name <sup>*</sup></label>
                        <input type="text" name="address-name-number" tabindex="9" id="address-name-number" value="{{ old('address-name-number') }}" placeholder="Building number" class="text-input" />
                        @error('address-name-number')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('address-street') field--error @enderror">
                        <label class="label label--float" for="address-street">Street <sup>*</sup></label>
                        <input type="text" name="address-street" tabindex="10" id="address-street" value="{{ old('address-street') }}" placeholder="Street" class="text-input" />
                        @error('address-street')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('address-city') field--error @enderror">
                        <label class="label label--float" for="address-city">Town or Locality <sup>*</sup></label>
                        <input type="text" name="address-city" tabindex="12" id="address-city" value="{{ old('address-city') }}" placeholder="City" class="text-input" />
                        @error('address-city')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 @error('address-county') field--error @enderror">
                        <label class="label label--float" for="address-county">County <sup>*</sup></label>
                        <input type="text" name="address-county" tabindex="13" id="address-county" value="{{ old('address-county') }}" placeholder="County" class="text-input" />
                        @error('address-county')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field col-span-3 m-col-span-5 sm-col-span-3 @error('address-postcode') field--error @enderror">
                        <label class="label label--float" for="address-postcode">Postcode <sup>*</sup></label>
                        <input type="text" name="address-postcode" tabindex="14" id="address-postcode" value="{{ old('address-postcode') }}" placeholder="Postcode" class="text-input" />
                        @error('address-postcode')
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
