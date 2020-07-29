<template>
  <div class="col-span-9 m-col-span-12 sm-col-span-6">
    <nav class="tab-nav tab-nav--dashboard">
      <ul class="tab-menu">
        <li
          v-for="tab in tabs"
          :key="tab"
          class="tab-menu__item"
          :class="{ 'tab-menu__item--active': tab === activeTab }"
        >
          <span
            class="tab-menu__link"
            @click.prevent="selectTab(tab)"
          >
            {{ tab }}
          </span>
        </li>
      </ul>
    </nav>
    <orders :orders="currentOrders" />
  </div>
</template>

<script>
import Orders from './Orders';

export default {
  components: {
    Orders,
  },
  props: {
    openOrders: {
      type: Array,
      default: () => [],
    },
    acceptedOrders: {
      type: Array,
      default: () => [],
    },
    rejectedOrders: {
      type: Array,
      default: () => [],
    },
    fulfilledOrders: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      activeTab: 'Open orders',
      tabs: [
        'Open orders',
        'Completed',
        'Rejected',
      ],
    };
  },
  computed: {
    currentOrders() {
      switch (this.activeTab) {
        case 'Open orders':
          return this.openOrders;
        case 'Completed':
          return this.fulfilledOrders;
        case 'Rejected':
          return this.rejectedOrders;
        default:
          return null;
      }
    },
  },
  methods: {
    selectTab(tab) {
      this.activeTab = tab;
    },
  },
};
</script>
