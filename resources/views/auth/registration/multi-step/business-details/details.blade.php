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
                    <div class="form-inline col-span-6 m-col-span-10 sm-col-span-6 inline-grid inline-grid grid-cols-6 m-grid-cols-10 sm-col-span-6 s-inline-flex s-flex-col">
                        <span class="label label--group col-span-6 m-col-span-10 sm-col-span-6 margin-bottom-20">Service options<sup>*</sup></span>
                        <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
                            <input type="checkbox" name="collection_type" data-collection-type="collection" class="hidden checkbox-input collection--type" id="allow-collection"  @if (old('collection_type') === 'collection') checked="checked" @endif value="collection">
                            <label class="checkbox checkbox--icon checkbox--icon-small" for="allow-collection">
                                <span class="checkbox__icon checkbox__icon--image checkbox__icon--small icon icon--collection">@svg('collection')</span>
                                <span class="checkbox__label checkbox__label--image checkbox__label--small">Collection</span>
                            </label>
                        </div>
                        <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
                            <input type="checkbox" name="delivery_type" data-collection-type="delivery" class="hidden checkbox-input collection--type" id="allow-delivery"  @if (old('delivery_type') === 'delivery') checked="checked" @endif value="delivery" />
                            <label class="checkbox checkbox--icon checkbox--icon-small" for="allow-delivery">
                                <span class="checkbox__icon checkbox__icon--image checkbox__icon--small icon icon--delivery">@svg('delivery')</span>
                                <span class="checkbox__label checkbox__label--image checkbox__label--small">Delivery</span>
                            </label>
                        </div>
                        <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
                            <input type="checkbox" name="table_type" data-collection-type="table" class="hidden checkbox-input collection--type" id="allow-table"  @if (old('table_type') === 'table') checked="checked" @endif value="table">
                            <label class="checkbox checkbox--icon checkbox--icon-small" for="allow-table">
                                <span class="checkbox__icon checkbox__icon--image checkbox__icon--small icon icon--table">@svg('table')</span>
                                <span class="checkbox__label checkbox__label--image checkbox__label--small">Table service</span>
                            </label>
                        </div>
                    </div>
                        <div class="field field--price field--price col-span-6 m-col-span-10 sm-col-span-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') field--error @enderror">
                        <label class="label label--float" for="delivery_cost">Delivery charge<sup>*</sup></label>
                        <input type="text" name="delivery_cost" id="delivery_cost" tabindex="4" value="{{ old('delivery_cost') }}" class="text-input text-input--price" />
                        @error('delivery_cost')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--delivery col-span-6 m-col-span-10 sm-col-span-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') field--error @enderror">
                        <label class="label label--float" for="name">Delivery radius in miles<sup>*</sup></label>
                        <input type="text" name="delivery_radius" id="delivery_radius" tabindex="4" placeholder="Delivery radius in miles" value="{{ old('delivery_radius') }}" class="text-input" />
                        @error('delivery_radius')
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
