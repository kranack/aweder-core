<template>
  <div class="inventory__sub-categories inline-flex flex-col width-full">
    <header class="inventory__subcategory-name">
      <h3 class="inventory__sub-title">Sub category</h3>
      <a href="" class="button button--small button-outline--silver">
        <span class="button__content">Edit</span>
      </a>
    </header>
    <div class="inventory__group inline-flex flex-col width-full">
      <edit-item></edit-item>
    </div>
  </div>
</template>

<script>
  import EditItem from './EditItem';

  export default {
    name: 'SubCategories',
    components: {
      EditItem,
    },
  }
</script>
