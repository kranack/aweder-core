<template>
  <div class="inventory__item inventory__item--edit">
    <div v-if="image"
        class="inventory__image">
      <img :src="image" :alt="title">
    </div>
    <div class="inventory__details">
      <header class="inventory__header">
        <h3 class="inventory__title">{{ title }}</h3>
      </header>
      <p class="inventory__description"
         v-if="description">{{ description }}</p>
      <span class="inventory__price">£{{ price }}</span>
      <div class="inventory__button">
        <a href="" class="button button--small button-outline--silver">
          <span class="button__content">Edit</span>
        </a>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'EditItem',
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
  }
</script>
