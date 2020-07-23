<template>
  <div class="background-white radius-5 shadow-order">
    <div class="flex align-items-center padding-40 border-bottom-solid border-width-1 border-silver-5">
      <div class="margin-right-auto">
        <h2 class="flex align-items-center">
          <span class="status status--new" />
          Table #4
        </h2>
        <time
          class="block margin-top-20 margin-left-20"
          :datetime="order.available_time"
        >
          {{ order.available_time | moment('Mo MMMM YYYY, HH:mm') }}
        </time>
      </div>
      <div>
        <a
          class="hidden l-block cursor-pointer margin-bottom-10 color-cloud-burst-8"
          @click.prevent="back()"
        >
          Return to orders
        </a>
        <div class="order__select">
          <select name="status">
            <option value="pending">Pending</option>
            <option value="complete">Complete</option>
          </select>
          <span class="order__select-icon"><ArrowDown /></span>
        </div>
      </div>
    </div>
    <div class="padding-40 flex border-bottom-solid border-width-1 border-silver-5">
      <div class="width-full">
        <h3 class="body-large">
          Customer details
        </h3>
        <ul>
          <li class="margin-top-15">{{ order.customer_name }}</li>
          <li class="margin-top-10">{{ order.customer_email }}</li>
          <li class="margin-top-10">{{ order.customer_address }}</li>
          <li class="margin-top-10">{{ order.customer_phone }}</li>
        </ul>
      </div>
      <div class="width-full">
        <h3 class="body-large">
          Payment information
        </h3>
        <ul>
          <li class="margin-top-15">
            Status: {{ order.status }}
          </li>
          <li class="margin-top-10">
            <strong>£{{ order.total_cost }}</strong>
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
  methods: {
    back() {
      this.$emit('back');
    },
  },
};
</script>
