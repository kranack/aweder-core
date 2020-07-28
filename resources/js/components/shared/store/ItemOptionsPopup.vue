<template>
  <popup
    v-if="product"
    :is-active="!!product"
    @close="close()"
  >
    <div >
      <h2 class="body-xlarge border-bottom-solid border-silver-5 border-width-1 margin-bottom-20 padding-bottom-30">
        {{ product.title }}
      </h2>

      <!-- Product variants -->
      <div
        v-if="product.variants.length"
        class="border-bottom-solid border-silver-5 border-width-1 margin-bottom-20"
      >
        <h3>Variants</h3>

        <div
          v-for="variant in product.variants"
          :key="variant.id"
          class="field field--radio margin-top-10"
        >
          <input
            :id="variant.name"
            v-model="selectedVariant"
            :value="variant.id"
            type="radio"
            name="ariant.name"
            class="radio-input hidden"
          >
          <label
            :for="variant.name"
            class="radio radio--standard"
          >
            <span class="radio__icon radio__icon--small" />
            <span class="radio__label radio__label--small">
              {{ variant.name }}
              <span class="margin-left-5 margin-right-5">&ndash;</span>
              {{ variant.price | currency }}
            </span>
          </label>
        </div>
      </div>

      <!-- Product options -->
      <div
        v-if="product.option_groups.length"
        class="border-bottom-solid border-silver-5 border-width-1 margin-bottom-20"
      >
        <div
          v-for="group in product.option_groups"
          :key="group.id"
        >
          <h3>{{ group.title }}</h3>

          <div
            v-for="item in group.items"
            :key="item.id"
            class="field margin-top-10"
          >
            <input
              :id="item.name + item.id"
              v-model="options"
              :value="item.id"
              type="checkbox"
              :name="item.id"
              class="checkbox-input hidden"
            >
            <label
              :for="item.name + item.id"
              class="checkbox checkbox--standard"
            >
              <span class="checkbox__icon checkbox__icon--small"></span>
              <span class="checkbox__label checkbox__label--small">
                {{ item.name }}
                <span class="margin-left-5 margin-right-5">&ndash;</span>
                {{ item.price_modified | currency }}
              </span>
            </label>
          </div>
        </div>
      </div>
    </div>
    <div>
      <h3>Quantity</h3>

      <input
        v-model.number="quantity"
        type="number"
        name="quanaity"
        min="1"
      >
      <button
        class="button button-solid--carnation button--wide margin-top-20"
        @click="add()"
      >
        <span class="button__content">Add item</span>
      </button>
    </div>
  </popup>
</template>

<script>
import Popup from '@/js/components/shared/Popup';

export default {
  components: {
    Popup,
  },
  data() {
    return {
      quantity: 1,
      options: [],
      selectedVariant: null,
    };
  },
  computed: {
    product() {
      return this.$store.state.activeProduct.product;
    },
  },
  mounted() {
    // this.$refs.take_away.focus();
  },
  methods: {
    add() {
      this.$store.dispatch('cart/addToCart', {
        product: this.product,
        variant: this.selectedVariant,
        options: this.options,
        quantity: this.quantity,
      });

      this.close();
    },
    close() {
      this.quantity = 1;
      this.$store.dispatch('activeProduct/removeActiveProduct');
    },
  },
};
</script>
