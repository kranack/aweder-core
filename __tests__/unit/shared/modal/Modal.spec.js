import { mount } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/Modal';

describe('Modal', () => {
  it('is inactive and hidden by default', () => {
    const wrapper = mount(Modal);

    expect(wrapper.vm.isActive).toBe(false);

    expect(wrapper.find('.modal').exists()).toBe(false);
  });

  it('is visible when active', () => {
    const wrapper = mount(Modal, {
      propsData: {
        isActive: true,
      },
    });

    expect(wrapper.find('.modal').exists()).toBe(true);
  });

  it('displays slot contents', () => {
    const wrapper = mount(Modal, {
      propsData: {
        isActive: true,
      },
      slots: {
        default: 'Test slot text',
      },
    });

    expect(wrapper.find('.modal__box').text()).toContain('Test slot text');
  });

  it('fires a close event on background click', () => {
    const wrapper = mount(Modal, {
      propsData: {
        isActive: true,
      },
    });

    wrapper.find('.modal__mask').trigger('click');

    expect(wrapper.emitted().close).toBeTruthy();
  });
});
