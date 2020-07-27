<template>
  <div class="single-order">
    <header class="single-order__header">
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
        <div class="single-order__options">
          <h5 class="single-order__options-title">Sauces</h5>
          <p>Curry sauce</p>
          <span class="single-order__subprice"></span>
        </div>
      </div>
    </div>


    <!--<div class="flex align-items-center padding-40 border-bottom-solid border-width-1 border-silver-5">-->
      <!--<div class="margin-right-auto">-->
        <!--<h2 class="flex align-items-center">-->
          <!--<span class="status status&#45;&#45;new" />-->
          <!--Table #4-->
        <!--</h2>-->
        <!--<time-->
          <!--class="block margin-top-20 margin-left-20"-->
          <!--:datetime="order.available_time"-->
        <!--&gt;-->
          <!--{{ order.available_time | moment('Mo MMMM YYYY, HH:mm') }}-->
        <!--</time>-->
      <!--</div>-->
      <!--<div>-->
        <!--<a-->
          <!--class="hidden l-block cursor-pointer margin-bottom-10 color-cloud-burst-8"-->
          <!--@click.prevent="back()"-->
        <!--&gt;-->
          <!--Return to orders-->
        <!--</a>-->
        <!--<div class="order__select">-->
          <!--<select name="status">-->
            <!--<option value="pending">Pending</option>-->
            <!--<option value="complete">Complete</option>-->
          <!--</select>-->
          <!--<span class="order__select-icon"><ArrowDown /></span>-->
        <!--</div>-->
      <!--</div>-->
    <!--</div>-->
    <!--<div class="padding-40 flex border-bottom-solid border-width-1 border-silver-5">-->
      <!--<div class="width-full">-->
        <!--<h3 class="body-large">-->
          <!--Customer details-->
        <!--</h3>-->
        <!--<ul>-->
          <!--<li class="margin-top-15">{{ order.customer_name }}</li>-->
          <!--<li class="margin-top-10">{{ order.customer_email }}</li>-->
          <!--<li class="margin-top-10">{{ order.customer_address }}</li>-->
          <!--<li class="margin-top-10">{{ order.customer_phone }}</li>-->
        <!--</ul>-->
      <!--</div>-->
      <!--<div class="width-full">-->
        <!--<h3 class="body-large">-->
          <!--Payment information-->
        <!--</h3>-->
        <!--<ul>-->
          <!--<li class="margin-top-15">-->
            <!--Status: {{ order.status }}-->
          <!--</li>-->
          <!--<li class="margin-top-10">-->
            <!--<strong>{{ order.total_cost | currency }}</strong>-->
          <!--</li>-->
        <!--</ul>-->
      <!--</div>-->
    <!--</div>-->
    <!--<div class="padding-40">-->
      <!--<ul v-if="order.items">-->
        <!--<li-->
          <!--v-for="(item, index) in order.items"-->
          <!--:key="item.id"-->
          <!--class="padding-bottom-20 margin-bottom-20"-->
          <!--:class="{ 'border-bottom-solid border-width-1 border-silver-5': index !== order.items.length }"-->
        <!--&gt;-->
          <!--<div class="flex">-->
            <!--<div class="width-full flex align-items-center padding-right-20">-->
              <!--<img-->
                <!--:src="item.order_inventory.image || 'https://source.unsplash.com/random/50x50?food'"-->
                <!--alt="Prawn crackers"-->
                <!--class="radius-5 margin-right-20"-->
              <!--&gt;-->
              <!--<strong>{{ item.order_inventory.title }}</strong>-->
            <!--</div>-->
            <!--<div class="width-full flex align-items-center">-->
              <!--<span class="body-large">{{ item.quantity }}</span>-->
              <!--<span class="margin-left-auto body-large opacity-80">{{ item.price | currency }}</span>-->
            <!--</div>-->
          <!--</div>-->
          <!--<div-->
            <!--v-if="false"-->
            <!--class="color-cloud-burst margin-top-5 margin-left-70"-->
          <!--&gt;-->
            <!--<div class="body-xsmall">-->
              <!--NOTES-->
            <!--</div>-->
            <!--<div class="margin-top-10">Curry sauce</div>-->
          <!--</div>-->
        <!--</li>-->
      <!--</ul>-->
    <!--</div>-->
  </div>
</template>

<script>
import ArrowDown from '@/js/components/svgs/ArrowDown';

export default {
  components: {
    ArrowDown,
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
