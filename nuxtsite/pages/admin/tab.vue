<template>
  <div>
    <v-container>
      <v-card class="pa-3 mt-15 elevation-5">
        <v-card-text class="d-flex justify-space-between align-center">
          <v-card-title> Tabs ( {{ tabs.length }} ) </v-card-title>
          <v-card-actions>
            <nuxt-link to="/admin/tabs/create-tab">
              <v-btn color="yellow lighten-2" text outlined>
                <v-icon size="large" class="mdi mdi-plus-circle mx-1"></v-icon>
                New
              </v-btn>
            </nuxt-link>
          </v-card-actions>
        </v-card-text>

        <v-sheet class="d-flex align-center">
          <v-text-field
            label="Enter count posts on page"
            class="ma-3"
            hide-details="auto"
            outlined
            color="green lighten-1"
            v-model="num_per_page"
            type="number"
          >
          </v-text-field>

          <v-switch
            v-model="selectSort"
            :label="`sort`"
            value="title"
            color="green lighten-1"
          ></v-switch>

          <v-text-field
            label="Search Here ..."
            class="ma-3"
            hide-details="auto"
            outlined
            color="green lighten-1"
            v-model="searchQuery"
            append-icon="mdi mdi-magnify"
          >
          </v-text-field>
        </v-sheet>

        <v-card-subtitle>
          <div v-if="$store.state.isloading">
            <h1 class="text-center my-3">
              <img src="~/static/loading.svg" alt="" />
            </h1>
          </div>
          <div v-else>
            <v-simple-table>
              <template v-slot:default>
                <thead class="bg blue-grey darken-3">
                  <tr>
                    <th class="text-enter">Id</th>
                    <th class="text-enter">Title</th>
                    <th class="text-enter">Status</th>
                    <th class="text-enter">Edit</th>
                    <th class="text-enter">Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(tab, index) in new_page_items" :key="index">
                    <td class="">{{ index + 1 }}</td>
                    <td class="">{{ tab.title }}</td>

                    <td class="">
                      <div v-if="tab.status == 'true'">
                        <v-icon color="green darken-3"> mdi-check</v-icon>
                      </div>
                      <div v-else>
                        <v-icon color="yellow lighten-1"> mdi-check</v-icon>
                      </div>
                    </td>
                    <td class="">
                      <nuxt-link :to="`/admin/tabs/update-tab/${tab.id}`">
                        <v-btn text class="ma-2" variant="text" color="blue">
                          <v-icon color="yellow lighten-1"> mdi-pencil</v-icon>
                        </v-btn></nuxt-link
                      >
                    </td>
                    <td class="">
                      <v-btn
                        @click="delTab(tab.id)"
                        text
                        class="ma-2"
                        variant="text"
                        color="red"
                      >
                        <v-icon color="yellow lighten-1"> mdi-delete</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </div>
        </v-card-subtitle>
        <v-card-actions class="justify-center pt-3 mb-5">
          <div class="pagination">
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 1 >= 0"
              v-on:click="set_page(-1)"
              >&laquo;</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 2 >= 0"
              v-on:click="set_page(-2)"
              >{{ page - 1 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="page - 1 >= 0"
              v-on:click="set_page(-1)"
              >{{ page }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              class="active"
              v-if="tabs.length >= num_per_page"
              >{{ page + 1 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 1) < this.tabs.length"
              v-on:click="set_page(+1)"
              >{{ page + 2 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 2) < this.tabs.length"
              v-on:click="set_page(+2)"
              >{{ page + 3 }}</v-btn
            >
            <v-btn
              color="yellow lighten-2"
              text
              outlined
              v-if="this.num_per_page * (this.page + 1) < this.tabs.length"
              v-on:click="set_page(+1)"
              >&raquo;</v-btn
            >
          </div>
        </v-card-actions>
      </v-card>
    </v-container>
  </div>
</template>
  <script>
import { mapGetters, mapActions } from "vuex";
export default {
  layout: "admin",
  middleware: ["auth"],

  data: () => ({
    page: 1,
    page: 0,
    num_per_page: 3,
    searchQuery: "",
  }),
  computed: {
    ...mapGetters({
      tabs: "tabs/getTabs",
    }),
    new_page_items: function () {
      return this.tabs.slice(
        this.num_per_page * this.page,
        this.num_per_page * (this.page + 1)
      );
    },
  },
  methods: {
    set_page: function (num) {
      this.page = this.page + num;
    },
    ...mapActions(["getAdmins"]),
    ...mapActions({
      getTabs: "tabs/getTabs",
      deleteTab: "tabs/deleteMenu",
    }),
    delTab(id) {
      this.deleteTab(id);
      this.getTabs();
    },
  },
  async mounted() {
    await this.getAdmins();
    await this.getTabs();
  },
};
</script>
  <style>
</style>