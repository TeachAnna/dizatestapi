export const state = () => ({
    reitings: [],
    isloading: false,
})

export const getters = {
    getReitings: (state) => state.reitings,
}

export const mutations = {
    setReitings(state, reitings) {
        state.reitings = reitings;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {

    async addReiting({ commit }, data) {
        commit('setIsLoading', true);
        const res = await this.$axios.post(`/front/reitings/${data.id}`, data);
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

    async getReitings({ commit }, id) {
        console.log(id);
        const res = await this.$axios.get("/front/reitings/" + id);
        if (res.data.success) {
            commit("setReitings", res.data.reitings)
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