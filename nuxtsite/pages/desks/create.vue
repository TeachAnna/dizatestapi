<template>
    <main>
      <!-- <PageTitle :page-title="this.pageTitle" /> -->
      <div>
        <p>title</p>
        <input type="text" v-model="title" />
        <dropzone
          ref="dz"
          id="dropzone"
          :options="options"
          :destroyDropzone="true"
        ></dropzone>
        <input
          type="submit"
          value="create"
          @click.prevent="addDesk"
          class="button"
        />
      </div>
    </main>
  </template>

  <script>
  export default {
    layout: 'default',
    // head() {
    //   return {
    //     title: this.pageTitle,
    //   }
    // },

    data() {
      return {
        // pageTitle: 'Create',
        title: null,
        options: {
          addRemoveLinks: true,
          url: '/admin/desks',
          autoProcessQueue: false,
          // maxFiles: 1,
        },
        dropzone: null,
      }
    },

    mounted() {
      this.dropzone = this.$refs.dz.dropzone
    },

    methods: {
      addDesk() {
        const formData = new FormData()
        formData.append('title', this.title)

        const files = this.dropzone.getAcceptedFiles()
        files.forEach((file) => {
          formData.append('images[]', file)
          this.dropzone.removeFile(file)
        })

        this.$axios.$post(`http://localhost:8000/api/admin/desks`, formData, {
          headers: {
            'Content-Type': 'multipart/form-data',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
          },
        })
        // this.$router.push('/')
      },


    },
  }
  </script>

  <style>

  </style>
