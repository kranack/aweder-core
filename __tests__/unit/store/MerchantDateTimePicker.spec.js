import { createLocalVue, shallowMount } from '@vue/test-utils';
import Vuex from 'vuex';
import storeConfig from '@/js/store/config';
import MerchantDateTimePicker from '@/js/components/shared/MerchantDateTimePicker';

describe('InventoryItem', () => {
  const localVue = createLocalVue();
  localVue.use(Vuex);
  localVue.use(require('vue-moment'));

  const propsData = {
    merchantHours: [
      {
        day_of_week: 0,
        open_time: '2020-08-07T09:00:00.000000Z',
        close_time: '2020-08-07T17:00:00.000000Z',
      },
      {
        day_of_week: 1,
        open_time: '2020-08-07T09:00:00.000000Z',
        close_time: '2020-08-07T17:00:00.000000Z',
      },
    ],
  };

  it('sets available days', async () => {
    const wrapper = shallowMount(MerchantDateTimePicker, {
      propsData,
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    expect(wrapper.vm.availableDays).toEqual([0, 1]);
  });

  it('sets unavailable days', async () => {
    const wrapper = shallowMount(MerchantDateTimePicker, {
      propsData,
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    expect(wrapper.vm.unavailableDays).toEqual([2, 3, 4, 5, 6]);
  });

  it('sets the selected day', async () => {
    const wrapper = shallowMount(MerchantDateTimePicker, {
      propsData,
      store: new Vuex.Store(storeConfig),
      localVue,
    });

    // A Friday
    wrapper.setData({ datetime: '2020-08-07' });

    expect(wrapper.vm.selectedDay).toEqual(5);
  });
});
