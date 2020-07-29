<template>
  <popup :is-active="isActive">
    <header class="popup__header margin-bottom-50">
      <h2 class="body-xlarge">
        Did you want to do a...
      </h2>
    </header>
    <div class="popup__content content">
      <div class="col-span-6">
        <a
          ref="take_away"
          :href="takeAwayUrl"
          class="button service-type__button">
          <span class="button__icon button__icon--left"><Delivery /></span>
          <span class="button_content body-large">Take away</span>
        </a>
      </div>
      <div class="col-span-6 sm-margin-top-20">
        <a
          ref="table_service"
          :href="tableServiceUrl"
          class="button service-type__button">
          <span class="button__icon button__icon--left"><Table /></span>
          <span class="button_content body-large">Table service</span>
        </a>
      </div>
    </div>
  </popup>
</template>

<script>
import Popup from '@/js/components/shared/Popup';
import Delivery from '@/js/components/svgs/Delivery';
import Table from '@/js/components/svgs/Table';

export default {
  components: {
    Popup,
    Delivery,
    Table,
  },
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
    takeAwayUrl: {
      type: String,
      default: '',
    },
    tableServiceUrl: {
      type: String,
      default: '',
    },
  },
  mounted() {
    this.$refs.take_away.focus();
  },
};
</script>
