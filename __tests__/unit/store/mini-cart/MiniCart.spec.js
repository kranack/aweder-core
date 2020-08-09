import { shallowMount } from '@vue/test-utils';
import MiniCart from '@/js/components/store/MiniCart';
import VueMoment from 'vue-moment';
import Vue from 'vue';
import productsWithoutVariantState from './mocks/products-without-variant';
import productsWithVariantState from './mocks/products-with-variant';
import defaultMockState from './mocks/default';
import '@/js/filters/Currency';
import '@/js/filters/Capitalize';

Vue.use(VueMoment);

describe('MiniCart', () => {
  const createWrapper = (state) => {
    return shallowMount(MiniCart, {
      propsData: { merchant: { delivery_cost: 599 } },
      mocks: state,
    });
  };

  it('is inactive when the cart is empty', () => {
    const wrapper = createWrapper(defaultMockState);

    expect(wrapper.find('.cart--empty').exists()).toBe(true);
  });

  it('shows cart items', async () => {
    const wrapper = createWrapper(productsWithoutVariantState);

    expect(wrapper.find('.cart__line').text()).toContain('Nachos,Cheese & Chilli');
    expect(wrapper.find('.cart__line').text()).toContain('£5.00');
    expect(wrapper.find('.cart__option-title').text()).toContain('Option Group');
    expect(wrapper.find('.cart__option-item').text()).toContain('Option 1');
    expect(wrapper.find('.cart__option-item').text()).toContain('£4.99');
  });

  it('shows item variant', async () => {
    const wrapper = createWrapper(productsWithVariantState);

    expect(wrapper.find('.cart__title').text()).toContain('Variant - Nachos,Cheese & Chilli');
    expect(wrapper.find('.cart__price').text()).toContain('£11.00');
  });

  it('shows the totals', async () => {
    const wrapper = createWrapper(productsWithoutVariantState);

    expect(wrapper.find('.subtotal').text()).toContain('£5.00');
    expect(wrapper.find('.total').text()).toContain('£10.99');
  });

  it('increments quantity', () => {
    const wrapper = createWrapper(productsWithoutVariantState);

    wrapper.find('.increment__type--up').trigger('click');
    expect(productsWithoutVariantState.$store.dispatch)
      .toHaveBeenCalledWith(
        'cart/incrementProduct',
        productsWithoutVariantState.$store.state.cart.products[0].id,
      );
  });
});
