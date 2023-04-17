export const state = () => ({
    contacts: [],
    isloading: false,
})

export const getters = {
    getContacts: (state) => state.contacts,
}

export const mutations = {
    setContacts(state, contacts) {
        state.contacts = contacts;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
}

export const actions = {
    async addContact({ commit }, data) {
        commit('setIsLoading', true);
        const res = await this.$axios.post('/front/contact', data);
        if (res.data.success) {
            this.$toast.show(res.data.message, {
                type: 'success'
            });
            commit('setIsLoading', false);

        } else {
            this.$toast.show(res.data.message, {
                type: 'error'
            });
            commit('setIsLoading', false);

        }
    },
    async getContacts({ commit }) {
        commit('setIsLoading', true);
        const config = {
            headers: {
                Authorization: 'Bearer ' + localStorage.getItem('token')
            }
        };
        const { data } = await this.$axios.get("/admin/contacts", config);
        if (data) {
            commit('setIsLoading', false);
            commit('setContacts', data.data);
        }
    },
    async deleteContact(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/contacts/" + id, config);
        if (res) {
            this.$toast.show("Contact Delete Successfully", {
                type: 'success'
            });
        } else {
            this.$toast.show('error', {
                type: 'error'
            });
        }
    }
}