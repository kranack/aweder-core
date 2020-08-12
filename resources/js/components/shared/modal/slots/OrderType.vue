<template>
  <modal
    :is-active="isActive"
    size="small"
  >
    <h2 class="body-xlarge margin-bottom-50">
      Select take away type and time
    </h2>

    <div class="content">
      <div class="col-span-6">
        <button
          class="button order-type__button"
          :class="{ 'order-type__button--active': type === 'delivery' }"
          @click="setType('delivery')"
        >
          <span class="button__icon button__icon--left"><Delivery /></span>
          <span class="button_content body-large">Delivery</span>
        </button>
      </div>
      <div class="col-span-6 sm-margin-top-20">
        <button
          class="button order-type__button"
          :class="{ 'order-type__button--active': type === 'collection' }"
          @click="setType('collection')"
        >
          <span class="button__icon button__icon--left"><Collection /></span>
          <span class="button_content body-large">Collection</span>
        </button>
      </div>
      <div class="col-span-12">
        <merchant-date-time-picker
          v-model="datetime"
          :merchant-hours="merchantHours"
        />
      </div>
      <div class="col-span-12 margin-top-40">
        <button
          class="button button--wide"
          :class="'button-solid--carnation'"
          @click="save()"
        >
          <span class="button__content">Save</span>
        </button>
      </div>
      <div class="col-span-12 margin-top-20">
        <a :href="tableOrderUrl">Eating in? Click here.</a>
      </div>
    </div>
  </modal>
</template>

<script>
import { mapState } from 'vuex';
import Modal from '@/js/components/shared/modal/Modal';
import MerchantDateTimePicker from '@/js/components/shared/MerchantDateTimePicker';
import Delivery from '@/js/components/svgs/Delivery';
import Collection from '@/js/components/svgs/Collection';

export default {
  components: {
    Modal,
    Delivery,
    Collection,
    MerchantDateTimePicker,
  },
  props: {
    merchant: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      type: 'delivery',
      datetime: null,
      showCalendar: false,
    };
  },
  computed: {
    ...mapState({
      isActive: (state) => state.modals.orderType,
    }),
    merchantHours() {
      return this.merchant.opening_hours.map((hours) => ({
        ...hours,
        day_of_week: hours.day_of_week - 1,
      }));
    },
    tableOrderUrl() {
      return `/${this.merchant.url_slug}/table-order`;
    },
  },
  methods: {
    toggleCalendar() {
      this.showCalendar = !this.showCalendar;
    },
    setType(type) {
      this.type = type;
    },
    save() {
      this.$store.dispatch('cart/setOrderType', this.type);
      this.$store.dispatch('cart/setDatetime', this.datetime);
      this.$store.dispatch('modals/setOrderType', false);
    },
  },
};
</script>
