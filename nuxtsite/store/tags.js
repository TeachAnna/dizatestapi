import axios from 'axios';

export const state = () => ({
    tags: [],
    isloading: false,
    allTags: [],
})

export const getters = {
    getTags: (state) => state.tags,
    getAllTags: (state) => state.allTags
}

export const mutations = {
    setTags(state, tags) {
        state.tags = tags;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllTags(state, allTags) {
        state.allTags = allTags;
    },
}

export const actions = {

    async getAllTags({ commit }) {
        commit("setIsLoading", true);
        const { data } = await this.$axios.get("/front/all-tags");
        commit("setIsLoading", false);
        commit("setAllTags", data.data)
    },

    async createTag({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { res } = await axios.post(`http://localhost:8000/api/admin/tags`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/tag')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getTags({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/tags", config);
        console.log(data);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setTags', data.data)
        }
    },

    async deleteTag(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await axios.delete("http://localhost:8000/api/admin/tags/" + id, config);

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

    async updateTag({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };

        const res = await this.$axios.post("/admin/tags/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/tag")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }

    }
}