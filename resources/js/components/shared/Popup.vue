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
      <div
        class="popup__box m-col-span-12 m-col-start-1 padding-40 m-padding-20"
        :class="{
          'col-span-6 col-start-4': size === 'medium',
          'col-span-4 col-start-5': size === 'small',
        }"
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
    size: {
      type: String,
      default: 'medium',
    },
  },
  methods: {
    close() {
      this.$emit('close');
    },
  },
};
</script>
