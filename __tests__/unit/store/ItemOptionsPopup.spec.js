import { mount, shallowMount, createLocalVue } from '@vue/test-utils';
import Popup from '@/js/components/store/ItemOptionsPopup';
import orderApi from '@/js/api/order/order';
import Vuex from 'vuex';
import { mockInactiveStore, mockActiveStore } from './mocks/ItemOptionsPopup';

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

  it('adds an item on submission', () => {
    const wrapper = shallowMount(Popup, {
      store: new Vuex.Store(mockActiveStore),
      localVue,
    });

    const spy = jest.spyOn(orderApi, 'create');

    wrapper.findComponent({ ref: 'add_item' }).trigger('click');

    expect(spy).toBeCalled();
    expect(mockActiveStore.actions['cart/addToCart']).toBeCalled();
    expect(mockActiveStore.actions['activeProduct/removeActiveProduct']).toBeCalled();
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
