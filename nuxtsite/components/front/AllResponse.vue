<template >
    <div>
      <v-container class="my-10">
        <div class="d-flex align-center my-4">
            <h2>Response</h2>

        </div>
        <div class="my-4 text-center" v-if="$store.state.isloading">
          <h1 class="text-center my-3">
            <img src="~/static/loading.svg" alt="" />
          </h1>
        </div>
        <div v-else>
          <v-row class="my-5">
            <v-col
              xl="4"
              lg="4"
              md="4"
              sm="6"
              xs="12"
              v-for="(response, index) in AllResponses"
              :key="index"
            >
              <v-card>
                <v-img v-if="response.image"
                  height="250"
                  :src="`${$store.state.urlSite}/storage/${response.image}`"
                ></v-img>
                  <v-card-title>{{ response.name }}</v-card-title>
                <v-card-text>
                  <div class="mb-3">
                <p>{{ response.intro }}</p>
              </div>

                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </div>
      </v-container>
    </div>
  </template>
  <script>
  import { mapGetters, mapActions } from "vuex";
  export default {
    computed: {
      ...mapGetters({
        AllResponses: 'responses/getAllResponses',
      }),
    },
    methods: {
      ...mapActions({
        getAllResponses: 'responses/getAllResponses',
      }),
    },
    mounted() {
      this.getAllResponses();
    },
  };
  </script>
  <style>
  </style>