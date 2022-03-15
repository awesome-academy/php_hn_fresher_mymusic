const axios = require('axios').default;

let tz = Intl.DateTimeFormat().resolvedOptions().timeZone == 'Asia/Saigon'
  ? 'Asia/Ho_Chi_Minh'
  : Intl.DateTimeFormat().resolvedOptions().timeZone;

axios.defaults.baseURL = process.env.VUE_APP_API_URL;
axios.defaults.headers.common['contentType'] = 'application/json';
axios.defaults.headers.common['Cache-Control'] = 'no-cache';
axios.defaults.headers.common['Cache-control'] = 'no-store';
axios.defaults.headers.common['Access-Control-Allow-Origin'] = '*';
axios.defaults.headers.common['Pragma'] = 'no-cache';
axios.defaults.headers.common['Timezone'] = tz;
axios.defaults.headers.common['X-Request-With'] = 'XMLHttpRequest';

const api = {
  request(method, url, params, data, headers = {}, config = {}) {
    return axios.request({ ...config, url, params, data, method: method.toLowerCase(), headers });
  },

  get(url, params = {}, headers = {}, config = {}) {
    return this.request('get', url, params, {}, headers, config)
  },

  post(url, data = {}, headers = {}, config = {}) {
    return this.request('post', url, {}, data, headers, config)
  },

  put(url, data, config = {}) {
    return this.request('put', url, {}, data, {}, config)
  },

  delete(url, data = {}, config = {}) {
    return this.request('delete', url, {}, data, {}, config)
  },
}

const apiService = {
  async get(url, params = {}) {
    try {
      let result = await api.get(url, params);

      return result;
    } catch (e) {
      throw e;
    }
  },

  async post(url, data = {}, headers = {}) {
    try {
      let result = await api.post(url, data, headers);

      return result;
    } catch (e) {
      throw e;
    }
  },

  async put(url, data = {}, headers = {}) {
    try {
      let result = await api.put(url, data, headers);

      return result;
    } catch (e) {
      throw e;
    }
  },

  async delete(url, data = {}) {
    try {
      let result = await api.delete(url, data);

      return result;
    } catch (e) {
      throw e;
    }
  }
}

window.apiService = apiService;

export default apiService;
