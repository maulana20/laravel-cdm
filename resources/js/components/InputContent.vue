<template>
    <div>
        <textarea type="text" class="form-control" id="content" name="content" placeholder="Document Content">{{ content }}</textarea>
    </div>
</template>

<script>
    export default {
        props: [
            'content'
        ],
        mounted() {
            tinymce.init({
                selector: '#content',
            });
        },
        data: function() {
            return {
            }
        }
    }
</script>
