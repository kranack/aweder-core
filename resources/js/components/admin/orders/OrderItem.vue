<template>
  <div
    class="flex align-items-center justify-content-between border-silver border-bottom-solid border-width-1 padding-bottom-20 cursor-pointer"
    :class="{ 'padding-top-20': !firstOfItem }"
    @click="selectOrder(order)"
  >
    <div>
      <div class="flex align-items-center margin-bottom-10">
        <span class="status status--new" />
        <span>{{ order.customer_name }}</span>
      </div>
      <div>
        <span>Table #4</span>
        <span class="margin-right-10 margin-left-10">&ndash;</span>
        <span class="body-small color-cloud-burst-8">
          {{ order.available_time | moment('Mo MMMM YYYY, HH:mm') }}
        </span>
      </div>
    </div>
    <div>
      <div
        class="order__arrow margin-right-20"
        :class="{ 'order__arrow--active': isActive}"
      >
        <ArrowRight />
      </div>
    </div>
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
    firstOfItem: {
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
