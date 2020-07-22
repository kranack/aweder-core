import { mount } from '@vue/test-utils';
import Popup from '@/js/components/shared/Popup';

describe('Popup', () => {
  it('is inactive and hidden by default', () => {
    const wrapper = mount(Popup);

    expect(wrapper.vm.isActive).toBe(false);

    expect(wrapper.find('.popup').exists()).toBe(false);
  });

  it('is visible when active', () => {
    const wrapper = mount(Popup, {
      propsData: {
        isActive: true,
      },
    });

    expect(wrapper.find('.popup').exists()).toBe(true);
  });

  it('displays slot contents', () => {
    const wrapper = mount(Popup, {
      propsData: {
        isActive: true,
      },
      slots: {
        default: 'Test slot text',
      },
    });

    expect(wrapper.find('.popup__box').text()).toContain('Test slot text');
  });

  it('fires a close event on background click', () => {
    const wrapper = mount(Popup, {
      propsData: {
        isActive: true,
      },
    });

    wrapper.find('.popup__mask').trigger('click');

    expect(wrapper.emitted().close).toBeTruthy();
  });
});
