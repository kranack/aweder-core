import { shallowMount, createLocalVue } from '@vue/test-utils';
import UrlSlugChecker from 'components/registration/UrlSlugChecker';

const localVue = createLocalVue();

describe('UrlSlug Checker', () => {
  const wrapper = shallowMount(UrlSlugChecker, { localVue });

  it('Does the field render', () => {
    expect(wrapper.find("[type='email']").exists()).toBe(true);
  });
});
