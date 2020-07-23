<template>
  <popup :is-active="isActive">
    <h2 class="body-xlarge margin-bottom-50">
      Did you want to do a...
    </h2>

    <div class="content">
      <div class="col-span-6">
        <a
          ref="take_away"
          :href="takeAwayUrl"
          class="button button--large button-solid--cloud-burst button--hover-casablanca button--focus-casablanca"
        >
          <span class="button__icon button__icon--left"><Delivery /></span>
          <span class="button_content body-large">Take away</span>
        </a>
      </div>
      <div class="col-span-6 sm-margin-top-20">
        <a
          ref="table_service"
          :href="tableServiceUrl"
          class="button button--large button-solid--cloud-burst button--hover-casablanca button--focus-casablanca"
        >
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
