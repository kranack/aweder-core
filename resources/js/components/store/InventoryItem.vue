<template>
  <div class="inventory__item">
    <div
      v-if="image"
      class="inventory__image"
    >
      <img
        :src="image"
        :alt="title"
      >
    </div>
    <div class="inventory__details">
      <header class="inventory__header">
        <h3 class="inventory__title">
          {{ title }}
        </h3>
      </header>
      <p
        v-if="description"
        class="inventory__description"
      >
        {{ description }}
      </p>
      <span class="inventory__price">£{{ price }}</span>
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
    itemId: {
      type: String,
      default: '',
    },
    title: {
      type: String,
      default: '',
    },
    description: {
      type: String,
      default: '',
    },
    price: {
      type: String,
      default: '',
    },
    image: {
      type: String,
      default: '',
    },
    editable: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    add() {
      this.$emit('added', this.itemId);
    },
  },
};
</script>
