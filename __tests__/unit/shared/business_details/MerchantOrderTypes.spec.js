import { shallowMount, createLocalVue } from '@vue/test-utils';
import MerchantOrderTypes from '@/js/components/shared/business_details/MerchantOrderTypes';

const localVue = createLocalVue();

describe('Merchant Ordet Types Component', () => {
  const wrapper = shallowMount(
    MerchantOrderTypes,
    {
      localVue,
      props: {
        collectionTypeValidationError: false,
        collectionTypeValidationMessage: '',
      },
    },
  );

  it('Does the field render with default values', () => {
    expect(wrapper.find('h3.header').exists()).toBe(true);
  });

  it('Does the field render the validation paragraph when a validation error is present', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationError: true,
          collectionTypeValidationMessage: 'The validation has failed',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
  });
});
