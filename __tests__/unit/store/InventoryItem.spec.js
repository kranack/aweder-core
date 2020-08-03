import { createLocalVue, shallowMount } from '@vue/test-utils';
import Vuex from 'vuex';
import InventoryItem from '@/js/components/store/InventoryItem';
import defaultActiveproductState from './mocks/active_product/default';
import '@/js/filters/Currency';

describe('InventoryItem', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);

  const propsData = {
    product: {
      title: 'Item title',
      description: 'Item description',
      price: '500',
    },
  };

  it('displays the available contents', async () => {
    const wrapper = shallowMount(InventoryItem, {
      propsData,
      store: new Vuex.Store(defaultActiveproductState),
      localVue,
    });

    expect(wrapper.find('.inventory__title').text()).toContain('Item title');
    expect(wrapper.find('.inventory__description').text()).toContain('Item description');
    expect(wrapper.find('.inventory__price').text()).toContain('£5.00');
  });

  it('dispatches the setActiveProduct action', () => {
    const wrapper = shallowMount(InventoryItem, {
      propsData,
      store: new Vuex.Store(defaultActiveproductState),
      localVue,
    });

    wrapper.find('.inventory__button').trigger('click');

    expect(defaultActiveproductState.actions['activeProduct/setActiveProduct']).toHaveBeenCalled();
  });
});
