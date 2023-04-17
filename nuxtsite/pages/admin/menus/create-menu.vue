<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/menu">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>

          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7"> Add Menu</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addMenu">
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

                <v-switch
                  v-model="status"
                  class="ma-2"
                  color="green lighten-1"
                  :label="`published`"
                ></v-switch>
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
  }),

  methods: {
    ...mapActions({
      createMenu: "menus/createMenu",
    }),
    addMenu() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        // we use formdata
        const formdata = new FormData();
        formdata.append("title", this.title);
        this.createMenu(formdata);
      }
    },
  },
};
</script>
  <style>
</style>