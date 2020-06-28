import { shallowMount, createLocalVue } from '@vue/test-utils';
import UrlSlugChecker from '@/js/components/registration/UrlSlugChecker';

const localVue = createLocalVue();

describe('UrlSlug Checker', () => {
  const wrapper = shallowMount(
    UrlSlugChecker,
    {
      localVue,
      props: {
        validationError: false,
        validationMessage: '',
        urlValue: '',
      },
    },
  );

  it('Does the field render with default values', () => {
    expect(wrapper.find("[type='text']").exists()).toBe(true);
  });

  it('Does the field render the validation paragraph when a validation error is present', () => {
    const failedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
  });

  it('Does the field render the validation error message when a validation error is present', () => {
    const failedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').text()).toBe('The validation has failed');
  });
});
