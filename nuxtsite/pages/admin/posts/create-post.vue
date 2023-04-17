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
            <v-card-title class="justify-center mb-7"> Add Post</v-card-title>

            <v-card-subtitle class="pb-10">
              <form @submit.prevent="addPost">
                <v-text-field
                  label="Enter Titile *"
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
                  label="Category ..."
                  class="ma-2"
                  color="green lighten-1"
                ></v-select>

                <v-autocomplete
                  v-model="tags"
                  :items="Tags"
                  item-value="id"
                  item-text="title"
                  label="Tags..."
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
                <!-- <img  :src="imageSrc" width="100px" /> -->

                <v-textarea
                  class="ma-2"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                  color="green lighten-1"
                ></v-textarea>

                <client-only>
                  <vue-editor
                    id="editor"
                    class="ma-2"
                    placeholder="Write Something..."
                    useCustomImageHandler
                    useMarkdownShortcuts
                    v-model="content"
                    @image-added="handleImageAdded"
                    color="green lighten-1"
                  ></vue-editor
                ></client-only>
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
                  class="ma-2"
                  label="Enter meta_description"
                  outlined
                  hide-details="auto"
                  v-model="meta_description"
                  color="green lighten-1"
                ></v-text-field>

                <v-switch
                  v-model="status"
                  :label="`published`"
                  class="ma-2"
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
                  {{ $store.state.isloading ? "Saveing..." : "Save" }}
                </v-btn>
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
  // props: ['imageSrc'],
  data: () => ({
    category_id: "",
    title: "",
    image: "",
    content: "",
    status: "",
    slug: "",
    author: "",
    meta_title: "",
    meta_description: "",
    meta_key: "",
    tags: [],
    // category: null,
    // categorys: [],
    intro: "",
  }),
  computed: {
    ...mapGetters({
      Tags: "tags/getTags",
      Categorys: "categorys/getCategorys",
    }),
  },
  methods: {
    ...mapActions({
      createPost: "posts/createPost",
      getTags: "tags/getTags",
      getCategorys: "categorys/getCategorys",
    }),

    onChangeFile(e) {
      this.image = e;
      // this.imageSrc = e
    },
    addPost() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formData = new FormData();
        formData.append("title", this.title);
        formData.append("intro", this.intro);
        formData.append("category_id", this.category_id);
        formData.append("content", this.content);
        formData.append("status", this.status);
        formData.append("slug", this.slug);
        formData.append("author", this.author);
        formData.append("meta_title", this.meta_title);
        formData.append("meta_key", this.meta_key);
        formData.append("meta_description", this.meta_description);
        formData.append("image", this.image);

        this.tags.forEach((tag) => {
          formData.append("tags[]", tag);
        });
        this.createPost(formData);
      }
    },
    handleImageAdded(file, Editor, cursorLocation, resetUploader) {
      const formData = new FormData();
      formData.append("image", file);
      const config = {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
          "Content-Type": "multipart/form-data",
        },
      };
      this.$axios
        .post(`http://localhost:8000/api/admin/posts/images`, formData, config)
        .then((result) => {
          const url = result.data.url;
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
          console.log(result);
        })
        .catch((err) => {
          console.log(err);
        });
      console.log(file);
    },
  },
  mounted() {
    this.getCategorys();
    this.getTags();
  },
};
</script>
<style>
</style>