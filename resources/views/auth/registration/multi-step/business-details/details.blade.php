@extends('global.app')
@section('content')
    <section class="registration registration--user-details">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'business-details'"/>
                <form
                    class="col--lg-12-6 col--lg-offset-12-4 col--m-12-8 col--m-offset-12-3 col--sm-6-6 col--sm-offset-6-1"
                    id="signUpForm"
                    name="signUpForm"
                    autocomplete="off"
                    action="{{ route('register.business-details.post') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <p class="col col--lg-12-6 col--m-12-8 col-sm-6-6">Please enter your business details below:</p>
                    <div class="field field--upload col col--lg-12-2 col--m-12-3 col-sm-6-3">
                        <input type="file" name="logo" id="logo" class="upload-input" />
                        <label for="logo">
                            <span class="icon icon--upload">@svg('upload')</span>
                            <span class="upload-input-name">Click to upload your business logo</span>
                        </label>
                    </div>
                    <div class="field col--lg-12-4 col--m-12-5 col-sm-6-6 @error('name') input-error @enderror">
                        <label for="name">Your business name <abbr title="required">*</abbr></label>
                        <input type="text" name="name" id="name" tabindex="4"  value="{{ old('name') }}" placeholder="Business name" />
                        @error('name')
                        <p class="form__validation-error">{{ $message }}</p>
                        @enderror
                    </div>
                    <url-slug-checker
                        @if ($errors->has('url_slug')) :validation-error="true" @endif
                        @error('url_slug') validation-message="{{ $message }}" @enderror
                        @if (old('url_slug')) url-value="{{ old('url_slug') }}" @endif></url-slug-checker>
                    <div class="field field--wrapper col col--lg-12-6 col--m-12-8 col-sm-6-6">
                        <label for="description">Enter a description about your business and/or state any notes for your order form e.g. ‘This is Thursdays menu’ <abbr title="required">*</abbr></label>
                        <textarea name="description" tabindex="6" id="description">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="form__validation-error">{{ $message }}</p>
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
                    <div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 field--button">
                        <button type="submit" class="button button--icon-right button--filled button--filled-carnation button--end">
                            <span class="button__content">Next</span>
                            <span class="icon icon-right">@svg('arrow-right')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
