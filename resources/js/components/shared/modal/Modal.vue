<template>
  <div
    v-if="isActive"
    class="modal row"
  >
    <div
      class="modal__mask"
      @click="close()"
    />
    <div class="content justify-content-center align-items-center">
      <div
        class="modal__box col-span-6 col-start-4
         m-col-span-12 m-col-start-1 padding-40 m-padding-20"
      >
        <slot />
      </div>
    </div>
  </div>
</template>

<script>
export default {
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
