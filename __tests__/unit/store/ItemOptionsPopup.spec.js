import { mount, shallowMount, createLocalVue } from '@vue/test-utils';
import Popup from '@/js/components/store/ItemOptionsPopup';
import orderApi from '@/js/api/order/order';
import Vuex from 'vuex';
import { mockInactiveStore, mockActiveStore, mockActiveStoreWithOrder } from './mocks/ItemOptionsPopup';

describe('ItemOptionsPopup', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);

  it('is hidden by default', () => {
    const wrapper = shallowMount(Popup, {
      store: new Vuex.Store(mockInactiveStore),
      localVue,
    });

    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(false);
  });

  it('is visible when a product is active', () => {
    const wrapper = shallowMount(Popup, {
      store: new Vuex.Store(mockActiveStore),
      localVue,
    });

    expect(wrapper.findComponent({ ref: 'item_options' }).exists()).toBe(true);
  });

  it('adds an item on submission', async () => {
    const wrapper = shallowMount(Popup, {
      propsData: {
        merchant: { slug: 'test-merchant' },
      },
      store: new Vuex.Store(mockActiveStore),
      localVue,
    });

    const spy = jest.spyOn(orderApi, 'create');

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(spy).toBeCalled();
    expect(mockActiveStore.actions['cart/addToCart']).toBeCalled();
    expect(mockActiveStore.actions['activeProduct/removeActiveProduct']).toBeCalled();
  });

  it('dispatches setOrder on submit', async () => {
    const wrapper = shallowMount(Popup, {
      propsData: {
        merchant: { slug: 'test-merchant' },
      },
      store: new Vuex.Store(mockActiveStore),
      localVue,
    });

    const spy = jest.spyOn(orderApi, 'create')
      .mockImplementation(() => {
        return {
          data: {
            url_slug: 'test-slug',
          },
          status: 201,
        };
      });

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(spy).toBeCalled();
    expect(mockActiveStore.actions['cart/setOrder']).toBeCalled();
  });

  it('doesnt dispatch setOrder if an order is set', async () => {
    const wrapper = shallowMount(Popup, {
      store: new Vuex.Store(mockActiveStoreWithOrder),
      localVue,
    });

    await wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(mockActiveStoreWithOrder.actions['cart/setOrder']).toHaveBeenCalledTimes(0);
  });

  it('removes the activeProduct on close', () => {
    const wrapper = mount(Popup, {
      store: new Vuex.Store(mockActiveStore),
      localVue,
    });

    wrapper.find('.popup__mask').trigger('click');

    expect(mockActiveStore.actions['activeProduct/removeActiveProduct']).toBeCalled();
  });
});
