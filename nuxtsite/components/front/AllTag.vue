<template >
    <div>
      <v-container class="my-10">
        <div class="d-flex align-center my-4">
          <v-text-field
            label="Search Here ..."
            class="form__control"
            hide-details="auto"
            outlined
          >
          </v-text-field>
          <v-btn color="success" text>Search</v-btn>
        </div>
        <h1>All Tags</h1>
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
              v-for="(tag, index) in AllTags"
              :key="index"
            >
              <v-card>
                <v-img v-if="tag.image"
                  height="250"
                  :src="`${$store.state.urlSite}/storage/${tag.image}`"
                ></v-img>

                  <v-card-title>{{ tag.title }}</v-card-title>

                  <nuxt-link :to="{ path: '/tag/' + tag.id }"
                  ><v-card-title>{{ tag.title }}</v-card-title>
                </nuxt-link>

                  <div class="mb-3">
                <p>{{ tag.intro }}</p>
              </div>
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
    data: () => ({
      searchQuery: '',
    }),
    computed: {
      ...mapGetters({
        AllTags: 'tags/getAllTags',
      }),
    },
    methods: {
      ...mapActions({
        getAllTags: 'tags/getAllTags',
      }),
    },
    mounted() {
      this.getAllTags();
    },
  };
  </script>
  <style>
  </style>