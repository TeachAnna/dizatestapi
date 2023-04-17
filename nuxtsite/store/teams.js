import axios from 'axios';

export const state = () => ({
    teams: [],
    allTeams: [],
    isloading: false,
})

export const getters = {
    getTeams: (state) => state.teams,
    getAllTeams: (state) => state.allTeams,
}

export const mutations = {
    setTeams(state, teams) {
        state.teams = teams;
    },
    setIsLoading(state, isloading) {
        state.isloading = isloading;
    },
    setAllTeams(state, allTeams) {
        state.allTeams = allTeams;
    },
}


export const actions = {

    async getAllTeams({ commit }) {
        commit("setIsLoading", true)
        const { data } = await this.$axios.get("/front/all-teams");
        commit("setIsLoading", false)
        commit("setAllTeams", data.data)
    },

    async createTeam({ commit, $store }, data) {
        commit('setIsLoading', true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        }
        const { res } = await axios.post(`http://localhost:8000/api/admin/teams`, data, config)
        if (data) {
            this.$toast.show("successfully", {
                type: 'success'
            });
            commit('setIsLoading', false)
            this.$router.push('/admin/team')
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            });
        }
    },

    async getTeams({ commit }) {
        commit("setIsLoading", true)
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const { data } = await this.$axios.get("/admin/teams", config);
        if (data) {
            console.log(data);
            commit('setIsLoading', false)
            commit('setTeams', data.data)
        }
    },

    async deleteTeam(_, id) {
        const config = {
            'headers': {
                'Authorization': 'Bearer ' + localStorage.getItem('token'),
            }
        };
        const res = await this.$axios.delete("/admin/teams/" + id, config);
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

    async updateTeam({ commit }, data) {
        commit('setIsLoading', true)
        const config = {
            headers: {
                "Authorization": "Bearer " + localStorage.getItem('token')
            }
        };

        const res = await this.$axios.post("/admin/teams/update", data, config);
        console.log(res);
        if (res) {
            commit('setIsLoading', false)
            this.$toast.show("successfylly", {
                type: 'success'
            })
            this.$router.push("/admin/team")
        } else {
            commit('setIsLoading', false)
            this.$toast.show("error", {
                type: 'error'
            })
        }
    }
}
