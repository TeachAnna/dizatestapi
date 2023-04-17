<template >
  <div>
    <v-container class="my-10">
      <div class="d-flex align-center my-4">
        <v-text-field
          label="Search Here ..."
          class="form__control"
          hide-details="auto"
          outlined
          v-model="searchQuery"
        >
        </v-text-field>
        <v-btn color="success" text>Search</v-btn>
      </div>
      <div class="my-4 text-center" v-if="$store.state.isloading">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <v-row class="my-5">
          <!-- <TransitionGroup name="list"> -->
          <v-col
          xl="4"
          lg="4"
          md="4"
          sm="6"
          xs="12"
          v-for="(post, index) in searchPosts"
          :key="index"
          >

            <v-card>
              <v-img v-if="post.image"
              v-lazyload
                :src="`${$store.state.urlSite}/storage/${post.image}`"
              ></v-img>
              <nuxt-link :to="{ path: '/' + post.id }"
                ><v-card-title>{{ post.title }}</v-card-title>

              </nuxt-link>

              <h3 v-if="post.category">category - {{ post.category.title }}</h3>
              <v-card-text>
                <div class="mb-3">
              <p>{{ post.intro }}</p>
            </div>
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
          <!-- </TransitionGroup> -->
          </v-col>
        </v-row>
      </div>
      <div v-if="searchPosts.length == 0">
        no resalt
      </div>

      <button @click="show = !show">Toggle</button>
<Transition name="list">
  <p v-if="show">hello</p>
</Transition>
    </v-container>
  </div>
</template>
<script>
// import lazyload from "@/directives/lazyload";
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    // page: 1,
    // title: "",
    show: '',
    searchQuery: '',
  }),
  computed: {
    ...mapGetters({
      AllPosts: 'posts/getAllPosts',
      // Categorys: 'categorys/getCategorys',

    }),
    // directives: {
    //   lazyload
    // },
  searchPosts() {
    return this.AllPosts.filter(elem =>elem.title.toLowerCase().includes(this.searchQuery.toLowerCase()))
  },
  },
  methods: {
    ...mapActions({
      getAllPosts: 'posts/getAllPosts',
      // getCategorys: 'categorys/getCategorys',
    }),
  },
  mounted() {
    this.getAllPosts();
    // this.getCategorys();
  },
};
</script>
<style>
.list-enter-active,
.list-leave-active {
  transition: all 0.5s ease;
}
.list-enter-from,
.list-leave-to {
  opacity: 0;
  transform: translateX(30px);
}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s ease;
}

.v-enter-from,
.v-leave-to {
  opacity: 0;
}
</style>