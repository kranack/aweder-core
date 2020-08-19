import { shallowMount } from '@vue/test-utils';
import Modal from '@/js/components/shared/modal/slots/OrderType';
import defaultState from './mocks/default';

describe('OrderType', () => {
  const propsData = {
    merchant: {
      url_slug: 'test-store',
      opening_hours: [],
    },
  };

  it('links to table ordering', () => {
    const wrapper = shallowMount(Modal, {
      propsData,
      mocks: defaultState,
    });

    expect(wrapper.find('a').attributes('href')).toBe('/test-store/table-order');
  });
});
