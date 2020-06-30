import HTTP from '@/js/api/common-http';

const slugChecker = {
  checkIfBusinessSlugExists(slug) {
    const endpoint = `validate-slug/${slug}`;
    return HTTP.get(endpoint).then((response) => response)
      .catch((error) => {
        throw error;
      });
  },
};

export default slugChecker;
