<template>
  <div class="inventory__add">
    <a
      href=""
      class="inventory__add-category"
    >
      Add category
      <span class="icon icon--add"><Add /></span>
    </a>
  </div>
</template>

<script>
import Add from '@/js/components/svgs/Add';

export default {
  name: 'AddCategory',
  components: {
    Add,
  },
};
</script>
