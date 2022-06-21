import axios from 'axios';
import AuthService from '@/services/auth/AuthService';
import router from '@/router';

const API_URL = process.env.VUE_APP_API_URL;

axios.interceptors.request.use(
  config => {
    if (AuthService.getToken()) {
      config.headers['Authorization'] = `Bearer ${AuthService.getToken()}`;
    }
    return config;
  },
  error => Promise.reject(error)
);

axios.interceptors.response.use(
  response => response,
  error => {
    const allError = error?.response?.data?.error;

    if (allError.code === 404) {
      router.push({ name: 'Error404' });
    }

    if (allError === 'Unauthorized') {
      AuthService.removeToken();
    }

    const nextError = new Error(allError?.message || error);

    if (allError.validator) {
      const validatorError = {};

      for (let errorName in allError.validator) {
        validatorError[errorName] = allError.validator[errorName][0];
      }

      nextError.validatorError = validatorError;
    }

    nextError.response = error.response;
    return Promise.reject(nextError);
  }
);
const requestService = {
  get(url, params = {}, headers = {}) {
    return axios.get(API_URL + url, {
      params,
      headers
    });
  },
  post(url, body = {}, config = {}) {
    return axios.post(API_URL + url, body, config);
  },
  put(url, body = {}, config = {}) {
    return axios.put(API_URL + url, body, config);
  },
  patch(url, body = {}, config = {}) {
    return axios.patch(API_URL + url, body, config);
  },
  delete(url, config = {}) {
    return axios.delete(API_URL + url, config);
  }
};

export default requestService;
