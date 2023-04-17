<template>
    <div class="bg_fon">
            <nuxt-link to="/" class="bred" exact>Home&nbsp;/&nbsp;</nuxt-link>
            <nuxt-link to="/blog" class="bred" exact>Blog&nbsp;</nuxt-link>
        <h1>
        / {{ pageTitle }}
        </h1>
    </div>

</template>

  <script>
  export default {
    props: {
      pageTitle: {
        type: String,
        required: true,
      },
    },
  }
  </script>

  <style>

  </style>