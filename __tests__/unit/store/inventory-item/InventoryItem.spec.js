import { shallowMount } from '@vue/test-utils';
import InventoryItem from '@/js/components/store/InventoryItem';
import defaultActiveProductState from './mocks/default';
import '@/js/filters/Currency';

describe('InventoryItem', () => {
  const props = {
    product: {
      title: 'Item title',
      description: 'Item description',
      price: '500',
    },
  };

  const wrapper = shallowMount(InventoryItem, {
    mocks: defaultActiveProductState,
    propsData: props,
  });

  it('displays the available contents', async () => {
    expect(wrapper.find('.inventory__title').text()).toContain('Item title');
    expect(wrapper.find('.inventory__description').text()).toContain('Item description');
    expect(wrapper.find('.inventory__price').text()).toContain('£5.00');
  });

  it('dispatches the setActiveProduct action', () => {
    wrapper.find('.inventory__button').trigger('click');
    expect(defaultActiveProductState.$store.dispatch)
      .toHaveBeenCalledWith('activeProduct/setActiveProduct', props.product);
  });
});
