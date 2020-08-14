<template>
  <div class="inventory__item inventory__item--edit">
    <div
      class="inventory__trigger width-full flex"
      @click="showEditModal"
    >
      <div
        v-if="item.image"
        class="inventory__image"
      >
        <img
          :src="item.image"
          :alt="item.title"
        >
      </div>
      <div class="inventory__details">
        <header class="inventory__header">
          <h3 class="inventory__title">
            {{ item.title }}
          </h3>
        </header>
        <p
          v-if="item.description"
          class="inventory__description"
        >
          {{ item.description }}
        </p>
        <span class="inventory__price">{{ item.price | currency }}</span>
        <div class="inventory__button">
          <a
            href=""
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
      :category-id="categoryId"
      form-type="update"
      @close="hideEditModal()"
    />
  </div>
</template>

<script>
import FormInventoryItem from '@/js/components/shared/modal/slots/FormInventoryItem';

export default {
  name: 'InventoryItem',
  components: {
    FormInventoryItem,
  },
  props: {
    item: {
      type: Object,
      required: true,
    },
    categoryId: {
      type: Number,
      required: true,
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
