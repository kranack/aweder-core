import { shallowMount, createLocalVue } from '@vue/test-utils';
import MerchantOrderTypes from '@/js/components/shared/business_details/MerchantOrderTypes';

const localVue = createLocalVue();

describe('Merchant Ordet Types Component', () => {
  const wrapper = shallowMount(
    MerchantOrderTypes,
    {
      localVue,
      props: {
        collectionTypeValidationMessage: '',
        deliveryRadiusValidationMessage: '',
        deliveryCostValidationMessage: '',
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
          collectionTypeValidationMessage: 'The validation has failed',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
  });

  it('Delivery Radius Validation renders message', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: 'The radius is required on delivery option',
          deliveryCostValidationMessage: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
    expect(failedWrapper.find('.field.delivery.input-error').exists()).toBe(true);
  });

  it('Delivery Cost Validation renders message', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: 'Delivery cost is required',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
    expect(failedWrapper.find('.field.field--price.input-error').exists()).toBe(true);
  });

  it('No validation errors are shows', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(false);
  });

  it('Confirms collection is selected when passed in as array element', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
          collectionTypes: '["collection"]',
        },
      },
    );
    expect(failedWrapper.find('#allow-collection').exists()).toBe(true);
    expect(failedWrapper.find('#allow-collection:checked').exists()).toBe(true);
    expect(failedWrapper.find('#table:checked').exists()).toBe(false);
    expect(failedWrapper.find('#allow-delivery:checked').exists()).toBe(false);
  });

  it('Confirms delivery selected when passed in as array element', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
          collectionTypes: '["delivery"]',
        },
      },
    );
    expect(failedWrapper.find('#allow-collection:checked').exists()).toBe(false);
    expect(failedWrapper.find('#table:checked').exists()).toBe(false);
    expect(failedWrapper.find('#allow-delivery:checked').exists()).toBe(true);
  });

  it('Confirms table is selected when passed in as array element', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
          collectionTypes: '["table"]',
        },
      },
    );
    expect(failedWrapper.find('#allow-collection:checked').exists()).toBe(false);
    expect(failedWrapper.find('#table:checked').exists()).toBe(true);
    expect(failedWrapper.find('#allow-delivery:checked').exists()).toBe(false);
  });

  it('Confirms all selected is selected when passed in as array element', () => {
    const failedWrapper = shallowMount(
      MerchantOrderTypes,
      {
        localVue,
        propsData: {
          collectionTypeValidationMessage: '',
          deliveryRadiusValidationMessage: '',
          deliveryCostValidationMessage: '',
          collectionTypes: '["collection", "delivery", "table"]',
        },
      },
    );
    expect(failedWrapper.find('#allow-collection').exists()).toBe(true);
    expect(failedWrapper.find('#allow-collection:checked').exists()).toBe(true);
    expect(failedWrapper.find('#table:checked').exists()).toBe(true);
    expect(failedWrapper.find('#allow-delivery:checked').exists()).toBe(true);
  });
});
