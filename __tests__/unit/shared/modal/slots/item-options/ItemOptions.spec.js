import { mount, shallowMount } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/slots/ItemOptions';
import orderApi from '@/js/api/order/order';
import flushPromises from 'flush-promises';
import '@/js/filters/Currency';
import defaultState from './mocks/default';
import activeProductState from './mocks/active-product';
import activeProductWithOrderState from './mocks/active-product-with-order';
import createOrderSuccessResponse from '../../../../mocks/api/order/create/success';
import addItemSuccessResponse from '../../../../mocks/api/order/add_item/success';

beforeEach(() => {
  jest.clearAllMocks();
});

const createWrapper = (mocks, options = {}) => shallowMount(Modal, { mocks, ...options });

describe('ItemOptions', () => {
  it('is hidden by default', () => {
    const wrapper = createWrapper(defaultState);
    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(false);
  });

  it('is visible when a product is active', () => {
    const wrapper = createWrapper(activeProductState);
    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(true);
  });

  it('adds an item on submission', async () => {
    const wrapper = createWrapper(activeProductState, {
      propsData: {
        merchant: {},
      },
    });

    wrapper.vm.reset();
    jest.spyOn(orderApi, 'create')
      .mockImplementation(createOrderSuccessResponse);
    jest.spyOn(orderApi, 'addItem')
      .mockImplementation(addItemSuccessResponse);

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');
    await flushPromises();

    expect(activeProductState.$store.dispatch).toHaveBeenCalledWith('cart/setOrder', 'test-slug');
    expect(activeProductState.$store.dispatch).toHaveBeenCalledWith('activeProduct/removeActiveProduct');
    expect(activeProductState.$store.dispatch).toHaveBeenCalledWith('cart/addToCart', {
      id: 333,
      product: activeProductState.$store.state.activeProduct.product,
      variant: activeProductState.$store.state.activeProduct.product.variants[0],
      options: [
        {
          group: 'Extras',
          items: [],
        },
      ],
      quantity: 1,
    });
  });

  it('dispatches setOrder on submit', async () => {
    const wrapper = createWrapper(activeProductState, {
      propsData: {
        merchant: {},
      },
    });

    wrapper.vm.reset();
    const spy = jest.spyOn(orderApi, 'create')
      .mockImplementation(createOrderSuccessResponse);

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');
    expect(spy).toBeCalled();
    expect(activeProductState.$store.dispatch).toHaveBeenCalledWith('cart/setOrder', 'test-slug');
  });

  it('doesnt dispatch setOrder if an order is set', async () => {
    const wrapper = createWrapper(activeProductWithOrderState, {
      propsData: {
        merchant: {},
      },
    });

    wrapper.setData({ selectedVariant: { id: 1 } });
    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');
    expect(activeProductState.$store.dispatch).not.toHaveBeenCalledWith('cart/setOrder', 'test-slug');
  });

  it('makes an add item request on submit', async () => {
    const wrapper = createWrapper(activeProductWithOrderState, {
      propsData: {
        merchant: {},
      },
    });

    wrapper.setData({ selectedVariant: { id: 1 } });
    const spy = jest.spyOn(orderApi, 'addItem');
    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');
    expect(spy).toBeCalled();
  });

  it('removes the activeProduct on close', () => {
    const wrapper = mount(Modal, {
      mocks: activeProductState,
    });

    wrapper.find('.modal__mask').trigger('click');
    expect(activeProductState.$store.dispatch).toBeCalledWith('activeProduct/removeActiveProduct');
  });

  it('default selects the first variant', () => {
    const wrapper = mount(Modal, {
      mocks: activeProductState,
    });

    wrapper.vm.reset();
    expect(wrapper.vm.selectedVariant.id).toEqual(wrapper.vm.$store.state.activeProduct.product.variants[0].id);
  });

  it('sets option groups', () => {
    const wrapper = mount(Modal, {
      mocks: activeProductState,
    });

    wrapper.vm.reset();
    expect(wrapper.vm.options[0].group).toEqual('Extras');
  });

  it('sets the correct selectedOptions ids', () => {
    const wrapper = mount(Modal, {
      mocks: activeProductState,
    });

    wrapper.vm.reset();
    wrapper.setData({
      options: [{
        group: 'Extras',
        items: [
          { id: 2 },
          { id: 6 },
        ],
      },
      {
        group: 'More Extras',
        items: [
          { id: 12 },
        ],
      }],
    });

    expect(wrapper.vm.selectedOptions).toEqual([2, 6, 12]);
  });

  it('can find the id of newly added item from the api response', () => {
    const wrapper = createWrapper(activeProductWithOrderState);
    expect(wrapper.vm.findMissingItemId(addItemSuccessResponse().data.items)).toEqual(333);
  });
});
