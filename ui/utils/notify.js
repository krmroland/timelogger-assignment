import { reactive } from "vue";

export default reactive({
  type: "info",
  text: "",
  props: {},
  confirmation: {},
  timeoutId: null,

  close() {
    this.text = null;
    clearTimeout(this.timeoutId);
  },
  show(type, text, props = {}) {
    this.type = type;
    this.text = text;
    this.props = props || {};

    if (props.autoClose === false) {
      return;
    }

    this.timeoutId = setTimeout(() => {
      this.text = null;
    }, 90000);
  },
  success(...args) {
    this.show("success", ...args);
  },
  error(error, ...args) {
    const message =
      error instanceof Error
        ? error.response?.data?.message || error.message
        : error;

    this.show("error", message, ...args);
  },

  warning(...args) {
    this.show("error", ...args);
  },

  info(...args) {
    this.show("info", ...args);
  },

  handleConfirm(value) {
    if (value) {
      return this.confirmation?.resolve(true);
    }

    return this.confirmation?.resolve(false);
  },

  confirm(message, options = {}) {
    this.confirmation = { message, options };

    return new Promise((resolve, reject) => {
      this.confirmation.resolve = resolve;
      this.confirmation.reject = reject;
    }).finally(() => {
      this.confirmation = {};
    });
  },
});
