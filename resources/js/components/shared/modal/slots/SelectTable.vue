<template>
  <modal
    :is-active="isActive"
    size="small"
  >
    <h2 class="body-xlarge margin-bottom-30">
      Table service
    </h2>
    <validation-observer v-slot="{ invalid }">
      <div class="content">
        <div class="col-span-6">
          <validation-provider
            v-slot="v"
            rules="required"
          >
            <div
              class="field"
              :class="{ 'field--error': v.errors.length }"
            >
              <label for="table">Please enter your table number</label>
              <input
                id="table"
                ref="table"
                v-model="table"
                type="text"
                class="text-input"
              >
            </div>
          </validation-provider>
        </div>
        <div class="col-span-12">
          <button
            class="button button--wide"
            :class="invalid ? 'button-solid--silver' : 'button-solid--carnation'"
            :disabled="invalid"
            @click="save()"
          >
            <span class="button__content">Confirm</span>
          </button>
        </div>
        <div class="col-span-12 margin-top-20">
          <a :href="takeAwayUrl">Looking to take away? Click here.</a>
        </div>
      </div>
    </validation-observer>
  </modal>
</template>

<script>
import { mapState } from 'vuex';
import Modal from '@/js/components/shared/modal/Modal';

export default {
  components: {
    Modal,
  },
  props: {
    merchant: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      table: '',
    };
  },
  computed: {
    ...mapState({
      isActive: (state) => state.modals.selectTable,
    }),
    takeAwayUrl() {
      return `/${this.merchant.url_slug}/take-away`;
    },
  },
  mounted() {
    this.$refs.table.focus();
  },
  methods: {
    save() {
      this.$store.dispatch('cart/setTable', this.table);
      this.$store.dispatch('modals/setSelectTable', false);
    },
  },
};
</script>
