<template>
  <div class="single-order">
    <header class="single-order__header">
      <a class="single-order__back button button-outline--cloud-burst"
      @click.prevent="back()">
        <span class="button__icon button__icon--left"><ArrowLeft /></span>
        <span class="button__content">Return to orders</span>
      </a>
      <div class="single-order__title">
        <h2>
          <span class="status status--new"></span>
          <!-- @TODO table number or service type-->
          #Table 4
        </h2>
        <time :datetime="order.available_time">
          {{ order.available_time | moment('Mo MMMM YYYY, HH:mm') }}
        </time>
      </div>
      <div class="field field--select field--select-button background-carnation">
        <select name="status">
          <option value="pending">Pending</option>
          <option value="complete">Complete</option>
        </select>
        <span class="select-icon"><ArrowDown /></span>
      </div>
    </header>
    <div class="single-order__details">
      <div class="single-order__list">
        <h4>Customer details</h4>
        <ul>
          <li>{{ order.customer_name }}</li>
          <li>{{ order.customer_email }}</li>
          <li>{{ order.customer_address }}</li>
          <li>{{ order.customer_phone }}</li>
        </ul>
      </div>
      <div class="single-order__list">
        <h4>Payment information</h4>
        <ul>
          <li>{{ order.status }}</li>
          <li class="font-gibson-med">{{ order.total_cost | currency }}</li>
        </ul>
      </div>
    </div>
    <div class="single-order__items" v-if="order.items">
      <div class="single-order__item"
           v-for="(item, index) in order.items"
           :key="item.id">
        <div class="single-order__line">
          <div class="single-order__image">
            <img
            :src="item.order_inventory.image || 'https://source.unsplash.com/random/50x50?food'"
            alt="" class="width-full">
          </div>
          <p>{{ item.order_inventory.title }}</p>
          <span class="single-order__qty">{{ item.quantity }}</span>
          <span class="single-order__price">{{ item.price | currency }}</span>
        </div>
        <!-- @TODO add variants choices -->
        <div class="single-order__options">
          <h5 class="single-order__options-title">Sauces</h5>
          <p>Curry sauce</p>
          <span class="single-order__subprice"></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ArrowDown from '@/js/components/svgs/ArrowDown';
import ArrowLeft from '@/js/components/svgs/ArrowLeft';

export default {
  components: {
    ArrowDown,
    ArrowLeft,
  },
  props: {
    order: {
      type: Object,
      default: null,
    },
  },
  mounted() {
    console.log(window.currency);
  },
  methods: {
    back() {
      this.$emit('back');
    },
  },
};
</script>
