<template>
  <div>
    <v-container>
      <v-card class="pa-5 mt-15 elevation-5">
        <v-card-title class="justify-center mb-5">Change Setting</v-card-title>

        <div v-if="isLoading">
          <h1 class="text-center my-3">
            <img src="~/static/loading.svg" alt="" />
          </h1>
        </div>
        <div v-else>
          <v-card-actions>
            <form class="form" @submit.prevent="changeSetting">
              <v-text-field
                label="Enter header Name"
                class="mb-3"
                hide-details="auto"
                v-model="header_logo"
                color="green lighten-1"
                placeholder="Header Name"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter footer Name"
                class="mb-3"
                hide-details="auto"
                v-model="footer_logo"
                color="green lighten-1"
                placeholder="footer Name"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter footer Desc"
                class="mb-3"
                hide-details="auto"
                v-model="footer_desc"
                color="green lighten-1"
                placeholder="footer Desc"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter Email"
                class="mb-3"
                hide-details="auto"
                v-model="email"
                color="green lighten-1"
                placeholder="Email"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter Phone"
                class="mb-3"
                hide-details="auto"
                v-model="phone"
                color="green lighten-1"
                placeholder="Phone"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter Address"
                class="mb-3"
                hide-details="auto"
                v-model="address"
                color="green lighten-1"
                placeholder="Address"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter facebook link"
                class="mb-3"
                hide-details="auto"
                v-model="facebook"
                color="green lighten-1"
                placeholder="Facebook link"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter youtube link"
                class="mb-3"
                hide-details="auto"
                v-model="youtube"
                color="green lighten-1"
                placeholder="Youtube"
                outlined
              >
              </v-text-field>
              <v-text-field
                label="Enter instagram"
                class="mb-3"
                hide-details="auto"
                v-model="instagram"
                placeholder="instagram"
                outlined
                color="green lighten-1"
              >
              </v-text-field>
              <v-text-field
                label="Enter about Title"
                class="mb-3"
                hide-details="auto"
                v-model="about_title"
                placeholder="about Title"
                outlined
                color="green lighten-1"
              >
              </v-text-field>
              <v-text-field
                label="Enter about Desc"
                class="mb-3"
                hide-details="auto"
                v-model="about_desc"
                placeholder="about Desc"
                outlined
                color="green lighten-1"
              >
              </v-text-field>
              <v-btn
                type="submit"
                color="yellow lighten-2"
                text
                outlined
                class="ma-3 float-right me-2"
              >
                <v-icon class="mdi mdi-content-save-check m-1"></v-icon>
                {{ isLoading ? "Changing..." : "Change Setting" }}
              </v-btn>
            </form>
          </v-card-actions>
        </div>
      </v-card>
    </v-container>
  </div>
</template>
<script>
export default {
  layout: "admin",
  data: () => ({
    id: "",
    header_logo: "",
    footer_logo: "",
    footer_desc: "",
    email: "",
    phone: "",
    address: "",
    facebook: "",
    instagram: "",
    youtube: "",
    about_title: "",
    about_desc: "",
    isLoading: false,
  }),
  methods: {
    async changeSetting() {
      const config = {
        headers: {
          Authorization: "Bearer " + localStorage.getItem("token"),
        },
      };
      const data = {
        header_logo: this.header_logo,
        footer_logo: this.footer_logo,
        footer_desc: this.footer_desc,
        email: this.email,
        phone: this.phone,
        address: this.address,
        facebook: this.facebook,
        instagram: this.instagram,
        youtube: this.youtube,
        about_title: this.about_title,
        about_desc: this.about_desc,
      };
      this.isLoading = true;
      const res = await this.$axios.post(
        `/admin/setting/${this.id}`,
        data,
        config
      );
      if (res.data.success) {
        this.isLoading = false;
        this.$toast.show(res.data.message, {
          type: "success",
        });
      } else {
        this.$toast.show(res.data.message, {
          type: "error",
        });
      }
    },
  },
  async mounted() {
    const config = {
      headers: {
        Authorization: "Bearer " + localStorage.getItem("token"),
      },
    };
    this.isLoading = true;

    const res = await this.$axios.get(`/admin/setting`, config);
    if (res.data.success) {
      this.isLoading = false;

      this.id = res.data.settings.id;
      this.header_logo = res.data.settings.header_logo;
      this.footer_logo = res.data.settings.footer_logo;
      this.footer_desc = res.data.settings.footer_desc;
      this.email = res.data.settings.email;
      this.phone = res.data.settings.phone;
      this.address = res.data.settings.address;
      this.facebook = res.data.settings.facebook;
      this.instagram = res.data.settings.instagram;
      this.youtube = res.data.settings.youtube;
      this.about_title = res.data.settings.about_title;
      this.about_desc = res.data.settings.about_desc;
    }
  },
};
</script>
<style >
</style>