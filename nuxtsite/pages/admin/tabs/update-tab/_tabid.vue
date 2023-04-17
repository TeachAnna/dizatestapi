<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/tab">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>
          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7"> Update Tab</v-card-title>
            <v-card-subtitle>
              <form class="form" @submit.prevent="update">
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
                  :placeholder="content"
                  useCustomImageHandler
                  v-model="content"
                  class="ma-2"
                  color="green lighten-1"
                  @image-added="handleImageAdded"
                ></vue-editor>

                <br />

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
    status: "",
    content: "",
  }),
  methods: {
    ...mapActions({
      updateTab: "tabs/updateTab",
    }),
    update() {
      if (!this.title || !this.content) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("id", this.$route.params.tabid);
        formdata.append("title", this.title);
        formdata.append("status", this.status);
        formdata.append("content", this.content);
        this.updateTab(formdata);
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
        .post(`http://localhost:8000/api/admin/tabs/images`, formData, config)
        .then((res) => {
          const url = res.data.url;
          Editor.insertEmbed(cursorLocation, "image", url);
          resetUploader();
        })
        .catch((err) => {
          console.log(err);
        });
      console.log();
    },
  },
  async mounted(_) {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    const res = await axios.put(
      `http://localhost:8000/api/admin/tabs/${this.$route.params.tabid}`,
      _,
      config
    );
    this.title = res.data.data.title;
    this.status = res.data.data.status;
    this.content = res.data.data.content;
  },
};
</script>
  <style>
</style>