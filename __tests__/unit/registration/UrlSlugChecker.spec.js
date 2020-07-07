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

  it('Does the field render default url passed in ', () => {
    const testWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: false,
          validationMessage: '',
          urlValue: 'tester',
        },
      },
    );
    testWrapper.vm.$nextTick();

    expect(testWrapper.vm.urlSlug).toBe('tester');
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
    expect(failedWrapper.find('.field__error').exists()).toBe(true);
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
    expect(failedWrapper.find('.field__error').text()).toBe('The validation has failed');
  });

  it('makes sure slug checker isn\'t called on first keydown', async () => {
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

    const urlInput = urlFailedWrapper.find('#url_slug');

    urlInput.trigger('keyup',
      {
        key: 'd',
      });

    await flushPromises();

    expect(mockAxios.get).toHaveBeenCalledTimes(0);
  });

  it('makes sure slug checker isn\'t called on second keydown', async () => {
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

    const urlInput = urlFailedWrapper.find('#url_slug');

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
          validationError: false,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url_slug');

    const uri = 'validate-slug/dan';

    urlInput.setValue('dan');

    urlInput.trigger('keyup');

    await flushPromises();

    expect(mockAxios.get).toHaveBeenCalledTimes(1);
    expect(mockAxios.get).toHaveBeenCalledWith(uri);
  });

  it('validation error not shown when passed in', async () => {
    const urlFailedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: false,
          validationMessage: 'The slug is already taken.',
          urlValue: '',
        },
      },
    );

    expect(urlFailedWrapper.find('.field__error--slug').exists()).toBe(false);
  });

  it('does validation error show when api request returns url exists', async () => {
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
          validationError: false,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url_slug');

    urlInput.setValue('dan');

    urlInput.trigger('keyup');

    await flushPromises();

    expect(urlFailedWrapper.find('.field__error--slug')
      .exists())
      .toBe(true);
  });

  it('validation error doesnt show when api request returns url doesnt exists', async () => {
    mockAxios.get = jest.fn(() => Promise.resolve({
      status: 200,
      data: {
        exists: false,
      },
    }));

    const urlFailedWrapper = shallowMount(
      UrlSlugChecker,
      {
        localVue,
        propsData: {
          validationError: false,
          validationMessage: 'The validation has failed',
          urlValue: '',
        },
      },
    );

    const urlInput = urlFailedWrapper.find('#url_slug');

    const uri = 'validate-slug/dan';

    urlInput.setValue('dan');

    urlInput.trigger('keyup');

    await flushPromises();

    expect(urlFailedWrapper.find('.form__error--slug')
      .exists())
      .toBe(false);
  });
});
