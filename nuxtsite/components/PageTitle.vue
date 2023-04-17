<template>
  <div>
    <v-sheet
      height="20vh"
      class="bg teal lighten-4 d-flex justify-center align-center"
    >
      <nuxt-link to="/" class="bred" exact>Home&nbsp;</nuxt-link>
      <h1>/ {{ pageTitle }}</h1>
      <v-breadcrumbs
        bg-color="primary"
        :items="['Foo', 'Bar', 'Fizz']"
      ></v-breadcrumbs>
    </v-sheet>
  </div>
</template>

  <script>
export default {
  props: {
    pageTitle: {
      type: String,
      required: true,
    },
  },
  data: () => ({
    // items: [
    //   {
    //     title: "Dashboard",
    //     disabled: false,
    //     href: "breadcrumbs_dashboard",
    //   },
    //   {
    //     title: "Link 1",
    //     disabled: false,
    //     href: "breadcrumbs_link_1",
    //   },
    //   {
    //     title: "Link 2",
    //     disabled: true,
    //     href: "breadcrumbs_link_2",
    //   },
    // ],
  }),
};
</script>

  <style>
.bred {
  font-size: 30px;
  color: white !important;
  text-shadow: 1px 1px 1px rgb(44, 43, 43);
}
</style>