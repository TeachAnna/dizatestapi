<template >
  <div>
    <SidebarVue />
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/item">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>
          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7">
              Update Item</v-card-title
            >
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="update">
                <v-text-field
                  label="Enter Title"
                  hide-details="auto"
                  outlined
                  v-model="title"
                  class="ma-2"
                  color="green lighten-1"
                >
                </v-text-field>

                <v-textarea
                  label="Enter intro"
                  outlined
                  v-model="intro"
                  class="ma-2"
                  color="green lighten-1"
                ></v-textarea>

                <vue-editor
                  id="editor"
                  class="ma-2"
                  color="green lighten-1"
                  :placeholder="content"
                  useCustomImageHandler
                  v-model="content"
                  @image-added="handleImageAdded"
                ></vue-editor>

                <v-file-input
                  accept="image/*"
                  label="File input"
                  outlined
                  class="ma-2"
                  color="green lighten-1"
                  @change="onChangeFile"
                ></v-file-input>

                <img
                  :src="`${$store.state.urlSite}/storage/${old_image}`"
                  alt=""
                  width="70"
                  cover
                />

                <input type="hidden" v-model="old_image" />

                <v-switch
                  class="ma-2"
                  v-model="status"
                  :label="`published`"
                  color="green lighten-1"
                ></v-switch>

                <v-btn type="submit" color="yellow lighten-2" text outlined>
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
import axios from "axios";
import { mapActions } from "vuex";
export default {
  layout: "admin",
  data: () => ({
    title: "",
    content: "",
    intro: "",
    status: "",
    old_image: "",
    new_image: "",
  }),
  methods: {
    ...mapActions({
      updateItem: "items/updateItem",
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
        const formdata = new FormData();
        formdata.append("id", this.$route.params.itemid);
        formdata.append("title", this.title);
        formdata.append("intro", this.intro);
        formdata.append("status", this.status);
        formdata.append("content", this.content);
        formdata.append("new_image", this.new_image);
        formdata.append("old_image", this.old_image);
        this.updateItem(formdata);
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
        .post(`http://localhost:8000/api/admin/items/images`, formData, config)
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
    const res = await axios.put(
      `http://localhost:8000/api/admin/items/${this.$route.params.itemid}`,
      _,
      config
    );
    this.title = res.data.data.title;
    this.content = res.data.data.content;
    this.old_image = res.data.data.image;
  },
};
</script>
  <style>
</style>