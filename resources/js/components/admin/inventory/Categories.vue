<template>
  <div class="inventory__content flex flex-col width-full">
    <header class="inventory__category-name">
      <h2 class="header-three">
        {{ categoryName }}
      </h2>
      <span class="button button--small button-outline--silver">
        <span class="button__content">Edit</span>
      </span>
    </header>
    <div class="inventory__group inline-flex flex-col width-full">
      <edit-item />
    </div>
  </div>
</template>

<script>
import EditItem from './EditItem';

export default {
  name: 'Categories',
  components: {
    EditItem,
  },
  props: {
    categoryName: {
      type: String,
      default: '',
    },
    categoryId: {
      type: String,
      default: '',
    },
  },
};
</script>
