<template>
     <v-btn
     class=""
     :class="btnClass"
     v-on="$listeners"
     v-bind="$attrs"
     >
        <slot></slot>
     </v-btn>
</template>

<script>

export default {
    props: {
        btnClass: {
            type: String,
            default: 'green'
        }
    }
}
</script>

<style>

</style>