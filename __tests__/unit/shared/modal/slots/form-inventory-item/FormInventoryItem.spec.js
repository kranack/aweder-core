import { shallowMount } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/slots/FormInventoryItem';
import MethodField from '@/js/components/shared/form/MethodField';

describe('Create FormInventoryItem', () => {
  const wrapper = shallowMount(Modal, {
    propsData: {
      isActive: true,
      categoryId: 1,
      formType: 'create',
    },
  });

  it('it sets the correct form method', () => {
    expect(wrapper.findComponent(MethodField).attributes('method')).toBe('post');
  });

  it('it sets the correct form action', () => {
    expect(wrapper.find('form').attributes('action')).toBe('/admin/inventory');
  });
});

describe('Update FormInventoryItem', () => {
  const wrapper = shallowMount(Modal, {
    propsData: {
      isActive: true,
      categoryId: 1,
      formType: 'update',
      item: {
        id: 99,
        title: 'Title',
        price: 1000,
        description: 'Description',
      },
    },
  });

  it('it sets the correct form method', () => {
    expect(wrapper.findComponent(MethodField).attributes('method')).toBe('put');
  });

  it('it sets the correct form action', () => {
    expect(wrapper.find('form').attributes('action')).toBe('/admin/inventory/99/update');
  });

  it('fills the form with item data', () => {
    expect(wrapper.vm.form.title).toEqual('Title');
    expect(wrapper.vm.form.amount).toEqual(1000);
    expect(wrapper.vm.form.description).toEqual('Description');
  });
});
