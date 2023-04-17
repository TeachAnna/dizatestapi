<template>
  <div>
    <PageTitle :page-title="this.pageTitle" />
    <v-container class="my-10">
      <h1>{{ Settings.about_title }}</h1>
      <p>{{ Settings.about_desc }}</p>
      <img src="~/static/v.png" alt="" />
      <v-btn @click="showDialog">
          dialog
      </v-btn>
      <my-dialog v-model="dialogVisible">
        <h2>dddddddddd</h2>
      </my-dialog>
    </v-container>
  </div>
</template>
<script>

import { mapGetters, mapActions } from "vuex";
export default {
  head() {
    return {
      title: this.pageTitle,
    }
  },
  data() {
    return {
      pageTitle: 'About',
      dialogVisible: false,
    }
  },
  computed: {
    ...mapGetters({
      Settings: 'settings/getSettings',
    }),
  },
  methods: {
    ...mapActions({
      getSettings: 'settings/getSettings',
    }),
    showDialog() {
        this.dialogVisible = true
      },
  },
  mounted() {
    this.getSettings();
  },
};
</script>
<style>
</style>