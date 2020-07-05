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
          id="both"
          type="checkbox"
          name="collection_types[]"
          data-collection-type="table"
          class="collection--type"
          value="table"
          @change="showDeliveryData($event)"
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
    <div
      :class="{ show: showDeliveryFields, 'input-error': deliveryCostValidationMessage !== ''}"
      class="field field--price delivery col col--lg-12-6 col--m-12-8 col-sm-6-6"
    >
      <label for="delivery_cost">If delivery is chosen, what is the customer delivery charge (can be £0)</label>
      <input
        id="delivery_cost"
        type="text"
        name="delivery_cost"
        tabindex="4"
        value=""
      />
      <p
        v-if="deliveryCostValidationMessage !== ''"
        class="form__validation-error"
      >
        {{ deliveryCostValidationMessage }}
      </p>
    </div>
    <div
      :class="{ show: showDeliveryFields, 'input-error': deliveryRadiusValidationMessage !== ''}"
      class="field delivery col col--lg-12-6 col--m-12-8 col-sm-6-6"
    >
      <label for="delivery_radius">Delivery radius in miles</label>
      <input
        id="delivery_radius"
        type="text"
        name="delivery_radius"
        tabindex="4"
        placeholder="Delivery radius in miles"
        value=""
      />
      <p
        v-if="deliveryRadiusValidationMessage !== ''"
        class="form__validation-error"
      >
        {{ deliveryRadiusValidationMessage }}
      </p>
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
    deliveryRadiusValidationMessage: {
      type: String,
      default: '',
    },
    deliveryCostValidationMessage: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      showDeliveryFields: false,
    };
  },
  methods: {
    showDeliveryData() {
      this.showDeliveryFields = !this.showDeliveryFields;
    },
  },
};
</script>
