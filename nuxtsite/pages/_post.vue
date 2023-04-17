<template>
  <div>
    <PagePostTitle :page-title="title" />
    <div v-if="isloading" class="my-4 text-center">
      <h1 class="text-center my-3">
        <img src="~/static/loading.svg" alt="" />
      </h1>
    </div>
    <div v-else>
      <PostDetail
        :title="title"
        :category="category"
        :content="content"
        :intro="intro"
        :views="views"
        :image="image"
        :id="id"
        :tags="tags"
        :postid="postid"
        :slug="slug"
        :author="author"
        :meta_description="meta_description"
        :meta_key="meta_key"
        :meta_title="meta_title"
      />
    </div>

  </div>
</template>
<script>
import PostDetail from "@/components/front/PostDetail.vue";
export default {
  head() {
    return {
      title: this.pageTitle,
    };
  },
  components: {
    PostDetail,
  },
  data: () => ({
    pageTitle: '',
    title: '',
    postid: 0,
    id: 0,
    image: "",
    category: "",
    content: "",
    views: '',
    intro: "",
    slug: "",
    author: "",
    meta_description: "",
    meta_key: "",
    meta_title: "",
    tags: [],
    isloading: false,
  }),
  async mounted() {
    this.isloading = true;

    const res = await this.$axios.get(`/front/single-posts/${this.$route.params.post}`);
    this.isloading = false;
    this.title = res.data.posts.title;
    this.postid = res.data.posts.id;
    this.image = res.data.posts.image;
    // this.id = res.data.posts.id;
    this.views = res.data.posts.views;
    this.intro = res.data.posts.intro;
    this.id = res.data.posts.id;
    this.slug = res.data.posts.slug;
    this.author = res.data.posts.author;
    this.meta_key = res.data.posts.meta_key;
    this.meta_title = res.data.posts.meta_title;
    this.meta_description = res.data.posts.meta_description;
    this.content = res.data.posts.content;
    this.category = res.data.posts.category.title;
    this.tags = res.data.posts.tags;
    console.log(res)
    console.log(res.data.posts.tags)
  },

};
</script>
<style>
</style>