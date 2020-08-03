import { mount } from '@vue/test-utils';
import InventoryItem from '@/js/components/admin/inventory/InventoryItem';

describe('InventoryItem', () => {
  it('displays the available contents', () => {
    const wrapper = mount(InventoryItem, {
      propsData: {
        title: 'Item title',
        description: 'Item description',
        price: '5.00',
      },
    });

    expect(wrapper.find('.inventory__title').text()).toContain('Item title');

    expect(wrapper.find('.inventory__description').text()).toContain('Item description');

    expect(wrapper.find('.inventory__price').text()).toContain('£5.00');
  });

  it('triggers the edit inventory modal to open', () => {
    const wrapper = mount(InventoryItem);

    wrapper.find('.inventory__trigger').trigger('click');

    expect(wrapper.vm.isActive).toBe(true);
  });
});
