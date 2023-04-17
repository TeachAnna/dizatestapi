<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/video">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>
          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7">
              Update Video</v-card-title
            >
            <v-card-subtitle>
              <form class="form" @submit.prevent="update">
                <v-text-field
                  label="Enter Titile"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="title"
                >
                </v-text-field>

                <v-text-field
                  label="Enter URL"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="url"
                >
                </v-text-field>

                <v-textarea
                  class="ma-2"
                  color="green lighten-1"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>

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
    url: "",
    intro: "",
    status: "",
  }),
  methods: {
    ...mapActions({
      updateVideo: "videos/updateVideo",
    }),
    update() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("id", this.$route.params.videoid);
        formdata.append("title", this.title);
        formdata.append("intro", this.intro);
        formdata.append("url", this.url);
        formdata.append("status", this.status);
        this.updateVideo(formdata);
      }
    },
  },
  async mounted(_) {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    const res = await axios.put(
      `http://localhost:8000/api/admin/videos/${this.$route.params.videoid}`,
      _,
      config
    );
    this.title = res.data.data.title;
    this.url = res.data.data.url;
    this.intro = res.data.data.intro;
    this.status = res.data.data.status;
  },
};
</script>
  <style>
</style>