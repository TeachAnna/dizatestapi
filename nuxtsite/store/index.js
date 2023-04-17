import axios from 'axios';

export const state = () => ({
    urlSite: 'http://localhost:8000',
    admins: {},
    token: localStorage.getItem('token') || "",
    isloading: false,
})

export const getters = {

};

export const mutations = {
    setAdmins(state, admins) {
        state.admins = admins;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setToken(state, token) {
        state.token = token;
    },
}

export const actions = {

    async nuxtServerInit({ dispatch }) {
        // await dispatch('desks/fetchDesks')
        // await dispatch('images/fetchImages')
    },

    async adminLogins({ commit }, data) {
        commit('setIsLoading', true);
        const admins = await this.$axios.post('http://localhost:8000/api/login', data);
        if (admins.data.success) {
            this.$toast.show(admins.data.message, {
                type: "success",
            });
            commit('setToken', admins.data.token);
            localStorage.setItem('token', admins.data.token);
            this.$router.push('http://localhost:8000/api/admin/dashboard')
        } else {
            this.$toast.show(admins.data.message, {
                type: "error",
            });
        }
    },

    async getAdmins({ commit }) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const data = await this.$axios.get('http://localhost:8000/api/admin/admins', config);
        commit('setAdmins', data.data[0])
    },

    async adminLogout({ commit }) {
        commit('setAdmins', '')
        commit('setToken', '')
        localStorage.removeItem('token')
        this.$router.push('/admin')
        this.$toast.show('logout Successfully', {
            type: "success",
        });
    },
}
