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
                    <div>
                    </div>
                  </div>
                </v-col>
            </div>
          </v-col>
          <v-col xl="4" lg="4" md="4" sm="12">
          <div class="my-10">
            <v-card>
              <v-card-title>
                <h3>Categorys</h3>
              </v-card-title>
              <v-card-text class="navbar" :class="{ active_nav: nav }">
                <nuxt-link
                  v-for="(category, index) in Categorys"
                  :key="index"
                  class="nav_link" exact
                  :to="`/category-posts/${category.id}`"
                >
                  <h4 class="mt-2">
                    {{ category.title }}
                  </h4></nuxt-link
                >
              </v-card-text>

            </v-card>
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
      Categorys: 'categorys/getCategorys',
      // Posts: 'posts/getPosts',
    }),
  },
    methods: {
      ...mapActions({
      getCategorys: 'categorys/getCategorys',
      // getPosts: 'posts/getPosts',
    }),
    },
    mounted() {
      this.getCategorys();
      // this.getPosts();
    },
  };
  </script>
  <style>

  </style>