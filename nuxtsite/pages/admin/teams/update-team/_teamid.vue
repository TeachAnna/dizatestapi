<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/team">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>
          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7">
              Update Team</v-card-title
            >
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="update">
                <v-text-field
                  label="Enter Titile"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="name"
                >
                </v-text-field>

                <v-text-field
                  label="Enter Position"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="position"
                >
                </v-text-field>

                <v-text-field
                  label="Enter Phone"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="phone"
                >
                </v-text-field>

                <v-textarea
                  class="ma-2"
                  color="green lighten-1"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>

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
                  width="150"
                  cover
                />

                <input type="hidden" v-model="old_image" />
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
    name: "",
    intro: "",
    status: "",
    position: "",
    phone: "",
    old_image: "",
    new_image: "",
  }),
  methods: {
    ...mapActions({
      updateTeam: "teams/updateTeam",
    }),

    onChangeFile(e) {
      this.new_image = e;
    },
    update() {
      if (!this.name) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("id", this.$route.params.teamid);
        formdata.append("name", this.name);
        formdata.append("intro", this.intro);
        formdata.append("status", this.status);
        formdata.append("position", this.position);
        formdata.append("phone", this.phone);
        formdata.append("new_image", this.new_image);
        formdata.append("old_image", this.old_image);
        this.updateTeam(formdata);
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
      `http://localhost:8000/api/admin/teams/${this.$route.params.teamid}`,
      _,
      config
    );
    this.name = res.data.data.name;
    this.intro = res.data.data.intro;
    this.status = res.data.data.status;
    this.position = res.data.data.position;
    this.phone = res.data.data.phone;
    this.old_image = res.data.data.image;
  },
};
</script>
  <style>
</style>