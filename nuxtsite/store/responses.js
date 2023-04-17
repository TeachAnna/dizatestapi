import axios from 'axios';

export const state = () => ({
    responses: [],
    allResponses: [],
    isloading: false,
})

export const getters = {
    getResponses: (state) => state.responses,
    getAllResponses: (state) => state.allResponses,
}

export const mutations = {
    setResponses(state, responses) {
        state.responses = responses;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllResponses(state, allResponses) {
        state.allResponses = allResponses;
    },
}

export const actions = {

    async getAllResponses({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-responses");
        commit("setIsLoading", false)
        commit("setAllResponses", data.data)
    },

    async createResponse({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await axios.post(`http://localhost:8000/api/admin/responses`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/response')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getResponses({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get(`/admin/responses`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setResponses', data.data)
        }
    },

    async deleteResponse(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await axios.delete("http://localhost:8000/api/admin/responses/" + id, config);
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

    async updateResponse({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await axios.post(`http://localhost:8000/api/admin/responses/update`, data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            console.log(res)
            this.$router.push("/admin/response")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}