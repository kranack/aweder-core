<template>
  <div>
    <p class="col col--lg-12-6 col--m-12-8 col-sm-6-6"> Please create your account details:</p>
    <div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 @error('email') input-error @enderror">
      <label for="email">Email <abbr title="required">*</abbr></label>
      <input type="email" name="email" id="email" tabindex="1"  value="{{ old('email') }}" placeholder="Email" />
      @error('email')
      <p class="form__validation-error">{{ $message }}</p>
      @enderror
    </div>
    <div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 @error('password') input-error @enderror">
      <label for="password">Enter a strong password below <abbr title="required">*</abbr></label>
      <input type="password" name="password" tabindex="2"  id="password" placeholder="Password" />
      @error('password')
      <p class="form__validation-error">{{ $message }}</p>
      @enderror
    </div>
    <div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 @error('password-confirmed') input-error @enderror">
      <label for="password-confirmed">Confirm your password <abbr title="required">*</abbr></label>
      <input type="password" name="password-confirmed" tabindex="3"  id="password-confirmed" placeholder="Confirm password" />
      @error('password-confirmed')
      <p class="form__validation-error">{{ $message }}</p>
      @enderror
    </div>
    <div class="field col col--lg-12-6 col--m-12-8 col-sm-6-6 field--button">
      <button type="submit" class="button button--icon-right button--filled button--filled-carnation button--end">
        <span class="button__content">Next</span>
        <span class="icon icon-right">@svg('arrow-right')</span>
      </button>
    </div>
  </div>
</template>

<script>
  export default {
    name: 'UserInformation',
  }
</script>

<style scoped>

</style>
