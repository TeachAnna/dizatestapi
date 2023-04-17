
<template>
  <main>

    <h2>Lorem ipsum dolor sit.</h2>
    <!-- <NuxtLink :to="`/desks/create`">
      <h3>create</h3>
    </NuxtLink> -->
    <section>

      <div v-for="desk of allDesks" :key="desk.id">


            <!-- <div>
              <NuxtLink :to="`/desks/${desk.id}`">
                <h3>{{ desk.title }}</h3>
              </NuxtLink>
            </div> -->
            <div>id - {{ desk.id }}</div>

            <div> {{ desk.title }}</div>


          <!-- <NuxtLink :to="`/posts/${post.id}/edit`">
            <h3>Edit</h3>
          </NuxtLink> -->
          <!-- <input
            type="submit"
            value="Delete"
            @click.prevent="
              $store.dispatch('desks/deleteDesk', { id: desk.id })
            "
          /> -->


      </div>
    </section>
  </main>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'

export default {
  layout: 'admin',
  middleware: ["auth"],
  // head() {
  //   return {
  //     title: this.pageTitle,
  //   }
  // },
  // data() {
  //   return {
  //     pageTitle: 'Posts',
  //   }
  // },

  async asyncData({ $axios }) {
      const config = {
          'headers': {
              'Authorization': 'Bearer ' + localStorage.getItem('token'),
          }
      }
    const { data } = await $axios.$get(`http://localhost:8000/api/admin/desks`, config)
    return {
      desks: data,
    }
  },

  computed: {
    ...mapGetters({
      allDesks: 'desks/getDesks',
    }),
  },
  methods: {
    ...mapActions({
      fetchDesks: 'desks/fetchDesks',
    }),
  },
}
</script>

<style>

</style>