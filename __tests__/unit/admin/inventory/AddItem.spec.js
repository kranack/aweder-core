import { shallowMount } from '@vue/test-utils';
import AddItem from '@/js/components/admin/inventory/AddItem';

describe('AddItem', () => {
  const wrapper = shallowMount(AddItem, {
    propsData: {
      categoryId: 1,
    },
  });

  it('displays the available contents', () => {
    expect(wrapper.find('.inventory__title').text()).toContain('Example menu title');
    expect(wrapper.find('.inventory__description').text()).toContain('Example menu description');
    expect(wrapper.find('.inventory__price').text()).toContain('£0.00');
  });

  it('triggers the add inventory modal to open', () => {
    wrapper.find('.inventory__trigger').trigger('click');
    expect(wrapper.vm.isActive).toBe(true);
  });
});
