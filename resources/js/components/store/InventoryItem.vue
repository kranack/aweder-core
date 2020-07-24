<template>
  <div class="inventory__item">
    <div
      v-if="product.image"
      class="inventory__image"
    >
      <img
        :src="product.image"
        :alt="product.title"
      >
    </div>
    <div class="inventory__details">
      <header class="inventory__header">
        <h3 class="inventory__title">
          {{ product.title }}
        </h3>
      </header>
      <p
        v-if="product.description"
        class="inventory__description"
      >
        {{ product.description }}
      </p>
      <span class="inventory__price">{{ product.price | currency }}</span>
      <div
        class="inventory__button"
        @click="add()"
      >
        <p class="inventory__add">
          Add
        </p>
        <span class="icon icon--add flex margin-left-10">
          <Add />
        </span>
      </div>
    </div>
  </div>
</template>

<script>
import Add from '@/js/components/svgs/Add';

export default {
  components: {
    Add,
  },
  props: {
    product: {
      type: Object,
      default: null,
    },
  },
  methods: {
    add() {
      this.$store.dispatch('activeProduct/setActiveProduct', this.product);
    },
  },
};
</script>
