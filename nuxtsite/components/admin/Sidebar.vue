<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
    >
      <v-list>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          router
          exact
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar :clipped-left="clipped" fixed app>
      <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
      <v-toolbar class="bar">
        <nuxt-link to="/admin/dashboard" class="d-flex">
          <v-icon color="blue-grey darken-2 " class="mx-1"> mdi-apps </v-icon>
          <v-toolbar-title text yellow v-text="title" />
        </nuxt-link>

        <v-spacer></v-spacer>
        <nuxt-link to="/" class="d-flex">
          <v-icon color="blue-grey darken-2" class="mx-1"> mdi-sitemap </v-icon>
          <v-toolbar-title v-text="front" />
        </nuxt-link>
        <v-spacer></v-spacer>
        <v-icon class="mdi mdi-account-check mr-1"></v-icon>
        <v-toolbar-title v-text="$store.state.admins.name" />
        <v-btn class="link" text @click="logout"
          ><v-icon class="mdi mdi-logout"></v-icon>Logout</v-btn
        >
      </v-toolbar>
    </v-app-bar>
  </div>
</template>
<script>
import { mapActions } from "vuex";
export default {
  data() {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: "mdi-apps",
          title: "Dashboard",
          to: "/admin/dashboard",
        },
        {
          icon: "mdi-widgets",
          title: "Categorys",
          to: "/admin/category",
        },
        {
          icon: "mdi-post",
          title: "Posts",
          to: "/admin/post",
        },
        {
          icon: "mdi-comment-text-multiple",
          title: "Comments",
          to: "/admin/comments",
        },
        {
          icon: "mdi-account-multiple-plus",
          title: "Subscribs",
          to: "/admin/subscriber",
        },
        {
          icon: "mdi-card-account-mail",
          title: "Contacts",
          to: "/admin/contacts",
        },
        {
          icon: "mdi-lock-check",
          title: "Change Password",
          to: "/admin/change-password",
        },
        {
          icon: "mdi-cog",
          title: "Setting",
          to: "/admin/setting",
        },
        {
          icon: "mdi-tag-multiple",
          title: "Tags",
          to: "/admin/tag",
        },
        {
          icon: "mdi-menu-open",
          title: "Menus",
          to: "/admin/menu",
        },
        {
          icon: "mdi-image-multiple",
          title: "Images",
          to: "/admin/image",
        },
        {
          icon: "mdi-slide",
          title: "Slides",
          to: "/admin/slide",
        },
        {
          icon: "mdi-view-gallery",
          title: "Galleries",
          to: "/admin/gallery",
        },
        {
          icon: "mdi-tab",
          title: "Tabs",
          to: "/admin/tab",
        },
        {
          icon: "mdi-sitemap",
          title: "Items",
          to: "/admin/item",
        },
        {
          icon: "mdi-link-box-variant",
          title: "Links",
          to: "/admin/link",
        },
        {
          icon: "mdi-microsoft-teams",
          title: "Teams",
          to: "/admin/team",
        },
        {
          icon: "mdi-video-box",
          title: "Videos",
          to: "/admin/video",
        },
        {
          icon: "mdi-air-filter",
          title: "Accordions",
          to: "/admin/accordion",
        },
        {
          icon: "mdi-pencil-box-multiple",
          title: "Responses",
          to: "/admin/response",
        },
      ],
      miniVariant: false,
      right: true,
      rightDrawer: false,
      title: "Dashboard",
      front: "Diza",
    };
  },

  methods: {
    ...mapActions(["adminLogout"]),
    logout() {
      this.adminLogout();
    },
  },
};
</script>
<style >
.bar a {
  color: yellow !important;
}
</style>