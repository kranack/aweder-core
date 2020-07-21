<template>
  <div
    v-if="isActive"
    class="popup"
  >
    <div
      class="popup__mask"
      @click="close()"
    />
    <div class="content">
      <div class="popup__box">
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
