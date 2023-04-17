import axios from 'axios';

export const state = () => ({
    slides: [],
    allSlides: [],
    isloading: false,
    urlSite: 'http://localhost:8000',
})

export const getters = {
    getSlides: (state) => state.slides,
    getAllSlides: (state) => state.allSlides,
}

export const mutations = {
    setSlides(state, slides) {
        state.slides = slides;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllSlides(state, allSlides) {
        state.allSlides = allSlides;
    },
}

export const actions = {

    async getAllSlides({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-slides");
        commit("setIsLoading", false)
        commit("setAllSlides", data.data)
    },

    async createSlide({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await axios.post(`http://localhost:8000/api/admin/slides`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/slide')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getSlides({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/slides", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setSlides', data.data)
        }
    },

    async deleteSlide(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/slides/" + id, config);
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

    async updateSlide({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post("http://localhost:8000/api/admin/slides/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/slide")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}