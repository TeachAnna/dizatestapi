<template>
  <div>
    <div class="bg_fon">
        <nuxt-link to="/" class="bred" exact>Home&nbsp;/&nbsp;</nuxt-link>
        <nuxt-link to="/category" class="bred" exact>Category&nbsp;/&nbsp;</nuxt-link>
        <h1  v-for="(category, index) in AllCategorys"
             :key="index">
          <span class="mt-2" v-if="category.id == cat">
             {{ category.title }}
          </span>
        </h1>
    </div>
    <v-container class="my-10">
      <div v-if="isloading">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <div v-if="posts.length > 0">
          <v-row class="my-5">
            <v-col
              xl="4"
              lg="4"
              md="4"
              sm="6"
              xs="12"
              v-for="(post, index) in posts"
              :key="index"
            >
              <v-card>
                <v-img
                  height="250"
                  :src="`${$store.state.urlSite}/storage/${post.image}`"
                ></v-img>
                <v-card-title>{{ post.title }}  </v-card-title>

                <v-card-text>
                  <p>{{ post.intro }}</p>
                  <nuxt-link :to="`/${post.id}`">
                    <v-btn
                      class="my-4 btn__border"
                      variant="contained"
                      color="primary"
                      text
                      >Read More</v-btn
                    ></nuxt-link
                  >
                </v-card-text>
              </v-card>
            </v-col>
        <v-col xl="4" lg="4" md="4" sm="12">
          <div class="my-10">
            <v-card>
              <v-card-title>
                <h3>Categorys</h3>
              </v-card-title>
              <v-card-text class="navbar" :class="{ active_nav: nav }">
                <nuxt-link
                  v-for="(category, index) in AllCategorys"
                  :key="index"

                  class="nav_link" exact
                  :to="`/category-posts/${category.id}`"
                >
                  <h4 class="mt-2">
                  {{ category.title }}
                  </h4>
                </nuxt-link>

              </v-card-text>
            </v-card>
          </div>
        </v-col>
          </v-row>
        </div>
        <div v-else>
          <h3>Posts not found by this category</h3>
        </div>
      </div>
    </v-container>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  head() {
    return {
      title: this.pageTitle,
    };
  },
  data: () => ({
    posts: [],
    isloading: false,
    pageTitle: '',
  }),

  computed: {
    cat() {
      return this.$route.params.catid
    },
    ...mapGetters({
      AllCategorys: 'categorys/getAllCategorys',
    }),
  },
  methods: {
    ...mapActions({
      getAllCategorys: 'categorys/getAllCategorys',
    }),
  },

  async mounted() {
    this.isloading = true;
    const res = await this.$axios.get(`/front/category-posts/${this.$route.params.catid}`);
    this.isloading = false;
    this.posts = res.data.posts;
    this.getAllCategorys();
  },
};
</script>
<style>


</style>