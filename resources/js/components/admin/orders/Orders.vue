<template>
  <div class="grid col-gap grid-cols-9">
    <div
      class="col-span-3"
      :class="responsive.isCardView ? 'l-hidden' : 'l-col-span-12'"
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
      class="col-span-5"
      :class="responsive.isCardView ? 'l-col-span-12' : 'l-hidden'"
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
