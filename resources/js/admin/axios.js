const axios = require('axios').default;

const instance = axios.create();

const api = {
    async request(method, url, params, data, headers = {}, config = {}) {
        return await instance.request({ ...config, url, params, data, method: method.toLowerCase(), headers });
    },

    async get(url, params = {}, headers = {}, config = {}) {
        return await this.request('get', url, params, {}, headers, config)
    },

    async post(url, data = {}, headers = {}, config = {}) {
        return await this.request('post', url, {}, data, headers, config)
    },

    async put(url, data, config = {}) {
        return await this.request('put', url, {}, data, {}, config)
    },

    async delete(url, data = {}, config = {}) {
        return await this.request('delete', url, {}, data, {}, config)
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
