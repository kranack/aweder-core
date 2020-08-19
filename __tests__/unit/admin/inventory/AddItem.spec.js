import { mount } from '@vue/test-utils';
import AddItem from '@/js/components/admin/inventory/AddItem';

describe('AddItem', () => {
  it('displays the available contents', () => {
    const wrapper = mount(AddItem);

    expect(wrapper.find('.inventory__title').text()).toContain('Example menu title');

    expect(wrapper.find('.inventory__description').text()).toContain('Example menu description');

    expect(wrapper.find('.inventory__price').text()).toContain('£0.00');
  });

  it('triggers the add inventory modal to open', () => {
    const wrapper = mount(AddItem);

    wrapper.find('.inventory__trigger').trigger('click');

    expect(wrapper.vm.isActive).toBe(true);
  });
});
