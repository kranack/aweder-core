<template>
  <popup
    v-if="product"
    ref="item_options"
    :is-active="!!product"
    @close="close()"
  >
    <div>
      <h2 class="item-options__heading">
        {{ product.title }}
      </h2>

      <!-- Product variants -->
      <div
        v-if="product.variants.length"
        class="item-options__field"
      >
        <h3 class="item-options__field-title">Variants</h3>

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
            <span class="radio__icon radio__icon--large" />
            <span class="radio__label radio__label--large">
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
        class="item-options__field"
      >
        <div
          v-for="group in product.option_groups"
          :key="group.id"
        >
          <h3 class="item-options__field-title">{{ group.title }}</h3>

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
              <span class="checkbox__icon checkbox__icon--large" />
              <span class="checkbox__label checkbox__label--large">
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
      <h3 class="item-options__field-title">
        Quantity
      </h3>

      <div class="increment increment--large">
        <button
          class="increment__type increment__type--down"
          @click="decrement"
        >
          <Minus />
        </button>
        <input
          type="text"
          class="increment__value"
          :value="quantity"
        >
        <button
          class="increment__type increment__type--up"
          @click="increment"
        >
          <Add />
        </button>
      </div>
      <button
        ref="add_item"
        class="item-options__submit"
        @click="add()"
      >
        <span class="button__content">Add item</span>
      </button>
    </div>
  </popup>
</template>

<script>
import Popup from '@/js/components/shared/Popup';
import orderApi from '@/js/api/order/order';
import Add from '@/js/components/svgs/Add';
import Minus from '@/js/components/svgs/Minus';
import { mapState } from 'vuex';

export default {
  components: {
    Popup,
    Add,
    Minus,
  },
  data() {
    return {
      quantity: 1,
      options: [],
      selectedVariant: null,
    };
  },
  computed: {
    ...mapState({
      product: (state) => state.activeProduct.product,
    }),
  },
  methods: {
    add() {
      orderApi.create({})
        .then((res) => {
        })
        .catch((err) => {
        });

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
    increment() {
      this.quantity += 1;
    },
    decrement() {
      this.quantity = this.quantity > 1
        ? this.quantity - 1
        : 1;
    },
  },
};
</script>
