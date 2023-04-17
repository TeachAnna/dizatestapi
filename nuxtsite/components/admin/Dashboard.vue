<template>
  <div>
    <v-container>
      <div v-if="isloading">
        <h3 class="text-center my-4">
          <img src="~/static/loading.svg" alt="" />
        </h3>
      </div>
      <div v-else>
        <v-row>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/post">
                <v-card-title>Posts ({{ posts.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-post </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="10">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/category">
                <v-card-title>Categories ({{ categorys.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-widgets </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/tag"
                ><v-card-title>Tags ({{ tags.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-tag-multiple </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/contacts">
                <v-card-title>Contacts ({{ contacts.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-card-account-mail
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/subscriber">
                <v-card-title
                  >Subscribes ({{ subscribes.length }})</v-card-title
                >
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-account-multiple-plus
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/comments">
                <v-card-title>Comments ({{ comments.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-comment-text-multiple
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/menu">
                <v-card-title>Menus ({{ menus.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-menu-open </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/slide">
                <v-card-title>Slides ({{ slides.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-slide </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/gallery">
                <v-card-title>Galleries ({{ galleries.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-view-gallery </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/item">
                <v-card-title>Items ({{ items.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-sitemap </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/tab">
                <v-card-title>Tabs ({{ tabs.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-tab </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/link">
                <v-card-title>Links ({{ links.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-link-box-variant
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/team">
                <v-card-title>Teams ({{ teams.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-microsoft-teams
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/accordion">
                <v-card-title>
                  Accordions ({{ accordions.length }})
                </v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-air-filter </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/video">
                <v-card-title>Videos ({{ videos.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-video-box </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/response">
                <v-card-title>Responses ({{ responses.length }})</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2">
                  mdi-pencil-box-multiple
                </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
          <v-col xl="3" lg="3" md="4" sm="6" xs="12">
            <v-card class="d-flex justify-space-between">
              <nuxt-link to="/admin/setting">
                <v-card-title>Settings</v-card-title>
              </nuxt-link>
              <v-card-actions>
                <v-icon color="blue-grey darken-2"> mdi-cog </v-icon>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </div>
      <!-- <DashboardTableVue /> -->
    </v-container>
  </div>
</template>
<script>
// import DashboardTableVue from "./DashboardTable.vue";
import { mapGetters, mapActions } from "vuex";
export default {
  // components: {
  //   DashboardTableVue,
  // },
  data: () => ({
    isloading: false,
  }),

  computed: {
    ...mapGetters({
      posts: "posts/getPosts",
      categorys: "categorys/getCategorys",
      tags: "tags/getTags",
      tabs: "tabs/getTabs",
      links: "links/getLinks",
      items: "items/getItems",
      slides: "slides/getSlides",
      videos: "videos/getVideos",
      accordions: "accordions/getAccordions",
      responses: "responses/getResponses",
      galleries: "galleries/getGalleries",
      teams: "teams/getTeams",
      menus: "menus/getMenus",
      contacts: "contacts/getContacts",
      subscribes: "subscribes/getSubscribes",
      comments: "comments/getComments",
    }),
  },
  methods: {
    ...mapActions({
      getPosts: "posts/getPosts",
      getCategorys: "categorys/getCategorys",
      getTags: "tags/getTags",
      getTabs: "tabs/getTabs",
      getLinks: "links/getLinks",
      getItems: "items/getItems",
      getSlides: "slides/getSlides",
      getVideos: "videos/getVideos",
      getAccordions: "accordions/getAccordions",
      getResponses: "responses/getResponses",
      getGalleries: "galleries/getGalleries",
      getTeams: "teams/getTeams",
      getMenus: "menus/getMenus",
      getContacts: "contacts/getContacts",
      getSubscribes: "subscribes/getSubscribes",
      getComments: "comments/getComments",
    }),
  },
  async mounted() {
    await this.getPosts();
    await this.getTabs();
    await this.getCategorys();
    await this.getLinks();
    await this.getItems();
    await this.getTags();
    await this.getSlides();
    await this.getVideos();
    await this.getAccordions();
    await this.getResponses();
    await this.getGalleries();
    await this.getTeams();
    await this.getMenus();
    await this.getContacts();
    await this.getComments();
    await this.getSubscribes();
  },
};
</script>
<style>
</style>