<template>
  <v-app>
    <v-main class="link">
      <SidebarVue />
      <Nuxt />
    </v-main>
    <v-footer class="bg-grey lighten-4 d-flex justify-center mt-15 elevation-5">
      <h5>Title Site - 2023</h5>
    </v-footer>
  </v-app>
</template>
  <script>
import SidebarVue from "@/components/admin/Sidebar.vue";
export default {
  components: {
    SidebarVue,
  },
};
</script>
<style>
.link a,
.link {
  color: rgb(232, 232, 99) !important;
}
</style>
