<template >
    <div>
      <v-container>
        <v-row>
          <v-col xl="8" lg="8" md="8" sm="12">
            <div class="my-10">

              <div class="my-2">
                <h2>{{ title }}</h2>
              </div>
                <v-col xl="4" lg="4" md="4" sm="12">
                  <div class="my-10">
                    <v-card v-if="posts.length > 0">
                      <v-card-title>
                        <h3>#Posts</h3>
                      </v-card-title>
                      <v-card-text>
                        <div v-for="(post, index) in posts"
                          :key="index">
                          <h5>{{ post.title }}</h5>
                          <h5>{{ post.id }}</h5>
                        </div>
                      </v-card-text>

                    </v-card>
                    <div v-else>
          <h3>Posts not found by this category</h3>
        </div>
                  </div>
                </v-col>
            </div>
          </v-col>

        </v-row>

      </v-container>
    </div>
  </template>
  <script>
  import { mapGetters, mapActions } from "vuex";
  export default {
    props: {
      id: Number,
      title: String,
      posts: Array,
    },
    computed: {
    ...mapGetters({
      Tags: 'tags/getTags',

    }),
  },
    methods: {
      ...mapActions({
      getTags: 'tags/getTags',

    }),
    },
    mounted() {
      this.getTags();

    },
  };
  </script>
  <style>

  </style>