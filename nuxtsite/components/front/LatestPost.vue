<template >
  <div>
    <v-container class="my-10">
      <h1>Latest Post</h1>
      <div v-if="$store.state.isloading"></div>
      <div v-else>
        <v-row class="my-5">
          <v-col
            xl="4"
            lg="4"
            md="4"
            sm="6"
            xs="12"
            v-for="(post, index) in LatestPosts"
            :key="index"
          >
            <v-card>
              <v-img v-if="post.image"
                height="250"
                :src="`${$store.state.urlSite}/storage/${post.image}`"
              ></v-img>
              <v-card-title>{{ post.title }}</v-card-title>
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
        </v-row>
      </div>
    </v-container>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({}),
  computed: {
    ...mapGetters({
      LatestPosts: 'posts/getLatestPosts',
    }),
  },
  methods: {
    ...mapActions({
      getLatestPosts: 'posts/getLatestPosts',
    }),
  },
  mounted() {
    this.getLatestPosts();
  },
};
</script>
<style>
</style>