<template >
  <div>
    <v-container>
      <v-row justify="center" class="mt-10">
        <v-col>
          <nuxt-link to="/admin/category">
            <v-btn color="yellow lighten-2" text outlined class="mb-2">
              <v-icon class="mdi mdi-arrow-left m-1"></v-icon>
              Go Back
            </v-btn>
          </nuxt-link>

          <v-card class="text-center pa-5 elevation-5">
            <v-card-title class="justify-center mb-7">
              Add Category</v-card-title
            >
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="addCategory">
                <v-text-field
                  label="Enter Category *"
                  hide-details="auto"
                  v-model="title"
                  class="ma-2"
                  outlined
                  color="green lighten-1"
                >
                </v-text-field>
                <v-select
                  v-model="parent_id"
                  :items="Cats"
                  item-value="id"
                  item-text="title"
                  label="Parent category"
                  class="ma-2"
                  color="green lighten-1"
                ></v-select>

                <v-textarea
                  class="ma-2"
                  color="green lighten-1"
                  label="Enter intro"
                  outlined
                  v-model="intro"
                ></v-textarea>
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
import { mapGetters, mapActions } from "vuex";

export default {
  layout: "admin",
  data: () => ({
    title: "",
    status: "",
    intro: "",
    parent_id: "",
    views: "",
  }),
  computed: {
    ...mapGetters({
      Categorys: "categorys/getCategorys",
    }),
    Cats() {
      return this.Categorys.filter((elem) => elem.parent_id == 0);
    },
  },
  methods: {
    ...mapActions({
      createCategory: "categorys/createCategory",
      getCategorys: "categorys/getCategorys",
    }),

    addCategory() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const data = {
          title: this.title,
          intro: this.intro,
          status: this.status,
          parent_id: this.parent_id,
          views: this.views,
        };
        this.createCategory(data);
      }
    },
  },
  mounted() {
    this.getCategorys();
  },
};
</script>
<style>
</style>