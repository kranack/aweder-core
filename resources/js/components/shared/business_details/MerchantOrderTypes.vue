<template>
  <div>
    <div class="field field--wrapper col col--lg-12-6 col--m-12-8 col-sm-6-6">
      <header class="section-title">
        <h3 class="header header--five color--carnation spacer-bottom--30">
          How can customers place orders <abbr title="required">*</abbr>
        </h3>
      </header>
      <div class="field field--radio">
        <input
          type="checkbox"
          name="collection_types[]"
          data-collection-type="collection"
          class="collection--type"
          id="allow-collection"
          value="collection"
        >
        <label for="allow-collection">Collection</label>
      </div>
      <div class="field field--radio">
        <input
          type="checkbox"
          name="collection_types[]"
          id="allow-delivery"
          data-collection-type="delivery"
          class="collection--type"
          tabindex="7"
          value="delivery"
        >
        <label for="allow-delivery">Delivery</label>
      </div>
      <div class="field field--radio">
        <input
          type="checkbox"
          name="collection_types[]"
          data-collection-type="table"
          class="collection--type"
          id="both"
          value="table"
          >
        <label for="both">Table Service</label>
      </div>
      <p
        v-if="collectionTypeValidationError"
        class="form__validation-error"
      >
        {{ collectionTypeValidationMessage }}
      </p>
    </div>
    <div class="field field--price delivery col col--lg-12-6 col--m-12-8 col-sm-6-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') input-error @enderror">
      <label for="name">If delivery is chosen, what is the customer delivery charge (can be £0)</label>
      <input type="text"
             name="delivery_cost"
             id="delivery_cost"
             tabindex="4"
             value="" />
      @error('delivery_cost')
      <p class="form__validation-error">{{ $message }}</p>
      @enderror
    </div>
    <div class="field delivery col col--lg-12-6 col--m-12-8 col-sm-6-6 @if(!$errors->isEmpty()) show @endif @error('delivery_cost') input-error @enderror">
      <label for="name">Delivery radius in miles</label>
      <input type="text"
             name="delivery_radius"
             id="delivery_radius"
             tabindex="4"
             placeholder="Delivery radius in miles"
             value="" />
      @error('delivery_radius')
      <p class="form__validation-error">{{ $message }}</p>
      @enderror
    </div>
  </div>
</template>
<script>
export default {
  name: 'MerchantOrderTypes',
  props: {
    collectionTypeValidationError: {
      type: Boolean,
      default: false,
    },
    collectionTypeValidationMessage: {
      type: String,
      default: '',
    },
  },
};
</script>
