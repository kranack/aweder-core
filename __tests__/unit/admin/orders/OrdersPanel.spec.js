import { mount, shallowMount } from '@vue/test-utils';
import OrdersPanel from '@/js/components/admin/orders/OrdersPanel';

describe('OrdersPanel', () => {
  it('changes active order items with tabs', () => {
    const wrapper = shallowMount(OrdersPanel, {
      propsData: {
        openOrders: ['open-orders'],
        fulfilledOrders: ['fulfilled-orders'],
      },
    });

    expect(wrapper.vm.currentOrders[0]).toBe('open-orders');

    wrapper.findAll('.tab-menu__link').at(1).trigger('click');

    expect(wrapper.vm.currentOrders[0]).toBe('fulfilled-orders');
  });
});
