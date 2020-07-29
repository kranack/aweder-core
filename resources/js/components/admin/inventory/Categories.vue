<template>
  <div class="inventory__categories inline-flex flex-col width-full">
    <header class="inventory__category-name">
      <h2 class="header-three">Starters</h2>
      <span href="" class="button button--small button-outline--silver">
        <span class="button__content">Edit</span>
      </span>
    </header>
    <div class="inventory__group inline-flex flex-col width-full">
      <edit-item></edit-item>
    </div>
    <sub-categories></sub-categories>
  </div>
</template>

<script>
  import SubCategories from './SubCategories';
  import EditItem from './EditItem';

  export default {
    name: 'Categories',
    components: {
      SubCategories,
      EditItem,
    },
  }
</script>
