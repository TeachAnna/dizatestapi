<template >
  <div>
    <v-container>
      <v-row>
        <v-col xl="8" lg="8" md="8" sm="12">
          <div class="my-10">

<!-- {{
Math.round(parseFloat(totalReitings / postReitingsLength) * 10) / 10
}} -->
 <!-- {{ mapReitings }} -->
 <!-- {{ totalReitings }} -->
<!-- {{ reiting }} -->
<!-- {{ Reitings.length}} <br>
{{ postReitings.length }} -->
<v-btn @click="submitReitings(postid)" >
  <v-rating
          v-model="reiting"
          color="yellow darken-3"
          background-color="grey darken-1"
          empty-icon="$ratingFull"
          half-increments
          hover
          large
        ></v-rating>
</v-btn>

<v-btn @click="submitLikes(postid)" >
  <v-icon v-model="like" @click="like++"> mdi-thumb-up</v-icon>
  {{ postLikes.length }}
</v-btn>

            <img
              style="width: 100%"
              :src="`${$store.state.urlSite}/storage/${image}`"
              :alt="title"
            />
            <div>
              author - {{ author }}
              author - {{ meta_title }}
            </div>
            <div class="my-2">
              <h2>title - {{ title }}</h2>
            </div>
           <div> Category -
             <nuxt-link :to="`/category-posts/${id}`">
                <h4 class="mb-2">{{ category }}</h4>
             </nuxt-link
              >
           </div>
            <div>Tags -
              <nuxt-link
                  v-for="(tag, index) in tags"
                  :key="index"
                  :to="`/tag-posts/${tag.id}`"
                >
                  <h4 class="mt-2">
                    {{ tag.title }}
                  </h4></nuxt-link
                >
            </div>
            <hr>
            <div class="mb-3">
              <p v-html="content" class="ql-editor" >
              </p>
            </div>
            <p>   <v-icon color="blue darken-3"> mdi-eye</v-icon>{{ views }}</p>
            <div>intro - {{ intro }}</div>
          </div>
<!-- <p>
  alll -{{  allPosts.length }}
  map -{{  mapAllPosts }}
  index -{{  postIndex }}
  last -{{  lastPost }}
</p> -->

<!-- {{ mapAllPosts.at() }} -->

          <nuxt-link
          v-if="postid > 1"
          :to="`/${postid-1}`">
                  <v-btn
                    class="my-4 btn__border"
                    variant="contained"
                    color="primary"
                    text
                    >prev</v-btn
                  ></nuxt-link
                >
                <nuxt-link

                :to="`/${postid+1}`">
                  <v-btn
                    class="my-4 btn__border"
                    variant="contained"
                    color="primary"
                    text
                    >next</v-btn
                  ></nuxt-link
                >
          <h3>
            Comments(
            {{
              postComments.length > 0
                ? postComments.length
                : "0"
            }}
            )
          </h3>
          <hr />
        </v-col>
        <v-col xl="4" lg="4" md="4" sm="12">
          <div class="my-10">
            <v-card>
              <v-card-title>
                <h3>Categorys</h3>
              </v-card-title>
              <v-card-text>
                <nuxt-link
                  v-for="(category, index) in Categorys"
                  :key="index"
                  :to="`/category/${category.id}`"
                >
                  <h4 class="mt-2">
                     {{ category.title }}
                  </h4></nuxt-link
                >
              </v-card-text>
            </v-card>

            <v-card>
              <v-card-title>
                <h3>Tags</h3>
              </v-card-title>
              <v-card-text>

                <nuxt-link
                  v-for="(tag, index) in Tags"
                  :key="index"
                  :to="`/tag/${tag.id}`"
                >
                  <h4 class="mt-2">
                    {{ tag.title }}
                  </h4></nuxt-link
                  >
              </v-card-text>
            </v-card>
          </div>

          <div class="my-10">
            <v-card>
              <v-card-title>
                <h3>Lastest Posts</h3>
              </v-card-title>
              <v-card-text>
                <nuxt-link
                  v-for="(latestPost, index) in LatestPosts"
                  :key="index"
                  :to="{ path: '/' + latestPost.id }"
                >
                  <h4 class="mt-2">{{ latestPost.title }}</h4>
                </nuxt-link>
              </v-card-text>
            </v-card>
          </div>
        </v-col>
      </v-row>
      <v-row>
        <v-col xl="7" lg="7" md="7" sm="12">

          <div v-if="!postComments.length > 0">
            Comment not found in this post
          </div>
          <div v-for="comment in postComments" :key="comment.id">
            <v-sheet class="p-3">

              <h3>{{ comment.name }}</h3>
              <p>{{ comment.comment }}</p>
              <p>{{ comment.post_id }}</p>
              <hr />

            </v-sheet>
          </div>

        </v-col>
        <v-col xl="5" lg="5" md="5" sm="12" xs="12">
          <form action="" class="form">

            <v-text-field
              label="Enter Your Name"
              class="form__control"
              hide-details="auto"
              v-model="name"
            >
            </v-text-field>
            <v-text-field
              label="Enter Your Email"
              class="form__control"
              hide-details="auto"
              v-model="email"
            >
            </v-text-field>
            <v-text-field
              label="Enter Your Comment"
              class="form__control"
              hide-details="auto"
              v-model="comments"
            >
            </v-text-field>
            <v-btn
              color="error"
              @click="submitComments(postid)"
              class="login__btn"
            >
              Comment</v-btn
            >
          </form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";
