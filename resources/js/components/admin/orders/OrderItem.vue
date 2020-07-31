<template>
  <div
    class="orders__list-item"
    @click="selectOrder(order)">
    <div class="orders__customer">
      <span class="status status--new"></span>
      <p class="orders__name">{{ order.customer_name }}</p>
    </div>
    <div class="orders__customer orders__customer--details">
      <!-- @TODO add table number or service type-->
      <p class="orders__type">Table #4</p>
      <span class="separator separator--small"></span>
      <span class="orders__date">
        {{ order.available_time | moment('Mo MMMM YYYY, HH:mm') }}
      </span>
    </div>
    <span class="orders__arrow"
      :class="{ 'order__arrow--active': isActive}">
      <ArrowRight />
    </span>
  </div>
</template>

<script>
import ArrowRight from '@/js/components/svgs/ArrowRight';

export default {
  components: {
    ArrowRight,
  },
  props: {
    order: {
      type: Object,
      default: null,
    },
    isActive: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    selectOrder(order) {
      this.$emit('selected-order', order);
    },
  },
};
</script>
