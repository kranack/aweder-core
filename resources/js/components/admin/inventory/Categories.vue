<template>
  <div class="inventory__categories inline-flex flex-col width-full">
    <header class="inventory__category-name">
      <h2 class="header-three">
        {{ categoryName }}
      </h2>
      <span class="button button--small button-outline--silver">
        <span class="button__content">Edit</span>
      </span>
    </header>
    <div class="inventory__group inline-flex flex-col width-full">
      <edit-item
        v-for="(item, index) in inventoryItems"
        :key="index"
        :item-id="item.id"
        :title="item.title"
        :description="item.description"
        :price="item.price"
      />
    </div>
    <div
      v-for="(category, subCategoryIndex) in subCategory"
      :key="subCategoryIndex"
      class="inventory__sub-categories inline-flex flex-col width-full"
    >
      <categories
        name="1"
        :sub-category="0"
      />
    </div>
  </div>
</template>

<script>
import Categories from './Categories';
import EditItem from './EditItem';

export default {
  name: 'Categories',
  components: {
    Categories,
    EditItem,
  },
  props: {
    subCategory: {
      type: Number,
      default: 3,
    },
    categoryName: {
      type: String,
      default: '',
    },
    categoryId: {
      type: String,
      default: '',
    },
    inventoryItems: {
      type: Array,
      default: () => [],
    },
  },
};
</script>
