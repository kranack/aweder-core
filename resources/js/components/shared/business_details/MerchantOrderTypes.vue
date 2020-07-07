<template>
  <div>
    <div class="form-inline col-span-6 m-col-span-10 sm-col-span-6 inline-grid inline-grid
     grid-cols-6 m-grid-cols-10 sm-col-span-6 s-inline-flex s-flex-col"
    >
      <span class="label label--group col-span-6 m-col-span-10 sm-col-span-6 margin-bottom-20">
        Service options<sup>*</sup>
      </span>
      <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
        <input
          id="allow-collection"
          type="checkbox"
          name="collection_types[]"
          data-collection-type="collection"
          class="hidden checkbox-input collection--type"
          value="collection"
          :checked="doesOrderTypeExist('collection')"
        >
        <label class="checkbox checkbox--icon checkbox--icon-small" for="allow-collection">
          <span class="checkbox__icon checkbox__icon--image checkbox__icon--small
            icon icon--collection"
          >
            <Collection />
          </span>
          <span class="checkbox__label checkbox__label--image checkbox__label--small">
            Collection
          </span>
        </label>
      </div>
      <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
        <input
          id="allow-delivery"
          type="checkbox"
          name="collection_types[]"
          data-collection-type="delivery"
          class="hidden checkbox-input collection--type"
          value="delivery"
          :checked="doesOrderTypeExist('delivery')"
          @change="showDeliveryData($event)"
        >
        <label class="checkbox checkbox--icon checkbox--icon-small" for="allow-delivery">
          <span class="checkbox__icon checkbox__icon--image
            checkbox__icon--small icon icon--delivery"
          >
            <Delivery />
          </span>
          <span class="checkbox__label checkbox__label--image checkbox__label--small">
            Delivery
          </span>
        </label>
      </div>
      <div class="field field--checkbox col-span-2 m-col-span-3 sm-col-span-3 s-col-span-6">
        <input
          id="table"
          type="checkbox"
          name="collection_types[]"
          data-collection-type="table"
          class="hidden checkbox-input collection--type"
          value="table"
          :checked="doesOrderTypeExist('table')"
        >
        <label class="checkbox checkbox--icon checkbox--icon-small" for="table">
          <span class="checkbox__icon checkbox__icon--image checkbox__icon--small icon icon--table">
            <Table />
          </span>
          <span class="checkbox__label checkbox__label--image checkbox__label--small">
            Table service
          </span>
        </label>
      </div>
    </div>
    <p
      v-if="collectionTypeValidationMessage !== ''"
      class="field__error"
    >
      {{ collectionTypeValidationMessage }}
    </p>
    <div v-if="showDeliveryFields">
      <div class="field field--price field--price col-span-6 m-col-span-10 sm-col-span-6"
           :class="{'field__error': deliveryCostValidationMessage !== ''}"
      >
        <label class="label label--float" for="delivery_cost">Delivery charge<sup>*</sup></label>
        <input
          id="delivery_cost"
          type="text"
          name="delivery_cost"
          tabindex="4"
          class="text-input text-input--price"
          :value="deliveryCost"
        >
        <p
          v-if="deliveryCostValidationMessage !== ''"
          class="field__error"
        >
          {{ deliveryCostValidationMessage }}
        </p>
      </div>

      <div
        class="field field--delivery col-span-6 m-col-span-10 sm-col-span-6"
         :class="{'field__error': deliveryRadiusValidationMessage !== ''}"
      >
        <label class="label label--float" for="name">Delivery radius in miles<sup>*</sup></label>
        <input
          id="delivery_radius"
          type="text"
          name="delivery_radius"
          class="text-input"
          tabindex="4"
          placeholder="Delivery radius in miles"
          :value="deliveryRadius"
        >
        <p
          v-if="deliveryRadiusValidationMessage !== ''"
          class="field__error"
        >
          {{ deliveryRadiusValidationMessage }}
        </p>
      </div>
    </div>
  </div>
</template>
<script>
import Delivery from '@/js/components/svgs/Delivery';
import Collection from '@/js/components/svgs/Collection';
import Table from '@/js/components/svgs/Table';

export default {
  name: 'MerchantOrderTypes',
  components: {
    Delivery,
    Collection,
    Table,
  },
  props: {
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
    collectionTypes: {
      type: String,
      default: '',
    },
    deliveryRadius: {
      type: String,
      default: '',
    },
    deliveryCost: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      showDeliveryFields: false,
    };
  },
  created() {
    if (this.deliveryRadiusValidationMessage !== ''
      || this.deliveryCostValidationMessage !== '') {
      this.showDeliveryFields = true;
    }
  },
  methods: {
    showDeliveryData() {
      this.showDeliveryFields = !this.showDeliveryFields;
    },
    doesOrderTypeExist(collectionType) {
      if (this.collectionTypes !== '') {
        const submittedCollectionType = JSON.parse(this.collectionTypes);
        return submittedCollectionType.find((type) => type === collectionType);
      }
      return false;
    },
  },
};
</script>
