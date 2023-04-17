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
              Update Category</v-card-title
            >
            <v-card-title v-if="isloading">Loading....</v-card-title>
            <v-card-subtitle>
              <form action="" class="form" @submit.prevent="update">
                <v-text-field
                  label="Enter Category"
                  class="ma-2"
                  color="green lighten-1"
                  hide-details="auto"
                  v-model="title"
                  outlined
                >
                </v-text-field>

                <v-select
                  v-model="parent_id"
                  :items="Cats"
                  item-value="id"
                  item-text="title"
                  :label="category"
                  class="ma-2"
                  color="green lighten-1"
                ></v-select>

                <v-textarea
                  label="Enter intro"
                  outlined
                  v-model="intro"
                  class="ma-2"
                  color="green lighten-1"
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
import { mapGetters, mapActions } from "vuex";
export default {
  layout: "admin",
  data: () => ({
    id: "",
    title: "",
    intro: "",
    status: "false",
    views: "",
    parent_id: "",
    category: "",
    isloading: false,
  }),
  computed: {
    ...mapGetters({
      Categorys: "categorys/getCategorys",
    }),
    Cats() {
      return this.Categorys.filter((elem) => elem.parent_id == null);
    },
  },
  methods: {
    ...mapActions({
      updateCategory: "categorys/updateCategory",
      getCategorys: "categorys/getCategorys",
    }),
    update() {
      if (!this.title) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const data = {
          id: this.$route.params.catid,
          title: this.title,
          intro: this.intro,
          views: this.views,
          status: this.status,
          parent_id: this.parent_id,
          category: this.category,
        };
        this.updateCategory(data);
      }
    },
  },

  async mounted(_) {
    this.isloading = true;
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    const res = await this.$axios.put(
      "/admin/categorys/" + this.$route.params.catid,
      _,
      config
    );
    if (res) {
      this.isloading = false;
      this.title = res.data.data.title;
      this.intro = res.data.data.intro;
      this.views = res.data.data.views;
      this.status = res.data.data.status;
      this.parent_id = res.data.data.parent_id;
      this.category = res.data.data.category;
    }
    console.log(res);
    this.getCategorys();
  },
};
</script>
<style>
</style>