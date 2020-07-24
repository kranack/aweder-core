<template>
  <popup
    v-if="product"
    :is-active="!!product"
    @close="close()"
  >
    <h2 class="body-xlarge margin-bottom-50">
      {{ product.title }}
    </h2>

    <div>
      <input
        v-model.number="quantity"
        type="number"
        name="quanaity"
      >
      <button
        class="button button-solid--carnation button--wide"
        @click="add()"
      >
        <span class="button__content">Add item</span>
      </button>
    </div>
  </popup>
</template>

<script>
import Popup from '@/js/components/shared/Popup';

export default {
  components: {
    Popup,
  },
  data() {
    return {
      quantity: 1,
    };
  },
  computed: {
    product() {
      return this.$store.state.activeProduct.product;
    },
  },
  mounted() {
    // this.$refs.take_away.focus();
  },
  methods: {
    add() {
      this.$store.dispatch('cart/addToCart', {
        product: this.product,
        quantity: this.quantity,
      });

      this.close();
    },
    close() {
      this.quantity = 1;
      this.$store.dispatch('activeProduct/removeActiveProduct');
    },
  },
};
</script>
