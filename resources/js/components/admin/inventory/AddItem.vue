<template>
  <div
    class="inventory__item inventory__item--add"
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
    <create-inventory-item
      :is-active="isActive"
      @close="hideCreateModal()"
    />
  </div>
</template>

<script>
import CreateInventoryItem from '@/js/components/shared/modal/slots/CreateInventoryItem';

export default {
  name: 'AddItem',
  components: {
    CreateInventoryItem,
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
