export const state = () => ({
    likes: [],
    isloading: false,
})

export const getters = {
    getLikes: (state) => state.likes,
}

export const mutations = {
    setLikes(state, likes) {
        state.likes = likes;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {

    async addLike({ commit }, data) {
        commit('setIsLoading', true);
        const res = await this.$axios.post(`/front/likes/${data.id}`, data);
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

    async getLikes({ commit }, id) {
        console.log(id);
        const res = await this.$axios.get("/front/likes/" + id);
        if (res.data.success) {
            commit("setLikes", res.data.likes)
        }
    },


    // async deleteLike(_, id) {
    //     const config = {
    //         'headers': {
    //             'Authorization': 'Bearer ' + localStorage.getItem('token'),
    //         }
    //     };
    //     const res = await this.$axios.delete("/admin/likes/" + id, config);
    //     if (res) {
    //         this.$toast.show("Like Delete Successfully", {
    //             type: 'success'
    //         });
    //     } else {
    //         this.$toast.show("error", {
    //             type: 'error'
    //         });
    //     }
    // }
}