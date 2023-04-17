
export const state = () => ({
    subscribes: [],
    isloading: false,
})

export const getters = {
    getSubscribes: (state) => state.subscribes,
}

export const mutations = {
    setSubscribe(state, subscribes) {
        state.subscribes = subscribes;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {
    async addSubscribe(_, data) {
        const res = await this.$axios.post("/front/subscribe", data);
        if (res.data.success) {
            this.$toast.show(res.data.message, {
                type: 'success'
            })
        } else {
            this.$toast.show(res.data.message, {
                type: 'error'
            })
        }
    },

    async getSubscribes({ commit }) {
        commit('setIsLoading', true);
        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        };
        const { data } = await this.$axios.get("/admin/subscribe", config);
        if (data) {
            commit('setIsLoading', false);
            commit('setSubscribe', data.data);
        }
    },
    async deleteSub(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/subscribe/" + id, config);
        if (res) {
            this.$toast.show("Subscribe Delete Successfully", {
                type: 'success'
            });
        } else {
            this.$toast.show("error", {
                type: 'error'
            });
        }
    }
}