<template>
    <div>
      <PageTitle :page-title="this.pageTitle" />
      <AllCategory />
    </div>
  </template>

  <script>
  import AllCategory from "@/components/front/AllCategory.vue";

  export default {

    head() {
      return {
        title: this.pageTitle,
      }
    },
    data() {
      return {
        pageTitle: 'Categorys',

      }
    },
    components: {
      AllCategory,
    },
  };
  </script>
