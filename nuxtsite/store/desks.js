export const state = () => ({
    desks: [],
    // post: {},
});

export const getters = {
    getDesks: (state) => state.desks,

    // getPost: (state) => {
    //     return { ...state.post }
    // }
};

export const mutations = {
    setDesks(state, desks) {
        state.desks = desks
    },
    // setPost(state, post) {
    //     state.post = post
    // },
};

export const actions = {
    async fetchDesks({ commit }) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { data } = await this.$axios.$get(`http://localhost:8000/api/admin/desks`, config);
        commit('setDesks', data)
    },

    // async deleteDesk({ dispatch }, params) {
    //     await this.$axios.$delete(`http://localhost:8000/api/admin/desks/${params.id}`);
    //     dispatch('fetchDesks')
    // },
};
