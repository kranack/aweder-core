@extends('global.app')
@section('content')
    <section class="register register--business-details">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'business-details'"/>
                <form
                    class="form-inline col-span-6 col-start-4 m-col-span-10 m-col-start-2 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-6 m-grid-cols-10 sm-grid-cols-6"
                    id="register"
                    name="register"
                    autocomplete="off"
                    action="{{ route('register.business-details.post') }}"
                    method="POST">
                    @csrf
                    <div class="field field--upload col-span-2 m-col-span-4 sm-col-span-2 sm-col-start-3 s-col-span-4 s-col-start-2 row-start-1 row-span-2 sm-row-span-1">
                        <input type="file" name="logo" id="logo" class="upload-input" />
                        <label class="upload" for="logo">
                            <span class="upload__trigger">
                                <span class="upload__icon">@svg('upload', 'fill-casablanca')</span>
                                <span class="upload__label">Upload your business logo</span>
                            </span>
                        </label>
                    </div>
                    <div class="field col-span-4 m-col-span-6 sm-col-span-6 @error('name') field--error @enderror">
                        <label class="label label--float" for="name">Business name<sup >*</sup></label>
                        <input type="text" name="name" id="name" tabindex="4"  value="{{ old('name') }}" placeholder="Business name" class="text-input" />
                        @error('name')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <url-slug-checker @if ($errors->has('url-slug')) :validation-error="true" @endif @error('url-slug') validation-message="{{ $message }}" @enderror url-value="{{ old('url-slug') }}"></url-slug-checker>
                    <div class="field col-span-6 m-col-span-10 sm-col-span-6 margin-top-20 sm-margin-top-0">
                        <label class="label label--float" for="description">Enter a description about your business and/or any notes’ <sup>*</sup></label>
                        <textarea name="description" tabindex="6" id="description" class="textarea-input" placeholder="About your business">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <merchant-order-types
                        @if (old('collection_types')) :collection-types="'{{json_encode(old('collection_types')) }}'" @endif
                        @error('collection_types') collection-type-validation-message="{{ $message  }}" @enderror
                        @error('delivery_radius') delivery-radius-validation-message="{{ $message }}" @enderror
                        @error('delivery_cost') delivery-cost-validation-message="{{ $message }}" @enderror
                        @if (old('delivery_radius')) delivery-radius="{{ old('delivery_radius') }}" @endif
                        @if (old('delivery_cost')) delivery-cost="{{ old('delivery_cost') }}" @endif
                    ></merchant-order-types>
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
