<template>
  <div
    class="inventory__item inventory__item--add"
  >
    <div
      class="inventory__trigger width-full flex"
      @click="showCreateModal"
    >
      <div class="inventory__image" />
      <div class="inventory__details">
        <header class="inventory__header">
          <h3 class="inventory__title">
            Example menu title
          </h3>
        </header>
        <p class="inventory__description">
          Example menu description
        </p>
        <span class="inventory__price">£0.00</span>
      </div>
    </div>
    <form-inventory-item
      :is-active="isActive"
      @close="hideCreateModal()"
    />
  </div>
</template>

<script>
import FormInventoryItem from '@/js/components/shared/modal/slots/FormInventoryItem';

export default {
  name: 'AddItem',
  components: {
    FormInventoryItem,
  },
  data() {
    return {
      isActive: false,
    };
  },
  methods: {
    showCreateModal() {
      this.isActive = true;
    },
    hideCreateModal() {
      this.isActive = false;
    },
  },
};
</script>
