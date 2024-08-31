import axios from "axios";
import api from "@/api.js";


const csrf = () => axios.get('/sanctum/csrf-cookie')

export default {
    namespaced: true,

    state: {
        userData: null
    },

    getters: {
        user: state => state.userData
    },

    mutations: {
        setUserData(state, user) {
            state.userData = user;
        }
    },

    actions: {

        async getUserData({ commit }) {
            await csrf()
            api.get('/api/user')
                .then(res => {
                    console.log(res.data);
                    // commit("setUserData", res.data);
                })
                .catch(() => {
                    console.log("no user");
                });
        },
        // sendLoginRequest({ commit }, data) {
        // commit("setErrors", {}, { root: true });
        // return axios
        //     .post(process.env.VUE_APP_API_URL + "login", data)
        //     .then(response => {
        //     commit("setUserData", response.data.user);
        //     localStorage.setItem("authToken", response.data.token);
        //     });
        // },
        // sendRegisterRequest({ commit }, data) {
        // commit("setErrors", {}, { root: true });
        // return axios
        //     .post(process.env.VUE_APP_API_URL + "register", data)
        //     .then(response => {
        //     commit("setUserData", response.data.user);
        //     localStorage.setItem("authToken", response.data.token);
        //     });
        // },
        // sendLogoutRequest({ commit }) {
        // axios.post(process.env.VUE_APP_API_URL + "logout").then(() => {
        //     commit("setUserData", null);
        //     localStorage.removeItem("authToken");
        // });
        // },
        // sendVerifyResendRequest() {
        // return axios.get(process.env.VUE_APP_API_URL + "email/resend");
        // },
        // sendVerifyRequest({ dispatch }, hash) {
        // return axios
        //     .get(process.env.VUE_APP_API_URL + "email/verify/" + hash)
        //     .then(() => {
        //     dispatch("getUserData");
        //     });
        // }
    }
};