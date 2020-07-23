import { mount, shallowMount } from '@vue/test-utils';
import Popup from '@/js/components/shared/store/ServiceTypePopup';

describe('ServiceTypePopup', () => {
  it('is inactive and hidden by default', () => {
    const wrapper = shallowMount(Popup);

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

  it('is has service links', () => {
    const wrapper = mount(Popup, {
      propsData: {
        isActive: true,
        takeAwayUrl: '/take-away',
        tableServiceUrl: '/table-service',
      },
    });

    expect(wrapper.findComponent({ ref: 'take_away' }).attributes('href')).toBe('/take-away');

    expect(wrapper.findComponent({ ref: 'table_service' }).attributes('href')).toBe('/table-service');
  });
});
