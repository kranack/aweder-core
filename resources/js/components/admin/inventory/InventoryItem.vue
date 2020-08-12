<template>
  <div class="inventory__item inventory__item--edit">
    <div class="inventory__trigger width-full flex"
         @click="showEditModal"
    >
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
        <div class="inventory__button">
          <a href=""
             class="button button--small button-outline--silver"
          >
            <span class="button__content">Edit</span>
          </a>
        </div>
      </div>
    </div>
    <form-inventory-item
      :is-active="isActive"
      :item="item"
      @close="hideEditModal()"
    />
  </div>
</template>

<script>
import FormInventoryItem from '@/js/components/shared/modal/slots/FormInventoryItem';

export default {
  name: 'EditItem',
  components: {
    FormInventoryItem,
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
  },
  data() {
    return {
      isActive: false,
    };
  },
  computed: {
    item() {
      return {
        itemId: this.itemId,
        title: this.title,
        description: this.description,
        price: this.price,
        image: this.image,
      };
    },
  },
  methods: {
    showEditModal() {
      this.isActive = true;
    },
    hideEditModal() {
      this.isActive = false;
    },
  },
};
</script>
