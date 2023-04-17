<template >
  <div>
    <v-container class="my-10">
      <div class="d-flex align-center my-4">
        <h2>Tabs</h2>
      </div>
      <div class="my-4 text-center" v-if="$store.state.isloading">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <v-row class="my-5">
          <!-- <v-col
            xl="4"
            lg="4"
            md="4"
            sm="6"
            xs="12"
            v-for="(tab, index) in AllTabs"
            :key="index"
          > -->
          <v-card>
            <v-tabs v-model="model">
              <v-tab
                v-for="(tab, index) in AllTabs"
                :key="index"
                :value="index"
              >
                Item {{ index }} {{ tab.title }}
              </v-tab>
            </v-tabs>

            <v-window v-model="model">
              <v-window-item
                v-for="(tab, index) in AllTabs"
                :key="index"
                :value="index"
              >
                <v-card>
                  <v-card-text v-html="tab.content"></v-card-text>
                </v-card>
              </v-window-item>
            </v-window>
          </v-card>
          <!-- </v-col> -->
        </v-row>
      </div>
    </v-container>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
export default {
  data() {
    return {
      model: "model",
    };
  },
  computed: {
    ...mapGetters({
      AllTabs: "tabs/getAllTabs",
    }),
  },
  methods: {
    ...mapActions({
      getAllTabs: "tabs/getAllTabs",
    }),
  },
  mounted() {
    this.getAllTabs();
  },
};
</script>
  <style>
</style>