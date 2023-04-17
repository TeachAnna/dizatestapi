import axios from 'axios';

export const state = () => ({
    posts: [],
    isloading: false,
    popularPosts: [],
    latestPosts: [],
    allPosts: [],
})

export const getters = {
    getPosts: (state) => state.posts,
    getLatestPosts: (state) => state.latestPosts,
    getPopularPosts: (state) => state.popularPosts,
    getAllPosts: (state) => state.allPosts,
}

export const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setPopularPost(state, popularPosts) {
        state.popularPosts = popularPosts;
    },
    setLatestPost(state, latestPosts) {
        state.latestPosts = latestPosts;
    },
    setAllPosts(state, allPosts) {
        state.allPosts = allPosts;
    },
}

export const actions = {

    async getPopularPosts({ commit }) {
        commit("setIsLoading", true);
        const { data } = await this.$axios.get("/front/popular-posts");
        commit("setPopularPost", data.data)
        commit("setIsLoading", false);
    },
    async getLatestPosts({ commit }) {
        commit("setIsLoading", true);
        const { data } = await this.$axios.get(`/front/latest-posts`);
        commit("setIsLoading", false);
        commit("setLatestPost", data.data)
    },
    async getAllPosts({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-posts");
        commit("setIsLoading", false)
        commit("setAllPosts", data.data)
    },

    async createPost({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
                'Content-Type': 'multipart/form-data',
            }
        }
        const res = await this.$axios.post(`http://localhost:8000/api/admin/posts`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/post')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getPosts({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/posts", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setPosts', data.data)
        }
    },

    async deletePost(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/posts/" + id, config);
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

    async updatePost({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await this.$axios.post("http://localhost:8000/api/admin/posts/update", data, config);

        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/post")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }

    }
}