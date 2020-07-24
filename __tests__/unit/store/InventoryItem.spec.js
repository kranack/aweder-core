import { mount, createLocalVue } from '@vue/test-utils';
import InventoryItem from '@/js/components/store/InventoryItem';
import '@/js/filters/Currency';

describe('InventoryItem', () => {
  it('displays the available contents', () => {
    const wrapper = mount(InventoryItem, {
      propsData: {
        product: {
          title: 'Item title',
          description: 'Item description',
          price: '500',
        },
      },
    });

    wrapper.vm.$nextTick(() => {
      expect(wrapper.find('.inventory__title').text()).toContain('Item title');

      expect(wrapper.find('.inventory__description').text()).toContain('Item description');

      expect(wrapper.find('.inventory__price').text()).toContain('£5.00');
    });
  });
});
