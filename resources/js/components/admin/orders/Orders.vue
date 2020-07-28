<template>
  <div class="orders">
    <div
      class="orders__list col-span-3 m-col-span-4"
      :class="responsive.isCardView ? 'sm-hidden' : 'sm-col-span-6'"
    >
      <order-item
        v-for="(order, index) in orders"
        :key="order.id"
        :is-active="isActiveOrder(order)"
        :first-of-item="index === 0"
        :order="order"
        @selected-order="selectOrder"
      />
    </div>
    <div
      class="orders__card col-span-5 l-col-span-6 sm-col-span-6 m-col-span-8"
      :class="responsive.isCardView ? 'sm-col-span-6' : 'sm-hidden'"
    >
      <order-card
        :order="activeOrder"
        @back="toListView"
      />
    </div>
  </div>
</template>

<script>
import OrderCard from './OrderCard';
import OrderItem from './OrderItem';

export default {
  components: {
    OrderCard,
    OrderItem,
  },
  props: {
    orders: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      activeOrder: this.orders[0],
      responsive: {
        isCardView: false,
      },
    };
  },
  watch: {
    orders() {
      [this.activeOrder] = this.orders;
    },
  },
  methods: {
    selectOrder(order) {
      this.responsive.isCardView = true;
      this.activeOrder = order;
    },
    isActiveOrder(order) {
      return order === this.activeOrder;
    },
    toListView() {
      this.responsive.isCardView = false;
    },
  },
};
</script>
