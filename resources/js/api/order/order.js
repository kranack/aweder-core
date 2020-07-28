import HTTP from '@/js/api/common-http';

const orderApi = {
  create(data) {
    return HTTP.post('api/order', data);
  },
  get(orderId) {
    return HTTP.get(`api/order/${orderId}`);
  },
  addItem(orderId, data) {
    return HTTP.post(`api/order/${orderId}/item`, data);
  },
  updateItem(orderId, itemId, data) {
    return HTTP.patch(`api/order/${orderId}/item/${itemId}`, data);
  },
};

export default orderApi;
