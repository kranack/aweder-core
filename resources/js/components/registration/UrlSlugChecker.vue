<template>
  <div class="field col--lg-12-4 col--lg-offset-12-3 col--m-12-5 col--m-offset-12-4 col-sm-6-6 col--sm-offset-6-1 @error('url-slug') input-error @enderror">
    <label for="url-slug">The business's URL slug <abbr title="required">*</abbr></label>
    <input
      type="text"
      name="url-slug"
      id="url-slug"
      tabindex="5"
      value="{{ old('url-slug') }}"
      placeholder="URL slug"
    />
    <p v-if="validationError === true" class="form__validation-error">{{ $message }}</p>
    <p class="form__note">This will generate your url - for example - if you enter red-lion you will have https://aweder.net/red-lion</p>
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
  },
};
</script>
