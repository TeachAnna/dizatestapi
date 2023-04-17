<template>
    <div>
      <div v-if="isloading" class="my-4 text-center">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <CategoryDetail
          :title="title"
          :parent_id="parent_id"
          :posts="posts"
          :id="id"
        />
      </div>
    </div>
  </template>
  <script>
  import CategoryDetail from "@/components/front/CategoryDetail.vue";
  export default {
    components: {
      CategoryDetail,
    },
    data: () => ({
      id: 0,
      title: "",
      parent_id: "",
      posts: [],
      isloading: false,
    }),
    async mounted() {
      this.isloading = true;

      const res = await this.$axios.get(`/front/single-categorys/
          ${this.$route.params.category}`);
      this.isloading = false;
      this.title = res.data.categorys.title;
      this.id = res.data.categorys.id;
      this.parent_id = res.data.categorys.parent_id;
      this.posts = res.data.categorys.posts;

    console.log(res)
    },
  };
  </script>
  <style>
  </style>