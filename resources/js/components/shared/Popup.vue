<template>
  <div
    v-if="isActive"
    class="popup row"
  >
    <div
      class="popup__mask"
      @click="close()"
    />
    <div class="content">
      <div class="popup__box col-span-6 col-start-4 m-col-span-12 m-col-start-1 padding-30 m-padding-20">
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
