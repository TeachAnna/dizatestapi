<template >
  <div>
    <v-carousel v-model="model">
      <v-carousel-item>
        <div
          class="bg_image"
          style="
            background-image: url('https://static.dw.com/image/55178101_1004.jpg');
          "
        >
          <div class="w__40">
            <h1 class="text--white">Welcome to my Nuxt and laravel website</h1>
            <p class="text--white">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo ut
              excepturi, incidunt facilis temporibus perferendis, veritatis,
              sapiente molestias quibusdam aspernatur consequatur fugiat quasi
              dicta nesciunt provident amet? Officia, exercitationem laboriosam.
            </p>
          </div>
        </div>
      </v-carousel-item>
      <v-carousel-item>
        <div
          class="bg_image"
          style="
            background-image: url('https://ecopolitic.com.ua/wp-content/uploads/2022/03/shutterstock_2119226741.jpg');
          "
        >
          <div class="w__40">
            <h1 class="text--white">Welcome to my Nuxt and laravel website</h1>
            <p class="text--white">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Illo ut
              excepturi, incidunt facilis temporibus perferendis, veritatis,
              sapiente molestias quibusdam aspernatur consequatur fugiat quasi
              dicta nesciunt provident amet? Officia, exercitationem laboriosam.
            </p>
          </div>
        </div>
      </v-carousel-item>
    </v-carousel>
  </div>
</template>
<script>
export default {
  data: () => ({
    model: "",
  }),
};
</script>
<style>
.bg_image {
  width: 100%;
  background-position: center center;
  background-repeat: no-repeat;
  background-size: cover;
  height: 80vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>