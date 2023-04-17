<template >
  <div>
    <v-container class="my-10">
      <h1>Popular Post</h1>
      <div v-if="$store.state.isloading">
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
            v-for="(post, index) in PopularPosts"
            :key="index"
          >
            <v-card variant="outlined">
              <v-img
                v-if="post.image"
                height="250"
                :src="`${$store.state.urlSite}/storage/${post.image}`"
              ></v-img>
              <v-card-title>{{ post.title }}</v-card-title>
              <v-card-text>
                <p>{{ post.intro }}....</p>
                <!-- <h3>category - {{ post.category.title }}</h3> -->
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
      PopularPosts: "posts/getPopularPosts",
    }),
  },
  methods: {
    ...mapActions({
      getPopularPosts: "posts/getPopularPosts",
    }),
  },
  mounted() {
    this.getPopularPosts();
  },
};
</script>
<style>
</style>