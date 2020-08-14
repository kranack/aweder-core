<template>
  <div class="inventory__categories inline-flex flex-col width-full">
    <header class="inventory__category-name">
      <h2 class="header-three inventory__category__title">
        {{ category.title }}
      </h2>
      <a
        class="button button--small button-outline--silver"
        @click="showEditCategoryModal"
      >
        <span class="button__content">Edit</span>
      </a>
    </header>
    <div class="inventory__group inline-flex flex-col width-full">
      <add-item
        :category-id="category.id"
      />
      <inventory-item
        v-for="(item, index) in category.inventories"
        :key="index"
        :category-id="category.id"
        :item="item"
      />
    </div>
    <!-- <div
      v-for="(category, subCategoryIndex) in subCategory"
      :key="subCategoryIndex"
      class="inventory__sub-categories inline-flex flex-col width-full"
    >
      <categories
        name="1"
        :sub-category="0"
      />
    </div> -->
    <edit-category
      :is-active="isActive"
      @close="hideEditCategoryModal()"
    />
  </div>
</template>

<script>
import EditCategory from '@/js/components/shared/modal/slots/EditCategory';
import Categories from './Categories';
import InventoryItem from './InventoryItem';
import AddItem from './AddItem';

export default {
  name: 'Categories',
  components: {
    EditCategory,
    Categories,
    InventoryItem,
    AddItem,
  },
  props: {
    category: {
      type: Object,
      default: null,
    },
    subCategory: {
      type: Number,
      default: 3,
    },
  },
  data() {
    return {
      isActive: false,
    };
  },
  methods: {
    showEditCategoryModal() {
      this.isActive = true;
    },
    hideEditCategoryModal() {
      this.isActive = false;
    },
  },
};
</script>
