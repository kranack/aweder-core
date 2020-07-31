<template>
  <div class="inventory__item inventory__item--edit">
    <div class="width-full flex"
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
    <edit-inventory-item
      :is-active="isActive"
      @close="hideEditModal()"
    />
  </div>
</template>

<script>
import EditInventoryItem from '@/js/components/shared/modal/slots/EditInventoryItem';

export default {
  name: 'EditItem',
  components: {
    EditInventoryItem,
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
  data() {
    return {
      isActive: false,
    };
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
