<template>
  <div>
    <v-container>
      <v-card class="pa-3 mt-15 elevation-5">
        <v-card-text class="d-flex justify-space-between align-center">
          <v-card-title> Posts ( {{ posts.length }} ) </v-card-title>

          <v-card-actions>
            <nuxt-link to="/admin/posts/create-post">
              <v-btn color="yellow lighten-2" text outlined>
                <v-icon class="mdi mdi-plus-circle mx-1"></v-icon>
                New
              </v-btn>
            </nuxt-link>
          </v-card-actions>
        </v-card-text>

        <v-sheet class="d-flex align-center">
          <v-text-field
            label="Enter count posts on page"
            class="ma-3"
            hide-details="auto"
            outlined
            color="green lighten-1"
            v-model="num_per_page"
            type="number"
          >
          </v-text-field>

          <v-switch
            v-model="selectSort"
            :label="`sort`"
            value="title"
            color="green lighten-1"
          ></v-switch>

          <v-text-field
            label="Search Here ..."
            class="ma-3"
            hide-details="auto"
            outlined
            color="green lighten-1"
            v-model="searchQuery"
            append-icon="mdi mdi-magnify"
          >
          </v-text-field>
        </v-sheet>

        <v-card-subtitle>
          <div v-if="$store.state.isloading">
            <h1 class="text-center my-3">
              <img src="~/static/loading.svg" alt="" />
            </h1>
          </div>

          <div v-else>
            <v-simple-table>
              <template v-slot:default>
                <thead class="bg blue-grey darken-3">
                  <tr>
                    <th class="text-enter">Id</th>
                    <th class="text-enter">Title</th>
                    <th class="text-enter">Category</th>
                    <th class="text-enter">image</th>
                    <th class="text-enter">Views</th>
                    <th class="text-enter">Tags</th>
                    <th class="text-enter">Status</th>
                    <th class="text-enter">Edit</th>
                    <th class="text-enter">Delete</th>
                  </tr>
                </thead>
                <!-- <tbody> -->
                <TransitionGroup tag="tbody">
                  <tr v-for="(post, index) in searchPosts" :key="index">
                    <td class="">{{ index + 1 }}</td>
                    <td class="">{{ post.title }}</td>
                    <td class="">
                      <p v-if="post.category">
                        {{ post.category.title }}
                      </p>
                      <p v-else>
                        {{ post.category_id }}
                      </p>
                    </td>
                    <td class="">
                      <v-img
                        :src="`${$store.state.urlSite}/storage/${post.image}`"
                        width="70"
                        cover
                      ></v-img>
                    </td>
                    <td class="">
                      <p>{{ post.views }}</p>
                    </td>
                    <td class="">
                      <span v-for="tag in post.tags" :key="tag.id">
                        <div>{{ tag.title }}</div>
                      </span>
                    </td>
                    <td class="">
                      <div v-if="post.status == 'true'">
                        <v-icon color="green darken-3"> mdi-check</v-icon>
                      </div>
                      <div v-else>
                        <v-icon color="red darken-3"> mdi-check</v-icon>
                      </div>
                    </td>
                    <td class="">
                      <nuxt-link :to="`/admin/posts/update-post/${post.id}`">
                        <v-btn text class="ma-2" color="blue">
                          <v-icon color="yellow lighten-1"> mdi-pencil</v-icon>
                        </v-btn>
                      </nuxt-link>
                    </td>
                    <td class="">
                      <v-btn
                        @click="delPost(post.id)"
                        text
                        class="ma-2"
                        color="blue"
                      >
                        <v-icon color="yellow lighten-1"> mdi-delete</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </TransitionGroup>
                <!-- </tbody> -->
              </template>
            </v-simple-table>
          </div>
        </v-card-subtitle>

        <v-card-actions class="justify-center pt-3 mb-5">
          <div class="pagination">
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 1 >= 0"
              v-on:click="set_page(-1)"
              >&laquo;</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 2 >= 0"
              v-on:click="set_page(-2)"
              >{{ page - 1 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 1 >= 0"
              v-on:click="set_page(-1)"
              >{{ page }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              class="active"
              v-if="posts.length >= num_per_page"
              >{{ page + 1 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 1) < this.posts.length"
              v-on:click="set_page(+1)"
              >{{ page + 2 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 2) < this.posts.length"
              v-on:click="set_page(+2)"
              >{{ page + 3 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 1) < this.posts.length"
              v-on:click="set_page(+1)"
              >&raquo;</v-btn
            >
          </div>
        </v-card-actions>
      </v-card>

      <!-- <v-pagination
        v-model="page"
        :length="posts.length / num_per_page"
        prev-icon="mdi-menu-left"
        next-icon="mdi-menu-right"
        show-first-last-page="true"
        :start="start"
      ></v-pagination> -->
    </v-container>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  layout: "admin",
  middleware: ["auth"],
  data: () => ({
    // totalPost: 0,
    page: 0,
    start: 0,
    // page: -1,
    num_per_page: 4,

    searchQuery: "",
  }),
  computed: {
    ...mapGetters({
      posts: "posts/getPosts",
    }),
    new_page_items: function () {
      return this.posts.slice(
        this.num_per_page * this.page,
        this.num_per_page * (this.page + 1)
      );
    },
    sortedPosts() {
      return [...this.new_page_items].sort((a, b) =>
        a[this.selectSort]?.localeCompare(b[this.selectSort])
      );
    },
    searchPosts() {
      return this.sortedPosts.filter((elem) =>
        elem.title.toLowerCase().includes(this.searchQuery.toLowerCase())
      );
    },
  },
  methods: {
    set_page: function (num) {
      this.page = this.page + num;
    },
    ...mapActions({
      getCategorys: "categorys/getCategorys",
      getPosts: "posts/getPosts",
      deletePost: "posts/deletePost",
    }),
    delPost(id) {
      this.deletePost(id);
      this.getPosts();
    },
    ...mapActions(["getAdmins"]),
  },
  async mounted() {
    await this.getAdmins();
    await this.getPosts();
    await this.getCategorys();
  },
};
</script>
<style>
tr:hover {
  background: rgba(96, 96, 65, 0.244) !important;
}
</style>