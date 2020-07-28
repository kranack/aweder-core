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
            value="Delivery"
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
            value="Collection"
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
            <p class="cart__title">{{ item.product.title }}</p>
            <div class="increment increment--small">
              <span
                class="increment__type increment__type--down"
                @click="removeFromCart(item.product)"
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
                @click="addToCart(singleProduct(item.product))"
              >
                <Add />
              </span>
            </div>
            <span class="cart__price text-right">{{ item.product.price | currency }}</span>
          </div>
          <div class="cart__options">
            <h5 class="cart__option-title">Sauces</h5>
            <div class="cart__option-item">
              <p class="cart__subtitle">
                <span class="icon icon-add"><Add /></span>
                Curry sauce
              </p>
              <span class="cart__price text-right">£1.95</span>
            </div>
          </div>
        </div>
      </div>
      <div class="subtotal">
        <div class="subtotal__item">
          <p class="subtotal__title">Subtotal</p>
          <span class="cart__price text-right">{{ total | currency }}</span>
        </div>
        <div class="subtotal__item subtotal__item--light">
          <p class="subtotal__title">Delivery</p>
          <!-- <span class="cart__price text-right">£{{ $merchant->getFormattedUKPriceAttribute($merchant->delivery_cost) }}</span> -->
        </div>
      </div>
      <div class="total">
        <div class="total__item">
          <p class="total__title">Total</p>
          <!-- <span class="cart__price text-right">£{{ $order->getFormattedUKPriceAttribute($order->total_cost, $merchant->delivery_cost) }}</span> -->
        </div>
      </div>
    </div>
    <div class="cart__buttons">
      <button
        class="button "
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

  },
  data() {
    return {
      serviceType: 'Delivery',
    };
  },
  computed: {
    ...mapState([
      'cart',
    ]),
    ...mapGetters({
      total: 'cart/total',
      quantity: 'cart/quantity',
    }),
  },
  methods: {
    ...mapActions({
      addToCart: 'cart/addToCart',
      removeFromCart: 'cart/removeFromCart',
    }),
    singleProduct(product) {
      return {
        product,
        quantity: 1,
      };
    },
  },
};
</script>
