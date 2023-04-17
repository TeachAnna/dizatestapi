import axios from 'axios';

export const state = () => ({
    items: [],
    allItems: [],
    isloading: false,
})

export const getters = {
    getItems: (state) => state.items,
    getAllItems: (state) => state.allItems,
}

export const mutations = {
    setItems(state, items) {
        state.items = items;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllItems(state, allItems) {
        state.allItems = allItems;
    },
}
export const actions = {
    async getAllItems({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-items");
        commit("setIsLoading", false)
        commit("setAllItems", data.data)
    },

    async createItem({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const res = await axios.post("http://localhost:8000/api/admin/items", data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/item')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getItems({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/items", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setItems', data.data)
        }
    },

    async deleteItem(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/items/" + id, config);
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

    async updateItem({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };
        const res = await axios.post("http://localhost:8000/api/admin/items/update", data, config);

        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/item")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}
