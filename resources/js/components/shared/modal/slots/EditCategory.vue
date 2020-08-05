<template>
  <modal :is-active="isActive" @close="close()">
    <header class="modal__header margin-bottom-50">
      <h2 class="header-three">
        Edit category
      </h2>
    </header>
  </modal>
</template>

<script>
import Modal from '@/js/components/shared/modal/Modal';

export default {
  name: 'EditCategory',
  components: {
    Modal,
  },
  props: {
    isActive: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    close() {
      this.$emit('close');
    },
  },
};
</script>
