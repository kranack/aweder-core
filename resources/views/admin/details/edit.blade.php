@extends('global.admin')
@section('content')
    <header class="dashboard-header col-span-9 m-col-span-12 sm-col-span-6">
        <h1 class="dashboard-title header-one">{{ $merchant->name }} details</h1>
    </header>
    <section class="dashboard-content width-full col-span-9 m-col-span-12 sm-col-span-6 inline-grid grid-cols-9 m-grid-col-12 sm-grid-cols-6">
        <form
            class="form-inline col-span-6 m-col-span-12 sm-col-span-6 inline-grid grid-cols-6 m-grid-cols-12 sm-grid-cols-6"
            id="categoryForm"
            name="categoryForm"
            autocomplete="off"
            action="{{ route('admin.details.edit.post') }}"
            method="POST"
            enctype="multipart/form-data">
        @csrf
            <div class="field field--upload col-span-2 m-col-span-4 sm-col-span-2 sm-col-start-3 s-col-span-4 s-col-start-2 row-start-1 row-span-2 sm-row-span-1">
                <input type="file" name="logo" id="logo" class="upload-input" />
                <label class="upload" for="logo">
                    <span class="upload__trigger">
                        @if ($merchant->logo !== null)
                            <img src="{{ $merchant->getTemporaryLogoLink() }}" alt="{{ $merchant->name }}" />
                        @else
                            <span class="upload__icon">@svg('upload', 'fill-casablanca')</span>
                        @endif
                        <span class="upload__label">Upload your business logo</span>
                    </span>
                </label>
            </div>
            <div class="field col-span-4 m-col-span-8 sm-col-span-6">
                <label class="label label--float" for="description">Enter a description about your business and/or any notes’ <sup>*</sup></label>
                <textarea id="description" class="textarea-input" name="description" placeholder="Business description">{{ old('description') }}</textarea>
                @error('description')
                <p class="field__error">{{ $message }}</p>
                @enderror
            </div>
            <div class="field col-span-4 m-col-span-8 sm-col-span-6 @error('customer-phone-number') field--error @enderror">
                <label class="label label--float" for="customer-phone-number">Contact number<sup>*</sup></label>
                <input type="tel" name="customer-phone-number" tabindex="8" id="customer-phone-number" value="{{ old('customer-phone-number') }}" placeholder="Contact number" class="text-input" />
                @error('customer-phone-number')
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
            <x-stripe-payment-integration :merchant="$merchant" />
            <div class="field field--buttons col-span-6 m-col-span-12 sm-col-span-6 align-items-start s-align-items-stretch margin-top-50">
                <button type="submit" class="button button-solid--carnation s-width-full">
                    <span class="button__content">Save</span>
                </button>
            </div>
        </form>
    </section>
@endsection
