<template>
    <div>
      <div v-if="isloading" class="my-4 text-center">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <TagDetail
          :title="title"
          :posts="posts"
          :id="id"
        />
      </div>
    </div>
  </template>
  <script>
  import TagDetail from "@/components/front/TagDetail.vue";
  export default {
    components: {
      TagDetail,
    },
    data: () => ({
      id: 0,
      title: "",
      posts: [],
      isloading: false,
    }),
    async mounted() {
      this.isloading = true;

      const res = await this.$axios.get(`/front/single-tags/
          ${this.$route.params.tag}`);
      this.isloading = false;
      this.title = res.data.tags.title;
      this.id = res.data.tags.id;
      this.posts = res.data.tags.posts;

    console.log(res)
    },
  };
  </script>
  <style>
  </style>