import axios from 'axios';

export const state = () => ({
    galleries: [],
    allGalleries: [],
    isloading: false,
})

export const getters = {
    getGalleries: (state) => state.galleries,
    getAllGalleries: (state) => state.allGalleries,
}

export const mutations = {
    setGalleries(state, galleries) {
        state.galleries = galleries;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllGalleries(state, allGalleries) {
        state.allGalleries = allGalleries;
    },
}

export const actions = {
    async getAllGalleries({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-galleries");
        commit("setIsLoading", false)
        commit("setAllGalleries", data.data)
    },

    async createGallery({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { res } = await axios.post("http://localhost:8000/api/admin/galleries", data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/gallery')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getGalleries({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/galleries", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setGalleries', data.data)
        }
    },

    async deleteGallery(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/galleries/" + id, config);
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

    async updateGallery({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post("/admin/galleries/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/gallery")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}