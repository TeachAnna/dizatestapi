
export const state = () => ({
    categorys: [],
    isloading: false,
    getCategorys: [],
    allCategorys: [],
})

export const getters = {
    getCategorys: (state) => state.categorys,
    getAllCategorys: (state) => state.allCategorys
}

export const mutations = {
    setCategorys(state, categorys) {
        state.categorys = categorys;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    // setgetCategory(state, getCategorys) {
    //     state.getCategorys = getCategorys;
    // },
    setAllCategorys(state, allCategorys) {
        state.allCategorys = allCategorys;
    },
}

export const actions = {

    async getAllCategorys({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-categorys");
        commit("setIsLoading", false)
        commit("setAllCategorys", data.data)

    },
    async createCategory({ commit }, data) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { res } = await this.$axios.post('/admin/categorys', data, config);
        if (data) {
            this.$toast.show("category add successfully", {
                type: "success",
            });
            commit("setIsLoading", false)
            this.$router.push('/admin/category')

        } else {
            this.$toast.show("error", {
                type: "error",
            });
            commit("setIsLoading", false)
        }
    },
    async getCategorys({ commit }) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { data } = await this.$axios.get(`/admin/categorys`, config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setCategorys', data.data)
        }
    },

    async deleteCategory(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await this.$axios.delete(`/admin/categorys/${id}`, config);
        if (res) {
            this.$toast.show("Category Delete Successfully", {
                type: 'success'
            })
        } else {
            this.$toast.show("error", {
                type: 'error'
            })
        }
    },

    async updateCategory({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await this.$axios.post(`/admin/categorys/${data.id}`, data, config);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("Category update successfully", {
                type: 'success'
            });
            this.$router.push("/admin/category")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}