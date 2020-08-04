import { shallowMount, createLocalVue } from '@vue/test-utils';
import Notification from '@/js/components/shared/Notification';
import storeConfig from '@/js/store/config';
import Vuex from 'vuex';

describe('Notification', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);

  it('displays a success message', () => {
    storeConfig.modules.notification.state = {
      visible: true,
      type: 'success',
      message: 'Notification message',
    };

    const wrapper = shallowMount(Notification, {
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    expect(wrapper.find('.notification--success').exists()).toBe(true);
    expect(wrapper.find('.notification--success').text()).toContain('Notification message');
  });

  it('displays an error message', () => {
    storeConfig.modules.notification.state = {
      visible: true,
      type: 'error',
      message: 'Notification message',
    };

    const wrapper = shallowMount(Notification, {
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    expect(wrapper.find('.notification--error').exists()).toBe(true);
    expect(wrapper.find('.notification--error').text()).toContain('Notification message');
  });

  it('hides when visible is false', async () => {
    storeConfig.modules.notification.state = {
      visible: false,
      type: 'success',
      message: 'Notification message',
    };

    const wrapper = shallowMount(Notification, {
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    expect(wrapper.find('.notification').exists()).toBe(false);
  });
});
