import axios from 'axios';

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

axios.defaults.withCredentials = false;

const instance = axios.create({
  headers: {
    Accept: 'application/json',
  },
});

instance.getErrorMessageFromResponse = (error) => {
  return error?.response?.data?.message || error?.message || 'Something went wrong';
};

export default instance;
