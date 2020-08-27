import HTTP from '@/js/api/common-http';

const openingHours = {
  get(data, merchantId) {
    return HTTP.get(`api/v1/${merchantId}/openinghours`, data);
  },
};

export default openingHours;
