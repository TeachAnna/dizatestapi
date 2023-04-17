import axios from 'axios';

export const state = () => ({
    accordions: [],
    allAccordions: [],
    isloading: false,
})

export const getters = {
    getAccordions: (state) => state.accordions,
    getAllAccordions: (state) => state.allAccordions,
}

export const mutations = {
    setAccordions(state, accordions) {
        state.accordions = accordions;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllAccordions(state, allAccordions) {
        state.allAccordions = allAccordions;
    },
}

export const actions = {

    async getAllAccordions({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-accordions");
        commit("setIsLoading", false)
        commit("setAllAccordions", data.data)
    },

    async createAccordion({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await axios.post(`http://localhost:8000/api/admin/accordions`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/accordion')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getAccordions({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get(`/admin/accordions`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setAccordions', data.data)
        }
    },

    async deleteAccordion(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await axios.delete("http://localhost:8000/api/admin/accordions/" + id, config);
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

    async updateAccordion({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await axios.post("http://localhost:8000/api/admin/accordions/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            console.log(res)
            this.$router.push("/admin/accordion")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}