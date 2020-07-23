import { shallowMount } from '@vue/test-utils';
import Orders from '@/js/components/admin/orders/Orders';

describe('Orders', () => {
  it('has an intial order item', () => {
    const wrapper = shallowMount(Orders, {
      propsData: {
        orders: [{
          id: 'test-order',
        }],
      },
    });

    expect(wrapper.vm.activeOrder.id).toBe('test-order');
  });

  it('updating orders resets the active order', () => {
    const wrapper = shallowMount(Orders, {
      propsData: {
        orders: [{
          id: 'test-order',
        }],
      },
    });

    expect(wrapper.vm.activeOrder.id).toBe('test-order');

    wrapper.setProps({
      orders: [{
        id: 'new-order',
      }],
    });

    wrapper.vm.$nextTick(() => {
      expect(wrapper.vm.activeOrder.id).toBe('new-order');
    });
  });
});
