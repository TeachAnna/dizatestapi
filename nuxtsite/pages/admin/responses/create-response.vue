<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/response">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>

          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7"
              >Add Response</v-card-title
            >
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addResponse">
                <v-text-field
                  label="Enter Name "
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="name"
                >
                </v-text-field>
                <v-text-field
                  label="Enter email"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  outlined
                  v-model="email"
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
                  @change="onChangeFile"
                ></v-file-input>

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
    name: "",
    email: "",
    intro: "",
    status: "",
    image: "",
  }),

  methods: {
    ...mapActions({
      createResponse: "responses/createResponse",
    }),
    onChangeFile(e) {
      this.image = e;
    },
    addResponse() {
      if (!this.name) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const formdata = new FormData();
        formdata.append("name", this.name);
        formdata.append("image", this.image);
        formdata.append("intro", this.intro);
        formdata.append("email", this.email);
        formdata.append("status", this.status);
        this.createResponse(formdata);
      }
    },
  },
};
</script>
  <style>
</style>