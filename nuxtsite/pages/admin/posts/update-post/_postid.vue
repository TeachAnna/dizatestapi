<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/post">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>
          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7">
              Update Post</v-card-title
            >
            <v-card-subtitle class="pb-10">
              <form class="form" @submit.prevent="update">
                <v-text-field
                  label="Enter Titile"
                  class="ma-2"
                  hide-details="auto"
                  outlined
                  v-model="title"
                  color="green lighten-1"
                >
                </v-text-field>

                <v-select
                  v-model="category_id"
                  :items="Categorys"
                  item-value="id"
                  item-text="title"
                  :label="category"
                  class="ma-2"
                  color="green lighten-1"
                ></v-select>

                <v-autocomplete
                  v-model="tags"
                  :items="Tags"
                  item-value="id"
                  item-text="title"
                  label="Tags"
                  multiple
                  class="ma-2"
                  color="green lighten-1"
                ></v-autocomplete>

                <v-file-input
                  class="ma-2"
                  accept="image/*"
                  label="File input"
                  outlined
                  @change="onChangeFile"
                  color="green lighten-1"
                ></v-file-input>

                <img
                  :src="`${$store.state.urlSite}/storage/${old_image}`"
                  alt=""
                  width="150"
                  cover
                />

                <input type="hidden" v-model="old_image" />
                <v-textarea
                  class="ma-2"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>

                <vue-editor
                  id="editor"
                  class="ma-2"
                  :placeholder="content"
                  useCustomImageHandler
                  v-model="content"
                  @image-added="handleImageAdded"
                ></vue-editor>
                <br />

                <v-text-field
                  class="ma-2"
                  label="Enter author"
                  outlined
                  hide-details="auto"
                  v-model="author"
                  color="green lighten-1"
                ></v-text-field>

                <v-text-field
                  class="ma-2"
                  label="Enter slug"
                  hide-details="auto"
                  outlined
                  v-model="slug"
                  color="green lighten-1"
                ></v-text-field>

                <v-text-field
                  class="ma-2"
                  label="Enter meta_title"
                  outlined
                  hide-details="auto"
                  v-model="meta_title"
                  color="green lighten-1"
                ></v-text-field>

                <v-text-field
                  class="ma-2"
                  label="Enter meta_key"
                  outlined
                  hide-details="auto"
                  v-model="meta_key"
                  color="green lighten-1"
                ></v-text-field>

                <v-text-field
                  label="Enter meta_description"
                  outlined
                  hide-details="auto"
                  v-model="meta_description"
                  class="ma-2"
                  color="green lighten-1"
                ></v-text-field>

                <v-switch
                  class="ma-2"
                  v-model="status"
                  :label="`published`"
                  color="green lighten-1"
                ></v-switch>

                <v-btn
                  type="submit"
                  color="yellow lighten-2"
                  text
                  outlined
                  class="float-right me-2"
                >
                  <v-icon class="mdi mdi-content-save-check m-1"></v-icon>
                  {{ $store.state.isloading ? "Updating..." : "Update" }}</v-btn
                >
              </form>
            </v-card-subtitle>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  layout: "admin",
  data: () => ({
    title: "",
    content: "",
    status: "",
    intro: "",
    category_id: "",
    category: "",
    old_image: "",
    new_image: "",
    slug: "",
    author: "",
    meta_title: "",
    meta_description: "",
    meta_key: "",
    tags: "",
  }),
  computed: {
    ...mapGetters({
      Tags: "tags/getTags",
      Categorys: "categorys/getCategorys",
    }),
  },
  methods: {
    ...mapActions({
      getCategorys: "categorys/getCategorys",
      getTags: "tags/getTags",
      updatePost: "posts/updatePost",
    }),
    onChangeFile(e) {
      this.new_image = e;
    },
    update() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formData = new FormData();
        formData.append("id", this.$route.params.postid);
        formData.append("title", this.title);
        formData.append("category_id", this.category_id);
        formData.append("category", this.category);
        formData.append("content", this.content);
        formData.append("intro", this.intro);
        formData.append("status", this.status);
        formData.append("slug", this.slug);
        formData.append("author", this.author);
        formData.append("meta_title", this.meta_title);
        formData.append("meta_key", this.meta_key);
        formData.append("meta_description", this.meta_description);
        formData.append("new_image", this.new_image);
        formData.append("old_image", this.old_image);
        this.tags.forEach((tag) => {
          formData.append("tags[]", tag);
        });
        this.updatePost(formData);
      }
    },
    handleImageAdded(file, Editor, cursorLocation, resetUploader) {
      const formData = new FormData();
      formData.append("image", file);
      const config = {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      };
      this.$axios
        .post(`http://localhost:8000/api/admin/posts/images`, formData, config)
        .then((res) => {
          const url = res.data.url;
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch((err) => {
          console.log(err);
        });
      console.log(file);
    },
  },
  async mounted(_) {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    const res = await this.$axios.put(
      `/admin/posts/${this.$route.params.postid}`,
      _,
      config
    );
    this.title = res.data.data.title;
    this.content = res.data.data.content;
    this.intro = res.data.data.intro;
    this.status = res.data.data.status;
    this.slug = res.data.data.slug;
    this.author = res.data.data.author;
    this.meta_description = res.data.data.meta_description;
    this.meta_title = res.data.data.meta_title;
    this.meta_key = res.data.data.meta_key;
    this.category_id = res.data.data.category_id;
    this.old_image = res.data.data.image;
    this.tags = res.data.data.tags;
    this.category = res.data.data.category.title;
    this.getCategorys();
    this.getTags();
  },
};
</script>
<style>
</style>