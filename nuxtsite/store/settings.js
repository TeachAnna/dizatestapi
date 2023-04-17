export const state = () => ({
    settings: [],
    isloading: false,
})

export const getters = {
    getSettings: (state) => state.settings
}

export const mutations = {
    setSettings(state, settings) {
        state.settings = settings;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {
    async getSettings({ commit }) {
        const res = await this.$axios.get("/front/setting");
        if (res) {
            commit('setSettings', res.data.settings)
        }

    }
}