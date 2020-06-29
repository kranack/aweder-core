import axios from 'axios';
import config from '@/js/config';

axios.defaults.headers.common['Content-Type'] = 'application/json';
axios.defaults.headers.common.Accept = 'application/x.awe-der.v1+json';
axios.defaults.baseURL = config.apiUrl;

axios.interceptors.request.use(
  (axiosConfig) => axiosConfig,
  (error) => Promise.reject(error),
);

export default axios;
