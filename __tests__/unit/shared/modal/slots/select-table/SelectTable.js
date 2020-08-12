import { mount, createLocalVue } from '@vue/test-utils';
import { ValidationProvider, ValidationObserver } from 'vee-validate';
import '@/js/validation/rules';
import Modal from '@/js/components/shared/modal/slots/SelectTable';
import defaultState from './mocks/default';

const localVue = createLocalVue();
localVue.component('ValidationObserver', ValidationObserver);
localVue.component('ValidationProvider', ValidationProvider);

describe('SelectTable', () => {
  const propsData = {
    merchant: {
      url_slug: 'test-store',
    },
  };
  const wrapper = mount(Modal, {
    propsData,
    mocks: defaultState,
    localVue,
  });

  it('links to take away', () => {
    expect(wrapper.find('a').attributes('href')).toBe('/test-store/take-away');
  });

  it('dispatches set table number', () => {
    wrapper.setData({ table: '12' });
    wrapper.vm.save();
    expect(defaultState.$store.dispatch).toBeCalledWith('cart/setTable', '12');
    expect(defaultState.$store.dispatch).toBeCalledWith('modals/setSelectTable', false);
  });
});
