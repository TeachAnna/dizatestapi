<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/slide">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>

          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7"> Add Video</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addVideo">
                <v-text-field
                  label="Enter Titile"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="title"
                >
                </v-text-field>

                <vue-editor
                  id="editor"
                  class="ma-2"
                  color="green lighten-1"
                  :editorToolbar="customToolbar"
                  placeholder="add video..."
                  v-model="url"
                ></vue-editor>

                <v-textarea
                  class="ma-2"
                  color="green lighten-1"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>

                <v-switch
                  v-model="status"
                  :label="`published`"
                  class="ma-2"
                  color="green lighten-1"
                ></v-switch>

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
import { mapActions } from "vuex";
export default {
  layout: "admin",
  data: () => ({
    title: "",
    intro: "",
    url: "",
    status: "",
    customToolbar: [["video"]],
  }),

  methods: {
    ...mapActions({
      createVideo: "videos/createVideo",
    }),
    addVideo() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("title", this.title);
        formdata.append("url", this.url);
        formdata.append("intro", this.intro);
        formdata.append("status", this.status);
        this.createVideo(formdata);
      }
    },
  },
};
</script>
  <style>
</style>