<template >
  <div>
    <v-container class="my-10">
      <div class="d-flex align-center my-4">
        <v-text-field
          label="Search Here ..."
          class="form__control"
          hide-details="auto"
          outlined
        >
        </v-text-field>
        <v-btn color="success" text>Search</v-btn>
      </div>
      <h1>All Categorys</h1>

      <div class="my-4 text-center" v-if="$store.state.isloading">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <v-row class="my-5">
          <v-col
            xl="4"
            lg="4"
            md="4"
            sm="6"
            xs="12"
            v-for="(category, index) in AllCategorys"
            :key="index"
          >
            <v-card>
              <nuxt-link :to="{ path: '/category/' + category.id }"
                ><v-card-title>{{ category.title }}</v-card-title>
              </nuxt-link>

              <v-row class="my-5">
                <v-col
                  xl="4"
                  lg="4"
                  md="4"
                  sm="6"
                  xs="12"
                  v-for="(subcategory, index) in category.children"
                  :key="index"
                >
                  <v-card v-if="category.children">
                    <nuxt-link :to="{ path: '/category/' + subcategory.id }"
                      ><v-card-title>{{ subcategory.title }}</v-card-title>
                    </nuxt-link>
                  </v-card>
                </v-col>
              </v-row>
            </v-card>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
export default {
  data: () => ({
    page: 1,
    searchQuery: "",
  }),
  computed: {
    ...mapGetters({
      AllCategorys: "categorys/getAllCategorys",
    }),
  },
  methods: {
    ...mapActions({
      getAllCategorys: "categorys/getAllCategorys",
    }),
  },
  mounted() {
    this.getAllCategorys();
  },
};
</script>
  <style>
</style>