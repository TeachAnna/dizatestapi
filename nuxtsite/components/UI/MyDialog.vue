<template>
    <div
        class="dialog"
        @click="hideDialog"
        v-if="value"
    >
       <div @click.stop class="dialog__content">
            <slot></slot>
       </div>
    </div>
</template>

<script>

export default {
   props: {
       value: {
           type: Boolean,
           default: false
       }
   },
   methods: {
    hideDialog() {
        this.$emit('input', false)
    }
   }
}
</script>

<style scoped>
    .dialog {
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        background: rgba(0, 0, 0, 0.512);
        position: fixed;
        display: flex;
        z-index: 2;
    }
    .dialog__content {
        margin: auto;
        background: rgb(207, 199, 199);
        padding: 20px;
        border-radius: 12px;
        min-height: 100px;
        min-width: 300px;
    }
</style>