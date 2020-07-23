import { shallowMount, createLocalVue } from '@vue/test-utils';
import OrderItem from '@/js/components/admin/orders/OrderItem';

const localVue = createLocalVue();
localVue.use(require('vue-moment'));

describe('OrderItem', () => {
  it('fires a selected order event on click', () => {
    const wrapper = shallowMount(OrderItem, {
      localVue,
      propsData: {
        order: {
          id: 'test-order',
          available_time: '0000-01-01 00:00:00',
        },
      },
    });

    wrapper.find('div').trigger('click');

    expect(wrapper.emitted()['selected-order'][0][0].id).toBe('test-order');
  });
});
