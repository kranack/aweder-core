import { shallowMount, createLocalVue } from '@vue/test-utils';
import MerchantOrderTypes from '@/js/components/shared/business_details/MerchantOrderTypes';

const localVue = createLocalVue();

describe('Merchant Order Types Component', () => {
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
    expect(wrapper.find('span.label').exists()).toBe(true);
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
    expect(failedWrapper.find('.field__error').exists()).toBe(true);
    expect(failedWrapper.find('.field__error').text()).toBe('The validation has failed');
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
    expect(failedWrapper.find('p.field__error').exists()).toBe(true);
    expect(failedWrapper.findAll('p.field__error').length).toBe(1);

    expect(failedWrapper.find('.field.field--delivery.field__error').exists()).toBe(true);
    expect(failedWrapper.find('p.field__error').text()).toBe('The radius is required on delivery option');
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
    expect(failedWrapper.find('p.field__error').exists()).toBe(true);
    expect(failedWrapper.findAll('p.field__error').length).toBe(1);
    expect(failedWrapper.find('p.field__error').text()).toBe('Delivery cost is required');
    expect(failedWrapper.find('.field.field--price.field__error').exists()).toBe(true);
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
