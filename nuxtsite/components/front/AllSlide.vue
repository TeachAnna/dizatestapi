<template >
  <div>
    <header>
      <v-carousel>
        <v-carousel-item
          v-for="(slide, i) in AllSlides"
          :key="i"
          :src="`${$store.state.urlSite}/storage/${slide.image}`"
          cover
        >
          <div class="d-flex fill-height justify-center align-center">
            <div class="slogan pa-5 text-center">
              <div class="text-h4">{{ slide.title }}</div>
              <div class="text-h6">{{ slide.intro }}</div>
            </div>
          </div>
        </v-carousel-item>
      </v-carousel>
    </header>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
export default {
  computed: {
    ...mapGetters({
      AllSlides: "slides/getAllSlides",
    }),
  },
  methods: {
    ...mapActions({
      getAllSlides: "slides/getAllSlides",
    }),
  },
  mounted() {
    this.getAllSlides();
  },
};
</script>
  <style>
.slogan {
  background: #27373b82;
}
</style>