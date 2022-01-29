<template lang="html"> 
     <div class="form-chat position-absolute" >
        <img src="/img/happy.png" class="img-1 w-30">
        <textarea class="input" id="myTextarea" placeholder="Nhắn tin..." autofocus  v-on:keyup.enter="sendChat" v-model="chat"></textarea>
        <button  v-on:click="sendChat">Gửi</button>
        <label for="image"><img src="/img/picture.png" class="img-2"></label>
        <input ref="photo" type="file" class="d-none" id="image" name="photo" @change="update">
        <img src="/img/heart.png" class="img-3 ">
    </div>
</template>

<script>
    export default {
        props: ['chats', 'userid', 'friendid'],
        data() {
            return {
                chat: '',
                photos: []
            }
        },
         mounted() {
            this.getPhotos();
            this.listen();
        },
        methods: {  
            sendChat: function(e) {
                if (this.chat != '') {
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        user_id: this.userid,
                        created_at:new Date().toLocaleString()
                    }
                    this.chat = ''; 
                    axios.post('/chat/sendChat',data).then((response) => {
                        this.chats.push(data)
                    })
                }
            },
            update: function(e) {
                e.preventDefault();
                const data = new FormData();
                data.append('photo', this.$refs.photo.files[0]);
                console.log(data);
                axios.post('/upload/photo/'+this.friendid, data)
                    .then(response => this.photos.unshift(response.data));
            },
            getPhotos() {
                axios.get('/photos').then(response => this.photos = response.data);
            },
            listen() {
                Echo.private('photos')
                    .listen('NewPhoto', (e) => this.photos.unshift(e.photo));
            }
        }
    }
</script>
