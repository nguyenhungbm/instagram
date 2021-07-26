<template lang="html">
    <div class="is-pulled-right">
        <div v-if="checkUser()"><i  class="fa fa-circle green "></i></div>
        <div v-else><i  class="fa fa-circle red "></i></div>
    </div>
</template>

<script>
    export default {
        props: ['friend', 'onlineusers'],
        methods: {
            checkUser: function() {
                return _.find(this.onlineusers, {id: this.friend.id});
            }
        }
    } 
</script>

<style lang="css">
    .red {
        color: red;
    }
    .green {
        color: rgb(82, 197, 82);
    }
</style>