export default {
  props: {
    id: Number,
    title: String,
    deleted_at: String,
    category: String,
    intro: String,
    content: String,
    views: String,
    image: String,
    slug: String,
    author: String,
    meta_description: String,
    meta_key: String,
    meta_title: String,
    cod: Number,
    postid: Number,
    tags: Array,
  },
  data: () => ({
    name: "",
    email: "",
    comments: "",
    like: 0,
    reiting: 1,
    // dislike: "",
  }),
  computed: {
    ...mapGetters({
      LatestPosts: 'posts/getLatestPosts',
      Comments: 'comments/getComments',
      Likes: 'likes/getLikes',
      Reitings: 'reitings/getReitings',
      Tags: 'tags/getTags',
      Categorys: 'categorys/getCategorys',
      Posts: 'posts/getPosts',
      allPosts: 'posts/getAllPosts',
    }),

     mapAllPosts() {
      return this.allPosts.map(({id}) => id)
    },

    postIndex() {
      // return this.mapAllPosts.indexOf(this.postid)
      return this.mapAllPosts.find(item => item == this.postid)
    },

      postInclude() {
      // return this.mapAllPosts.indexOf(this.postid)
      return this.mapAllPosts.includes(item => item == this.postid)
    },

lastPost() {
  return this.mapAllPosts.at()
},
    postComments() {
      return this.Comments.filter(elem =>elem.post_id === this.postid)
    },
    postLikes() {
      return this.Likes.filter(elem =>elem.post_id == this.postid)
    },
    postReitings() {
      return this.Reitings.filter(elem =>elem.post_id == this.postid)
    },
    mapReitings() {
      return this.postReitings.map(({reiting}) => reiting)
    },

    // totalReitings() {
    //   return this.mapReitings.reduce((total, amount) => total + amount);
    // },
    // Reit() {
    //   return  totalReitings / postReitingsLength
    // }
    postReitingsLength() {
      return this.postReitings.length
    }
  },
  methods: {
    ...mapActions({
      getPosts: 'posts/getPosts',
      getAllPosts: 'posts/getAllPosts',
      getLatestPosts: 'posts/getLatestPosts',
      getCategorys: 'categorys/getCategorys',
      getTags: 'tags/getTags',
      getComments: 'comments/getComments',
      getLikes: 'likes/getLikes',
      getReitings: 'reitings/getReitings',
      addComment: 'comments/addComment',
      addLike: 'likes/addLike',
      addReiting: 'reitings/addReiting',
    }),

    async submitComments(cid) {
      if (!this.name || !this.email || !this.comments) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const data = {
          id: cid,
          name: this.name,
          email: this.email,
          comment: this.comments,
        };
        await this.addComment(data);
        this.getComments(this.postid);
        this.name = "";
        this.email = "";
        this.comments = "";
      }
    },

    async submitLikes(lid) {
      if (!this.like ) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const data = {
          id: lid,
          like: this.like,
        };
        await this.addLike(data);
        this.getLikes(this.postid);
      }
    },

    async submitReitings(rid) {
      if (!this.reiting ) {
        this.$toast.show("Please fill the field", {
          type: "error",
        });
      } else {
        const data = {
          id: rid,
          reiting: this.reiting,
        };
        await this.addReiting(data);
        this.getReitings(this.postid);
      }
    },

  },
  mounted() {
    this.getLatestPosts();
    this.getCategorys();
    this.getTags();
    this.getPosts();
    this.getAllPosts();
    this.getComments(this.postid);
    this.getLikes(this.postid);
    this.getReitings(this.postid);
  },
};
</script>
<style>
.ql-editor img {
  width:70%;
  display: block;
  margin: auto;
}
</style>