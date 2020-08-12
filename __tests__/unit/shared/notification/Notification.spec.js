import { shallowMount, createLocalVue } from '@vue/test-utils';
import Notification from '@/js/components/shared/Notification';
import Vuex from 'vuex';
import success from './mocks/success';
import error from './mocks/error';
import hidden from './mocks/hidden';

const createWrapper = (mocks) => shallowMount(Notification, { mocks });

describe('Notification', () => {
  it('displays a success message', () => {
    const wrapper = createWrapper(success);
    expect(wrapper.find('.notification--success').exists()).toBe(true);
    expect(wrapper.find('.notification--success').text()).toContain('Notification message');
  });

  it('displays an error message', () => {
    const wrapper = createWrapper(error);
    expect(wrapper.find('.notification--error').exists()).toBe(true);
    expect(wrapper.find('.notification--error').text()).toContain('Notification message');
  });

  it('hides when visible is false', async () => {
    const wrapper = createWrapper(hidden);
    expect(wrapper.find('.notification').exists()).toBe(false);
  });
});
