<template>
  <div 
    class="cart panel panel--radius-bottom background-off-white col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-col-span-6 sm-col-start-1"
    :class="{ 'cart--empty': !quantity }"
  >
    <div v-if="quantity">
      <div class="cart__service flex align-items-center">
        <div class="field field--radio">
          <input
            id="delivery"
            v-model="serviceType"
            value="delivery"
            type="radio"
            name="service"
            class="radio-input hidden"
          >
          <label
            for="delivery"
            class="radio radio--standard"
          >
            <span class="radio__icon radio__icon--small" />
            <span class="radio__label radio__label--small">Delivery</span>
          </label>
        </div>
        <div class="field field--radio">
          <input
            id="collection"
            v-model="serviceType"
            value="collection"
            type="radio"
            name="service"
            class="radio-input hidden"
          >
          <label
            for="collection"
            class="radio radio--standard"
          >
            <span class="radio__icon radio__icon--small" />
            <span class="radio__label radio__label--small">Collection</span>
          </label>
        </div>
      </div>
      <div class="cart__order">
        <div
          v-for="(item, index) in cart.products"
          :key="index"
          class="cart__item"
        >
          <div class="cart__line">
            <p class="cart__title">
              {{ getProductTitle(item) }}
            </p>
            <div class="increment increment--small">
              <span
                class="increment__type increment__type--down"
                @click="removeFromCart(item.id)"
              >
                <Minus />
              </span>
              <input
                type="text"
                class="increment__value"
                :value="item.quantity"
              >
              <span
                class="increment__type increment__type--up"
                @click="incrementProduct(item.id)"
              >
                <Add />
              </span>
            </div>
            <span class="cart__price text-right">{{ getProductPrice(item) | currency }}</span>
          </div>
          <div
            v-for="(group, groupName) in item.options"
            v-show="group.length"
            :key="groupName"
            class="cart__options"
          >
            <h5 class="cart__option-title">
              {{ groupName }}
            </h5>
            <div
              v-for="option in group"
              :key="option.id"
              class="cart__option-item"
            >
              <p class="cart__subtitle">
                <span class="icon icon-add"><Add /></span>
                {{ option.name }}
              </p>
              <span class="cart__price text-right">{{ option.price_modified | currency }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="subtotal">
        <div class="subtotal__item">
          <p class="subtotal__title">
            Subtotal
          </p>
          <span class="cart__price text-right">{{ subtotal | currency }}</span>
        </div>
        <div
          ref="delivery"
          class="subtotal__item subtotal__item--light"
        >
          <p class="subtotal__title">
            Delivery
          </p>
          <span
            v-if="isDelivery"
            class="cart__price text-right"
          >
            {{ merchant.delivery_cost | currency }}
          </span>
          <span
            v-else
            class="cart__price text-right"
          >
            £--.--
          </span>
        </div>
      </div>
      <div class="total">
        <div class="total__item">
          <p class="total__title">
            Total
          </p>
          <span class="cart__price text-right">{{ total | currency }}</span>
        </div>
      </div>
    </div>
    <div class="cart__buttons">
      <button
        class="button"
        :class="quantity ? 'button-solid--carnation' : 'button-outline--silver'"
      >
        <span class="button__content">Place order</span>
      </button>
    </div>
  </div>
</template>

<script>
import Add from '@/js/components/svgs/Add';
import Minus from '@/js/components/svgs/Minus';
import { mapState, mapGetters, mapActions } from 'vuex';

export default {
  components: {
    Add,
    Minus,
  },
  props: {
    merchant: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      serviceType: 'delivery',
    };
  },
  computed: {
    ...mapState([
      'cart',
    ]),
    ...mapGetters({
      subtotal: 'cart/subtotal',
      quantity: 'cart/quantity',
    }),
    total() {
      return this.subtotal + this.extraCharges;
    },
    extraCharges() {
      if (this.isDelivery && this.deliveryCost) {
        return this.deliveryCost;
      }
      return 0;
    },
    isDelivery() {
      return this.serviceType === 'delivery';
    },
    deliveryCost() {
      return this.merchant.delivery_cost;
    },
  },
  methods: {
    ...mapActions({
      addToCart: 'cart/addToCart',
      removeFromCart: 'cart/removeFromCart',
      incrementProduct: 'cart/incrementProduct',
    }),
    isVariant(item) {
      return !!item.variant;
    },
    getProductTitle(item) {
      return this.isVariant(item)
        ? `${item.variant.name} - ${item.product.title}`
        : item.product.title;
    },
    getProductPrice(item) {
      return this.isVariant(item)
        ? item.variant.price
        : item.product.price;
    },
  },
};
</script>
