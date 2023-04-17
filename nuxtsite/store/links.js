import axios from 'axios';

export const state = () => ({
    links: [],
    allLinks: [],
    isloading: false,
})

export const getters = {
    getLinks: (state) => state.links,
    getAllLinks: (state) => state.allLinks,
}

export const mutations = {
    setLinks(state, links) {
        state.links = links;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllLinks(state, allLinks) {
        state.allLinks = allLinks;
    },
}

export const actions = {
    async getAllLinks({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-links");
        commit("setIsLoading", false)
        commit("setAllLinks", data.data)
    },

    async createLink({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'multipart/form-data',
            }
        }
        const res = await this.$axios.post(`http://localhost:8000/api/admin/links`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/link')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },
    async getLinks({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get(`/admin/links`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setLinks', data.data)
        }
    },

    async deleteLink(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete(`/admin/links/` + id, config);
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

    async updateLink({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post(`http://localhost:8000/api/admin/links/update`, data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/link")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}