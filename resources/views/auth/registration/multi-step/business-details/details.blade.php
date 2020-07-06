@extends('global.app')
@section('content')
    <section class="register register--user-details">
        <div class="row">
            <div class="content">
                <x-registration-steps :stage="'business-details'"/>
                <form
                    class="form-inline col-span-6 col-start-4 m-col-span-8 m-col-start-3 sm-col-span-6 sm-col-start-1 inline-grid grid-cols-6 m-grid-cols-8 sm-grid-cols-6"
                    id="register"
                    name="register"
                    autocomplete="off"
                    action="{{ route('register.business-details.post') }}"
                    method="POST">
                    @csrf
                    <div class="field field--upload col-span-2 m-col-span-2 sm-col-span-3 row-start-1 row-span-2 sm-row-span-1">
                        <input type="file" name="logo" id="logo" class="upload-input" />
                        <label for="logo">
                            <span class="icon icon--upload">@svg('upload')</span>
                            <span class="upload-input-name">Upload your business logo</span>
                        </label>
                    </div>
                    <div class="field col-span-4 m-col-span-8 sm-col-span-6 @error('name') field--error @enderror">
                        <label class="label label--float" for="name">Business name<sup >*</sup></label>
                        <input type="text" name="name" id="name" tabindex="4"  value="{{ old('name') }}" placeholder="Business name" class="text-input" />
                        @error('name')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <url-slug-checker @if ($errors->has('url-slug')) :validation-error="true" @endif @error('url-slug') validation-message="{{ $message }}" @enderror url-value="{{ old('url-slug') }}"></url-slug-checker>
                    <div class="field col-span-6 m-col-span-8 sm-col-span-6">
                        <label class="label label--float" for="description">Enter a description about your business and/or any notes’ <abbr title="required">*</abbr></label>
                        <textarea name="description" tabindex="6" id="description" class="textarea-input" placeholder="About your business">{{ old('description') }}</textarea>
                        @error('description')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="form-inline col-span-6 m-col-span-8 sm-col-span-6 inline-grid inline-grid grid-cols-6 m-grid-cols-8 sm-col-span-6 s-inline-flex s-flex-col">
                        <span class="label label--group col-span-6 m-col-span-8 sm-col-span-6 margin-bottom-40">Service options<sup>*</sup></span>
                        <div class="field field--checkbox col-span-2 sm-col-span-2 s-col-span-6">
                            <input type="checkbox" name="collection_type" data-collection-type="collection" class="hidden collection--type" id="allow-collection"  @if (old('collection_type') === 'collection') checked="checked" @endif value="collection">
                            <label for="allow-collection">Collection</label>
                        </div>
                        <div class="field field--checkbox col-span-2 sm-col-span-2 s-col-span-6">
                            <input type="checkbox" name="delivery_type" data-collection-type="delivery" class="hidden collection--type" id="allow-delivery"  @if (old('delivery_type') === 'delivery') checked="checked" @endif value="delivery">
                            <label for="allow-delivery">Delivery</label>
                        </div>
                        <div class="field field--checkbox col-span-2 sm-col-span-2 s-col-span-6">
                            <input type="checkbox" name="table_type" data-collection-type="table" class="hidden collection--type" id="allow-table"  @if (old('table_type') === 'table') checked="checked" @endif value="table">
                            <label for="allow-table">Table service</label>
                        </div>
                    </div>
                    <div class="field field--price field--delivery col-span-6 m-col-span-8 sm-col-span-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') field--error @enderror">
                        <label class="label label--float" for="delivery_cost">Delivery charge<sup>*</sup></label>
                        <input type="text" name="delivery_cost" id="delivery_cost" tabindex="4" value="{{ old('delivery_cost') }}" class="text-input" />
                        @error('delivery_cost')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--delivery col-span-6 m-col-span-8 sm-col-span-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') field--error @enderror">
                        <label class="label label--float" for="name">Delivery radius in miles<sup>*</sup></label>
                        <input type="text" name="delivery_radius" id="delivery_radius" tabindex="4" placeholder="Delivery radius in miles" value="{{ old('delivery_radius') }}" class="text-input" />
                        @error('delivery_radius')
                        <p class="field__error">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="field field--buttons col-span-6 m-col-span-8 sm-col-span-6 align-items-start s-align-items-stretch margin-top-20">
                        <button type="submit" class="button button-solid--carnation s-width-full">
                            <span class="button__content">Next</span>
                            <span class="button__icon button__icon--right">@svg('arrow-right', 'fill-ecru-white')</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    {{--<section class="registration registration--user-details">--}}
        {{--<div class="row">--}}
            {{--<div class="content">--}}
                {{--<x-registration-steps :stage="'business-details'"/>--}}
                {{--<form--}}
                    {{--class="col--lg-12-6 col--lg-offset-12-4 col--m-12-8 col--m-offset-12-3 col--sm-6-6 col--sm-offset-6-1"--}}
                    {{--id="signUpForm"--}}
                    {{--name="signUpForm"--}}
                    {{--autocomplete="off"--}}
                    {{--action="{{ route('register.business-details.post') }}"--}}
                    {{--method="POST"--}}
                    {{--enctype="multipart/form-data">--}}
                    {{--@csrf--}}
                    {{--<p class="col col--lg-12-6 col--m-12-8 col-sm-6-6">Please enter your business details below:</p>--}}
                    {{--<div class="field field--upload col col--lg-12-2 col--m-12-3 col-sm-6-3">--}}
                        {{--<input type="file" name="logo" id="logo" class="upload-input" />--}}
                        {{--<label for="logo">--}}
                            {{--<span class="icon icon--upload">@svg('upload')</span>--}}
                            {{--<span class="upload-input-name">Click to upload your business logo</span>--}}
                        {{--</label>--}}
                    {{--</div>--}}
                    {{--<div class="field col--lg-12-4 col--m-12-5 col-sm-6-6 @error('name') input-error @enderror">--}}
                        {{--<label for="name">Your business name <abbr title="required">*</abbr></label>--}}
                        {{--<input type="text" name="name" id="name" tabindex="4"  value="{{ old('name') }}" placeholder="Business name" />--}}
                        {{--@error('name')--}}
                        {{--<p class="form__validation-error">{{ $message }}</p>--}}
                        {{--@enderror--}}
                    {{--</div>--}}
                    {{--<url-slug-checker @if ($errors->has('url-slug')) :validation-error="true" @endif @error('url-slug') validation-message="{{ $message }}" @enderror url-value="{{ old('url-slug') }}"></url-slug-checker>--}}
                    {{--<div class="field field--wrapper col col--lg-12-6 col--m-12-8 col-sm-6-6">--}}
                        {{--<label for="description">Enter a description about your business and/or state any notes for your order form e.g. ‘This is Thursdays menu’ <abbr title="required">*</abbr></label>--}}
                        {{--<textarea name="description" tabindex="6" id="description">{{ old('description') }}</textarea>--}}
                        {{--@error('description')--}}
                        {{--<p class="form__validation-error">{{ $message }}</p>--}}
                        {{--@enderror--}}
                    {{--</div>--}}
                    {{--<div class="field field--wrapper col col--lg-12-6 col--m-12-8 col-sm-6-6">--}}
                        {{--<header class="section-title">--}}
                            {{--<h3 class="header header--five color--carnation spacer-bottom--30">How will customers receive their orders <abbr title="required">*</abbr></h3>--}}
                        {{--</header>--}}
                        {{--<div class="field field--radio">--}}
                            {{--<input type="radio" name="collection_type" data-collection-type="collection" class="collection--type"  id="allow-collection"  @if (old('collection_type') === 'collection') checked="checked" @endif value="collection">--}}
                            {{--<label for="allow-collection">Collection</label>--}}
                        {{--</div>--}}
                        {{--<div class="field field--radio">--}}
                            {{--<input type="radio" name="collection_type" data-collection-type="delivery" class="collection--type" tabindex="7" @if (old('collection_type') === 'delivery') checked="checked" @endif id="allow-delivery" value="delivery">--}}
                            {{--<label for="allow-delivery">Delivery</label>--}}
                        {{--</div>--}}
                        {{--<div class="field field--radio">--}}
                            {{--<input type="radio" name="collection_type" data-collection-type="delivery" class="collection--type" id="both"  @if (old('collection_type') === 'both') checked="checked" @endif value="both">--}}
                            {{--<label for="both">Delivery & Collection</label>--}}
                        {{--</div>--}}
                        {{--@error('collection_type')--}}
                        {{--<p class="form__validation-error">{{ $message }}</p>--}}
                        {{--@enderror--}}
                    {{--</div>--}}
                        {{--<div class="field field--price delivery col col--lg-12-6 col--m-12-8 col-sm-6-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') input-error @enderror">--}}
                            {{--<label for="name">If delivery is chosen, what is the customer delivery charge (can be £0)</label>--}}
                            {{--<input type="text"--}}
                                   {{--name="delivery_cost"--}}
                                   {{--id="delivery_cost"--}}
                                   {{--tabindex="4"--}}
                                   {{--value="{{ old('delivery_cost') }}" />--}}
                            {{--@error('delivery_cost')--}}
                            {{--<p class="form__validation-error">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                        {{--<div class="field delivery col col--lg-12-6 col--m-12-8 col-sm-6-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') input-error @enderror">--}}
                            {{--<label for="name">Delivery radius in miles</label>--}}
                            {{--<input type="text"--}}
                                   {{--name="delivery_radius"--}}
                                   {{--id="delivery_radius"--}}
                                   {{--tabindex="4"--}}
                                   {{--placeholder="Delivery radius in miles"--}}
                                   {{--value="{{ old('delivery_radius') }}" />--}}
                            {{--@error('delivery_radius')--}}
                            {{--<p class="form__validation-error">{{ $message }}</p>--}}
                            {{--@enderror--}}
                        {{--</div>--}}
                    {{--<div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 field--button">--}}
                        {{--<button type="submit" class="button button--icon-right button--filled button--filled-carnation button--end">--}}
                            {{--<span class="button__content">Next</span>--}}
                            {{--<span class="icon icon-right">@svg('arrow-right')</span>--}}
                        {{--</button>--}}
                    {{--</div>--}}
                {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
@endsection
