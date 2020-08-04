<template>
  <div
    v-if="notification.visible"
    class="notification notification--ajax"
    :class="notification.type === 'success' ? 'notification--success' : 'notification--error'"
  >
    <div class="row">
      <div class="content">
        <div class="notification__message col-span-10 col-start-2 m-col-span-12 m-col-start-1 sm-col-span-6 sm-col-start-1">
          <p>{{ notification.message }}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  computed: {
    ...mapState([
      'notification',
    ]),
  },
};
</script>
