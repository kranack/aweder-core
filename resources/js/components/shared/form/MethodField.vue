<template>
  <input
    type="hidden"
    name="_method"
    :value="method"
  >
</template>

<script>
export default {
  props: {
    method: {
      type: String,
      required: true,
    },
  },
};
</script>
