<template>
    <div>
        <div>
            Example Component
        </div>

        <div>
            I'm an example component.
        </div>
        <p>
            here is variable:
            {{title}}
        </p>
    </div>
</template>

<script>
    export default {
        mounted() {
            props : ['title'];
        }
    }
</script>
