import { reactive } from "vue";

export default reactive({
    auth: window.Auth,
    get userId() {
        return this.auth?.user?.id;
    },
});
