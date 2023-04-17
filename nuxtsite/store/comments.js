export const state = () => ({
    comments: [],
    adminComments: [],
    isloading: false,
})

export const getters = {
    getAdminComments: (state) => state.adminComments,
    getComments: (state) => state.comments,
}

export const mutations = {
    setComments(state, comments) {
        state.comments = comments;
    },
    setAdminComments(state, adminComments) {
        state.adminComments = adminComments;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {

    async addComment({ commit }, data) {
        commit('setIsLoading', true);
        const res = await this.$axios.post(`/front/comments/${data.id}`, data);
        if (res.data.success) {
            commit('setIsLoading', false);
            this.$toast.show(res.data.message, {
                type: 'success'
            });
            this.$router.push(`/${data.id}`)

        } else {
            commit('setIsLoading', false);
            this.$toast.show(res.data.message, {
                type: 'error'
            });
        }

    },

    async getComments({ commit }, id) {
        console.log(id);
        const res = await this.$axios.get("/front/comments/" + id);
        if (res.data.success) {
            commit("setComments", res.data.comments)
        }
    },

    async getAdminsComments({ commit }) {
        commit('setIsLoading', true);
        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        };
        const { data } = await this.$axios.get("/admin/comments", config);
        if (data) {
            commit('setIsLoading', false);
            commit('setAdminComments', data.data);
        }
    },

    async deleteComment(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/comments/" + id, config);
        if (res) {
            this.$toast.show("Comment Delete Successfully", {
                type: 'success'
            });
        } else {
            this.$toast.show("error", {
                type: 'error'
            });
        }
    }
}