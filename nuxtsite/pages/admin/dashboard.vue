<template >
  <div>
    <DashboardVue />
  </div>
</template>
<script>
import DashboardVue from "@/components/admin/Dashboard.vue";
import { mapActions } from "vuex";
export default {
  layout: 'admin',
  middleware: ["auth"],
  components: {
    DashboardVue,
  },
  methods: {
    ...mapActions(["getAdmins"]),
  },

  mounted() {
    this.getAdmins();
  },
};
</script>
<style>
</style>