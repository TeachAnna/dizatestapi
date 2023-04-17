import axios from 'axios';

export const state = () => ({
    videos: [],
    allVideos: [],
    isloading: false,
})

export const getters = {
    getVideos: (state) => state.videos,
    getAllVideos: (state) => state.allVideos,
}

export const mutations = {
    setVideos(state, videos) {
        state.videos = videos;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllVideos(state, allVideos) {
        state.allVideos = allVideos;
    },
}

export const actions = {

    async getAllVideos({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-videos");
        commit("setIsLoading", false)
        commit("setAllVideos", data.data)
    },

    async createVideo({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await this.$axios.post(`/admin/videos`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/video')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getVideos({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get(`/admin/videos`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setVideos', data.data)
        }
    },

    async deleteVideo(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await axios.delete("http://localhost:8000/api/admin/videos/" + id, config);
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

    async updateVideo({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post("/admin/videos/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            console.log(res)
            this.$router.push("/admin/video")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}