import { shallowMount } from '@vue/test-utils';
import InventoryItem from '@/js/components/admin/inventory/InventoryItem';
import '@/js/filters/Currency';

describe('InventoryItem', () => {
  const wrapper = shallowMount(InventoryItem, {
    propsData: {
      categoryId: 1,
      item: {
        title: 'Item title',
        description: 'Item description',
        price: '500',
      },
    },
  });

  it('displays the available contents', () => {
    expect(wrapper.find('.inventory__title').text()).toContain('Item title');
    expect(wrapper.find('.inventory__description').text()).toContain('Item description');
    expect(wrapper.find('.inventory__price').text()).toContain('£5.00');
  });

  it('triggers the edit inventory modal to open', () => {
    wrapper.find('.inventory__trigger').trigger('click');
    expect(wrapper.vm.isActive).toBe(true);
  });
});
