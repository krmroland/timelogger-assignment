import { set } from "lodash-es";
import { reactive } from "vue";

import notify from "@/utils/notify";

export default function useForm(data = {}) {
  const form = reactive({
    ...data,
    isDirty: false,
    errors: {},
    error: null,
    hasErrors: false,
    processing: false,
    rehydrate(value) {
      if (!Object.keys(value || {}).length) {
        return;
      }

      Object.keys(value).forEach((key) => {
        this[key] = value[key];
      });
    },
    reset() {
      Object.keys(data).forEach((key) => {
        this[key] = data[key];
      });
    },
    setErrors(errors) {
      this.errors = Object.entries(errors || {}).reduce(
        (prev, [key, value]) => {
          return set(prev, key, value);
        },
        {},
      );

      this.hasErrors = Object.keys(this.errors).length > 0;

      return this;
    },

    updateValues(values) {
      return this.rehydrate(values);
    },
    clearErrors() {
      this.error = null;

      this.errors = {};

      this.hasErrors = false;

      return this;
    },

    wrapResponse(response) {
      return response
        .then((response) => Promise.resolve(response))
        .catch((e) => {
          const response = e.response || {};

          this.error = response.data?.message || e?.message;

          this.setErrors(response.data?.errors || {});

          const message = `Something went wrong while making a request to ${response.config?.url} error: ${this.error}`;

          if (e.code !== "ERR_CANCELED") {
            notify.error(message);
          }

          return Promise.reject(e);
        })
        .finally(() => {
          this.processing = false;
        });
    },

    data() {
      return Object.keys(data).reduce((next, key) => {
        next[key] = this[key];
        return next;
      }, {});
    },
    async submit(method, url, givenOptions = {}) {
      const { extraData, ...options } = givenOptions;

      const { default: http } = await import("@/utils/http");

      const data = Object.assign(this.data(), extraData || {});

      this.clearErrors();

      this.processing = true;

      if (method === "delete") {
        return this.wrapResponse(http.delete(url, { ...options, data }));
      }

      return this.wrapResponse(http[method](url, data, options));
    },
    get(url, options) {
      return this.submit("get", url, options);
    },
    post(url, options) {
      return this.submit("post", url, options);
    },
    put(url, options) {
      return this.submit("put", url, options);
    },
    patch(url, options) {
      return this.submit("patch", url, options);
    },
    delete(url, options) {
      return this.submit("delete", url, options);
    },

    onError(callback) {
      this.onError = callback;
      return this;
    },
  });

  return form;
}
