import { shallowMount, createLocalVue } from '@vue/test-utils';
import UrlSlugChecker from '@/js/components/registration/UrlSlugChecker';
import mockAxios from 'axios';
import flushPromises from 'flush-promises';

const localVue = createLocalVue();

describe('UrlSlug Checker', () => {
  const wrapper = shallowMount(
    UrlSlugChecker,
    {
      localVue,
      props: {
        validationError: false,
        validationMessage: '',
        urlValue: '',
      },
    },
  );

  it('Does the field render with default values', () => {
    expect(wrapper.find("[type='text']").exists()).toBe(true);
  });

  it('Does the field render the validation paragraph when a validation error is present', () => {
    const failedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').exists()).toBe(true);
  });

  it('Does the field render the validation error message when a validation error is present', () => {
    const failedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );
    expect(failedWrapper.find('.form__validation-error').text()).toBe('The validation has failed');
  });

  it('makes sure slug checker isnt called on first keydown', async () => {
    mockAxios.get = jest.fn(() => Promise.resolve({
      status: 200,
      data: {
        exists: true,
      },
    }));

    const urlFailedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url-slug');

    urlInput.trigger('keyup',
      {
        key: 'd',
      });

    await flushPromises();

    expect(mockAxios.get).toHaveBeenCalledTimes(0);
  });

  it('makes sure slug checker isnt called on second keydown', async () => {
    mockAxios.get = jest.fn(() => Promise.resolve({
      status: 200,
      data: {
        exists: true,
      },
    }));

    const urlFailedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url-slug');

    urlInput.setValue('da');

    urlInput.trigger('keyup',
      {
        key: 'a',
      });

    await flushPromises();

    expect(mockAxios.get).toHaveBeenCalledTimes(0);
  });

  it('makes sure slug checker is called on third keydown', async () => {
    mockAxios.get = jest.fn(() => Promise.resolve({
      status: 200,
      data: {
        exists: true,
      },
    }));

    const urlFailedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: true,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url-slug');

    const uri = 'validate-slug/dan';

    urlInput.setValue('dan');

    urlInput.trigger('keyup');

    await flushPromises();

    expect(mockAxios.get).toHaveBeenCalledTimes(1);
    expect(mockAxios.get).toHaveBeenCalledWith(uri);
  });
});
