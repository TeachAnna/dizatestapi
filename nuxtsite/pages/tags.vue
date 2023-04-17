<template>
    <div>
      <PageTitle :page-title="this.pageTitle" />
      <AllTag />
    </div>
  </template>

  <script>
  import AllTag from "@/components/front/AllTag.vue";

  export default {

    head() {
      return {
        title: this.pageTitle,
      }
    },
    components: {
      AllTag,
    },
    data() {
      return {
        pageTitle: 'Tags',

      }
    },

  };
  </script>
