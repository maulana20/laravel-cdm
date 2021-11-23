<template>
    <div>
        <div v-if="validationErrors">
            <ul class="alert alert-danger">
                <li v-for="(value, key, index) in validationErrors">@{{ value }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        props: [
            'errors'
        ],
        mounted() {
            this.setTiny()
        },
        data: function() {
            return {
            }
        },
        computed: {
            validationErrors: function() {
                let errors = Object.values(JSON.parse(this.errors));
                errors = errors.flat();
                
                return errors;
            }
        }
    }
</script>
