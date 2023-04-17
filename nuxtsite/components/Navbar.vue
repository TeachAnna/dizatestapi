<template >
  <div>
    <v-system-bar color="teal lighten-4">
      <div class="ml-12">
        <v-icon>mdi-facebook</v-icon>
        <v-icon>mdi-github</v-icon>
        <v-icon>mdi-instagram</v-icon>
        <v-icon>mdi-twitter</v-icon>
      </div>
      <v-spacer></v-spacer>

      <span class="mr-12">3:13PM</span>
    </v-system-bar>
    <div class="main__nav bg teal lighten-5 elevation-2">
      <v-container>
        <div class="nav">
          <nuxt-link to="/" exact class="nav__logo">{{
            Settings.header_logo
          }}</nuxt-link>
          <v-icon class="show text--red" @click="nav = !nav">{{
            nav ? "X" : "mdi-menu"
          }}</v-icon>
          <div class="navbar" :class="{ active_nav: nav }">
            <nuxt-link to="/blog" class="nav_link" exact>Blog</nuxt-link>
            <v-divider class="ms-2" inset vertical color="teal"></v-divider>
            <nuxt-link to="/categorys" class="nav_link" exact
              >Categorys</nuxt-link
            >
            <v-divider class="ms-2" inset vertical color="teal"></v-divider>
            <nuxt-link to="/tags" class="nav_link" exact>Tags</nuxt-link>
            <v-divider class="ms-2" inset vertical color="teal"></v-divider>
            <nuxt-link to="/about" class="nav_link" exact>About</nuxt-link>
            <v-divider class="ms-2" inset vertical color="teal"></v-divider>
            <nuxt-link to="/contact" class="nav_link" exact>Contact</nuxt-link>
          </div>

          <div v-if="$store.state.token">
            <nuxt-link to="admin/dashboard" class="nav_link" exact>#</nuxt-link>
          </div>
        </div>
      </v-container>
    </div>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    nav: false,
  }),
  computed: {
    ...mapGetters({
      Settings: "settings/getSettings",
    }),
  },
  methods: {
    ...mapActions({
      getSettings: "settings/getSettings",
    }),
  },
  mounted() {
    this.getSettings();
  },
};
</script>
<style >
.show {
  display: none !important;
}

a {
  text-decoration: none !important;
}

/* .nav__logo {
  font-size: 2rem;
} */

.nav_link {
  color: rgb(77, 74, 74) !important;
  margin-left: 10px;
  font-size: 1.2rem;
  padding: 3px 10px;
}

.navbar {
  display: flex;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.nav .nav_link {
  transition: 1s;
}

.nav .nuxt-link-active,
.nav .nav_link:hover {
  border-bottom: 2px solid rgb(147, 194, 209);
  transition: 1s;
}

ul li {
  list-style: none !important;
  margin-top: 10px;
  font-size: 20px;
  color: #fff !important;
}

@media screen and (max-width: 800px) {
  .show {
    display: block !important;
    transition: all 0.4s;
  }

  .main__nav {
    position: relative;
  }

  .navbar {
    position: absolute;
    left: 0 !important;
    top: 100% !important;
    width: 100% !important;
    /* text-align: center !important; */
    display: none !important;
    z-index: 9999;
  }

  .navbar a {
    display: block !important;
  }

  .active_nav {
    display: block !important;
  }

  .navbar a {
    margin: 20px 0px !important;
  }
}
</style>