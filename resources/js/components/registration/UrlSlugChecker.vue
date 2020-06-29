<template>
  <div
    class="field col--lg-12-4 col--lg-offset-12-3 col--m-12-5 col--m-offset-12-4 col-sm-6-6 col--sm-offset-6-1 @error('url-slug') input-error @enderror"
  >
    <label for="url-slug">The business's URL slug <abbr title="required">*</abbr></label>
    <input
      type="text"
      id="url-slug"
      v-model="urlSlug"
      name="url-slug"
      value="urlValue"
      tabindex="5"
      placeholder="URL slug"
    />

    <p
      v-if="validationError"
      class="form__validation-error"
    >
      {{ validationMessage }}
    </p>
    <p class="form__note">
      This will generate your url - for example - if you enter red-lion you will have https://aweder.net/red-lion
    </p>
  </div>
</template>
<script>
export default {
  name: 'UrlSlugChecker',
  props: {
    validationError: {
      type: Boolean,
      required: true,
    },
    validationMessage: {
      type: String,
      required: false,
      default: '',
    },
    urlValue: {
      type: String,
      required: false,
      default: '',
    },
  },
  data() {
    return {
      urlSlug: '',
    };
  },
  mounted() {

  },
  methods: {
    doesUrlExist() {
    },
  },

};
</script>
