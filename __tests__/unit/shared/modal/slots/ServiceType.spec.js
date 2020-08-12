import { mount, shallowMount } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/slots/ServiceType';

describe('ServiceType', () => {
  const propsData = {
    isActive: true,
    takeAwayUrl: '/take-away',
    tableServiceUrl: '/table-service',
  };

  it('is inactive and hidden by default', () => {
    const wrapper = shallowMount(Modal);

    expect(wrapper.vm.isActive).toBe(false);
    expect(wrapper.find('.modal').exists()).toBe(false);
  });

  it('is visible when active', () => {
    const wrapper = mount(Modal, {
      propsData,
    });

    expect(wrapper.find('.modal').exists()).toBe(true);
  });

  it('has service links', () => {
    const wrapper = mount(Modal, {
      propsData,
    });

    expect(wrapper.findComponent({ ref: 'take_away' }).attributes('href')).toBe('/take-away');
    expect(wrapper.findComponent({ ref: 'table_service' }).attributes('href')).toBe('/table-service');
  });
});
