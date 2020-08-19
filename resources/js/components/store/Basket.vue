<template>
  <div
    class="menu__cart col-span-3 col-start-9 l-col-span-4 l-col-start-8 m-col-span-5 sm-hidden"
    :class="{ 'menu__cart--added': quantity }"
  >
    <span class="icon icon--logo-mark flex margin-right-20"><Logo /></span>
    <p v-if="quantity">
      Add more items - {{ subtotal | currency }}
    </p>
    <p v-else>
      Your order is empty
    </p>
  </div>
</template>

<script>
import Logo from '@/js/components/svgs/Logo';
import { mapGetters } from 'vuex';

export default {
  components: {
    Logo,
  },
  computed: {
    ...mapGetters({
      quantity: 'cart/quantity',
      subtotal: 'cart/subtotal',
    }),
  },
};
</script>
