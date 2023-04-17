import axios from 'axios';

export const state = () => ({
    tabs: [],
    allTabs: [],
    isloading: false,
})

export const getters = {
    getTabs: (state) => state.tabs,
    getAllTabs: (state) => state.allTabs,
}

export const mutations = {
    setTabs(state, tabs) {
        state.tabs = tabs;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllTabs(state, allTabs) {
        state.allTabs = allTabs;
    },
}

export const actions = {

    async getAllTabs({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-tabs");
        commit("setIsLoading", false)
        commit("setAllTabs", data.data)
    },

    async createTab({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await this.$axios.post(`/admin/tabs`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/tab')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getTabs({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get(`/admin/tabs`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setTabs', data.data)
        }
    },

    async deleteTab(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await axios.delete("http://localhost:8000/api/admin/tabs/" + id, config);
        if (res) {
            this.$toast.show("successfully", {
                type: 'success'
            });
        } else {
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async updateTab({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post("/admin/tabs/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            console.log(res)
            this.$router.push("/admin/tab")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}