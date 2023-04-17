<template>
  <div>
    <!-- <Hero /> -->
    <AllSlide />
    <PopularPost />
    <LatestPost />
    <!-- <AllVideo /> -->
    <AllResponse />
    <AllAccordion />
    <AllItem />
    <AllTab />
    <AllTeam />
    <AllMenu />
    <AllLink />
    <AllGallery />
  </div>
</template>

<script>
import LatestPost from "@/components/front/LatestPost.vue";
import PopularPost from "@/components/front/PopularPost.vue";
import AllSlide from "@/components/front/AllSlide.vue";
import AllVideo from "@/components/front/AllVideo.vue";
import AllResponse from "@/components/front/AllResponse.vue";
import AllAccordion from "@/components/front/AllAccordion.vue";
import AllItem from "@/components/front/AllItem.vue";
import AllMenu from "@/components/front/AllMenu.vue";
import AllTab from "@/components/front/AllTab.vue";
import AllTeam from "@/components/front/AllTeam.vue";
import AllLink from "@/components/front/AllLink.vue";
import AllGallery from "@/components/front/AllGallery.vue";

export default {
  head() {
    return {
      title: this.pageTitle,
    };
  },
  data() {
    return {
      pageTitle: "Home",
    };
  },
  components: {
    PopularPost,
    LatestPost,
    AllSlide,
    AllResponse,
    AllVideo,
    AllItem,
    AllTab,
    AllTeam,
    AllLink,
    AllMenu,
    AllGallery,
    AllAccordion,
  },
};
</script>
