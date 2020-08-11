import HTTP from '@/js/api/common-http';

const orderApi = {
  create(data) {
    return HTTP.post('api/v1/order', data);
  },
  get(orderId) {
    return HTTP.get(`api/v1/order/${orderId}`);
  },
  addItem(orderId, data) {
    return HTTP.post(`api/v1/order/${orderId}/item`, data);
  },
  updateItem(orderId, itemId, data) {
    return HTTP.patch(`api/v1/order/${orderId}/item/${itemId}`, data);
  },
  deleteItem(orderId, itemId, data) {
    return HTTP.delete(`api/v1/order/${orderId}/item/${itemId}`, { data });
  },
};

export default orderApi;
