<template>
  <div class="grid col-gap grid-cols-9">
    <div class="col-span-3">
      <div
        v-for="(order, index) in orders"
        :key="order.id"
        class="flex align-items-center justify-content-between border-silver border-bottom-solid border-width-1 padding-bottom-20 cursor-pointer"
        :class="{ 'padding-top-20': index !== 0 }"
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
            <span class="body-small color-cloud-burst-8">{{ order.available_time }}</span>
          </div>
        </div>
        <div
          class="order__arrow margin-right-20"
          :class="{ 'order__arrow--active': order === activeOrder }"
        >
          <ArrowRight />
        </div>
      </div>
    </div>
    <div class="col-span-5">
      <div class="background-white radius-5 shadow-order">
        <div class="flex align-items-center padding-40 border-bottom-solid border-width-1 border-silver-5">
          <div class="margin-right-auto">
            <h2 class="flex align-items-center">
              <span class="status status--new" />
              Table #4
            </h2>
            <time
              class="block margin-top-20 margin-left-20"
              :datetime="activeOrder.available_time"
            >
              {{ activeOrder.available_time }}
            </time>
          </div>
          <div class="field field--select field--select-button">
            <select
              class="select select--button"
              name="status"
            >
              <option value="pending">Pending</option>
              <option value="complete">Complete</option>
            </select>
            <span class="select-icon icon icon--sort"><ArrowRight /></span>
          </div>
        </div>
        <div class="padding-40 flex border-bottom-solid border-width-1 border-silver-5">
          <div class="width-full">
            <h3 class="body-large">
              Customer details
            </h3>
            <ul>
              <li class="margin-top-15">{{ activeOrder.customer_name }}</li>
              <li class="margin-top-10">{{ activeOrder.customer_email }}</li>
              <li class="margin-top-10">{{ activeOrder.customer_address }}</li>
              <li class="margin-top-10">{{ activeOrder.customer_phone }}</li>
            </ul>
          </div>
          <div class="width-full">
            <h3 class="body-large">
              Payment information
            </h3>
            <ul>
              <li class="margin-top-15">
                Status: {{ activeOrder.status }}
              </li>
              <li class="margin-top-10">
                <strong>£{{ activeOrder.total_cost }}</strong>
              </li>
            </ul>
          </div>
        </div>
        <div class="padding-40">
          <ul>
            <li
              v-for="n in 6"
              :key="n"
              class="padding-bottom-20 margin-bottom-20"
              :class="{ 'border-bottom-solid border-width-1 border-silver-5': n !== 6 }"
            >
              <div class="flex">
                <div class="width-full flex align-items-center padding-right-20">
                  <img
                    src="https://source.unsplash.com/random/50x50?food"
                    alt="Prawn crackers"
                    class="radius-5 margin-right-20"
                  >
                  <strong>Prawn crackers</strong>
                </div>
                <div class="width-full flex align-items-center">
                  <span class="body-large">1</span>
                  <span class="margin-left-auto body-large opacity-80">£1.95</span>
                </div>
              </div>
              <div
                v-if="n === 6 || n === 3"
                class="color-cloud-burst margin-top-5 margin-left-70"
              >
                <div class="body-xsmall">
                  NOTES
                </div>
                <div class="margin-top-10">Curry sauce</div>
              </div>
            </li>
          </ul>
        </div>
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
    orders: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      activeOrder: this.orders[0],
    };
  },
  mounted() {

  },
  methods: {
    selectOrder(order) {
      this.activeOrder = order;
    },
  },
};
</script>
