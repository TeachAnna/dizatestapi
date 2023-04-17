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
            <v-card-title class="justify-center mb-7"> Add Team</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addTeam">
                <v-text-field
                  label="Enter Titile"
                  hide-details="auto"
                  outlined
                  v-model="name"
                  color="green lighten-1"
                  class="ma-2"
                >
                </v-text-field>

                <v-text-field
                  label="Enter Phone"
                  hide-details="auto"
                  outlined
                  v-model="phone"
                  color="green lighten-1"
                  class="ma-2"
                >
                </v-text-field>

                <v-text-field
                  label="Enter Position"
                  hide-details="auto"
                  outlined
                  v-model="position"
                  color="green lighten-1"
                  class="ma-2"
                >
                </v-text-field>

                <v-textarea
                  label="Enter intro"
                  outlined
                  v-model="intro"
                  color="green lighten-1"
                  class="ma-2"
                ></v-textarea>

                <v-file-input
                  accept="image/*"
                  label="File input"
                  outlined
                  @change="onChangeFile"
                  class="ma-2"
                  color="green lighten-1"
                ></v-file-input>

                <v-switch
                  v-model="status"
                  :label="`published`"
                  color="green lighten-1"
                  class="ma-2"
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
import SidebarVue from "@/components/admin/Sidebar.vue";

import { mapActions } from "vuex";
export default {
  layout: "admin",
  components: {
    SidebarVue,
  },
  data: () => ({
    name: "",
    file: "",
    phone: "",
    position: "",
    intro: "",
    status: "",
  }),

  methods: {
    ...mapActions({
      createTeam: "teams/createTeam",
    }),
    onChangeFile(e) {
      this.file = e;
    },
    addTeam() {
      if (!this.name) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("name", this.name);
        formdata.append("intro", this.intro);
        formdata.append("status", this.status);
        formdata.append("position", this.position);
        formdata.append("phone", this.phone);
        formdata.append("image", this.file);
        this.createTeam(formdata);
      }
    },
  },
};
</script>
  <style>
</style>