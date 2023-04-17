export const state = () => ({
    menus: [],
    allMenus: [],
    isloading: false,
})

export const getters = {
    getMenus: (state) => state.menus,
    getAllMenus: (state) => state.allMenus,
}

export const mutations = {
    setMenus(state, menus) {
        state.menus = menus;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllMenus(state, allMenus) {
        state.allMenus = allMenus;
    },
}
export const actions = {

    async getAllMenus({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-menus");
        commit("setIsLoading", false)
        commit("setAllMenus", data.data)
    },


    async createMenu({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { res } = await this.$axios.post("/admin/menus", data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/menu')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },
    async getMenus({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/menus", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setMenus', data.data)
        }
    },
    async deleteMenu(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/menus/" + id, config);
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
    async updateMenu({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await this.$axios.post(`/admin/menus/${data.id}`, data, config);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("Menu update successfully", {
                type: 'success'
            });
            // console.log(в)
            this.$router.push("/admin/menu")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}
