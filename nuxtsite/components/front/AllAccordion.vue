<template >
  <div>
    <v-container class="my-10">
      <div class="d-flex align-center my-4">
        <h2>Accordion</h2>
      </div>
      <div class="my-4 text-center" v-if="$store.state.isloading">
        <h1 class="text-center my-3">
          <img src="~/static/loading.svg" alt="" />
        </h1>
      </div>
      <div v-else>
        <v-expansion-panels accordion>
          <v-expansion-panel
            v-for="(accordion, index) in AllAccordions"
            :key="index"
          >
            <v-expansion-panel-header>{{
              accordion.title
            }}</v-expansion-panel-header>
            <v-expansion-panel-content>
              {{ accordion.intro }}
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </div>
    </v-container>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      AllAccordions: "accordions/getAllAccordions",
    }),
  },
  methods: {
    ...mapActions({
      getAllAccordions: "accordions/getAllAccordions",
    }),
  },
  mounted() {
    this.getAllAccordions();
  },
};
</script>
  <style>
</style>