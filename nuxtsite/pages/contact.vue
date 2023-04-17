<template>
  <div>
    <PageTitle :page-title="this.pageTitle" />
    <ContactFormVue />
  </div>
</template>
<script>
import ContactFormVue from "@/components/front/ContactForm.vue";
export default {
  head() {
    return {
      title: "Contact",
    };
  },
  head() {
    return {
      title: this.pageTitle,
    }
  },
  data() {
    return {
      pageTitle: 'Contacts',
    }
  },
  components: {
    ContactFormVue,
  },
};
</script>
<style >
</style>