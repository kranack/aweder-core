import { mount, shallowMount, createLocalVue } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/slots/ItemOptions';
import orderApi from '@/js/api/order/order';
import flushPromises from 'flush-promises';
import Vuex from 'vuex';
import '@/js/filters/Currency';
import defautCartState from '../../../store/mocks/active_product/default';
import activeProductState from '../../../store/mocks/active_product/activeProduct';
import activeProductWithOrderState from '../../../store/mocks/active_product/activeProductWithOrder';
import createOrderSuccessResponse from '../../../store/mocks/api/order/create/success';
import addItemSuccessResponse from '../../../store/mocks/api/order/add_item/success';

describe('ItemOptions', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);

  it('is hidden by default', () => {
    const wrapper = shallowMount(Modal, {
      store: new Vuex.Store(defautCartState),
      localVue,
    });

    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(false);
  });

  it('is visible when a product is active', () => {
    const wrapper = shallowMount(Modal, {
      store: new Vuex.Store(activeProductState),
      localVue,
    });

    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(true);
  });

  it('adds an item on submission', async () => {
    const wrapper = shallowMount(Modal, {
      propsData: {
        merchant: {},
      },
      store: new Vuex.Store(activeProductState),
      localVue,
    });

    wrapper.setData({ selectedVariant: { id: 1 } });

    jest.spyOn(orderApi, 'create')
      .mockImplementation(createOrderSuccessResponse);

    jest.spyOn(orderApi, 'addItem')
      .mockImplementation(addItemSuccessResponse);

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');
    await flushPromises();

    expect(activeProductState.actions['cart/addToCart']).toBeCalled();
    expect(activeProductState.actions['activeProduct/removeActiveProduct']).toBeCalled();
  });

  it('dispatches setOrder on submit', async () => {
    const wrapper = shallowMount(Modal, {
      propsData: {
        merchant: {},
      },
      store: new Vuex.Store(activeProductState),
      localVue,
    });

    wrapper.setData({ selectedVariant: { id: 1 } });

    const spy = jest.spyOn(orderApi, 'create')
      .mockImplementation(createOrderSuccessResponse);

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(spy).toBeCalled();
    expect(activeProductState.actions['cart/setOrder']).toBeCalled();
  });

  it('doesnt dispatch setOrder if an order is set', async () => {
    const wrapper = shallowMount(Modal, {
      propsData: {
        merchant: {},
      },
      store: new Vuex.Store(activeProductWithOrderState),
      localVue,
    });

    wrapper.setData({ selectedVariant: { id: 1 } });

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(activeProductWithOrderState.actions['cart/setOrder']).toHaveBeenCalledTimes(0);
  });

  it('makes an add item request on submit', async () => {
    const wrapper = shallowMount(Modal, {
      propsData: {
        merchant: { url_slug: 'test-merchant' },
      },
      store: new Vuex.Store(activeProductWithOrderState),
      localVue,
    });

    wrapper.setData({ selectedVariant: { id: 1 } });

    const spy = jest.spyOn(orderApi, 'addItem');

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(spy).toBeCalled();
  });

  it('removes the activeProduct on close', () => {
    const wrapper = mount(Modal, {
      store: new Vuex.Store(activeProductState),
      localVue,
    });

    wrapper.find('.modal__mask').trigger('click');

    expect(activeProductState.actions['activeProduct/removeActiveProduct']).toBeCalled();
  });

  it('default selects the first variant', () => {
    const wrapper = mount(Modal, {
      store: new Vuex.Store(activeProductState),
      localVue,
    });

    wrapper.vm.reset();

    expect(wrapper.vm.selectedVariant.id).toEqual(wrapper.vm.$store.state.activeProduct.product.variants[0].id);
  });
});
