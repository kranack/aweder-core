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
          <svg
            viewBox="0 0 6 6"
          >
            <title>add</title>
            <path d="M2.9,0a.5.5,0,0,1,.5.5V2.4H5.5a.5.5,0,0,1,0,1H3.4V5.5a.5.5,0,0,1-1,0V3.4H.5a.5.5,0,0,1,0-1H2.4V.5A.5.5,0,0,1,2.9,0Z" />
          </svg>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
