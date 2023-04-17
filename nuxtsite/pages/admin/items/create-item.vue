<template >
  <div>
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
            <v-card-title class="justify-center mb-7"> Add Item</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addItem">
                <v-text-field
                  label="Enter Titile"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="title"
                >
                </v-text-field>

                <v-textarea
                  class="ma-2"
                  color="green lighten-1"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>

                <vue-editor
                  id="editor"
                  class="ma-2"
                  color="green lighten-1"
                  placeholder="Write Something..."
                  useCustomImageHandler
                  v-model="content"
                  @image-added="handleImageAdded"
                ></vue-editor>

                <v-file-input
                  class="ma-2"
                  color="green lighten-1"
                  accept="image/*"
                  label="File input"
                  outlined
                  @change="onChangeFile"
                ></v-file-input>

                <v-switch
                  class="ma-2"
                  color="green lighten-1"
                  v-model="status"
                  :label="`published`"
                >
                </v-switch>

                <v-btn type="submit" color="yellow lighten-2" text outlined>
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
import axios from "axios";
import { mapActions } from "vuex";
export default {
  layout: "admin",
  data: () => ({
    title: "",
    file: "",
    content: "",
    intro: "",
    status: "",
  }),

  methods: {
    ...mapActions({
      createItem: "items/createItem",
    }),
    onChangeFile(e) {
      this.file = e;
    },
    addItem() {
      if (!this.title || !this.content) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("title", this.title);
        formdata.append("intro", this.intro);
        formdata.append("status", this.status);
        formdata.append("content", this.content);
        formdata.append("image", this.file);
        this.createItem(formdata);
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
      axios
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
};
</script>
  <style>
</style>