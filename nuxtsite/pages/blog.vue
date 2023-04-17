<template>
  <div>
    <PageTitle :page-title="this.pageTitle" />
    <AllPost />
  </div>
</template>

<script>
import AllPost from "@/components/front/AllPost.vue";

export default {

  head() {
    return {
      title: this.pageTitle,
    }
  },
  components: {
    AllPost,
  },
  data() {
    return {
      pageTitle: 'Blogs',
    }
  },

};
</script>
