<template lang="html"> 
     <div class="form-chat position-absolute" >
        <img src="/img/happy.png" class="img-1 w-30">
        <textarea class="input" id="myTextarea" placeholder="Nhắn tin..." autofocus  v-on:keyup.enter="sendChat" v-model="chat"></textarea>
        <button  v-on:click="sendChat">Gửi</button>
        <label for="image"><img src="/img/picture.png" class="img-2"></label>
        <label for="audio"><img src="/img/voice.jpg" class="img-3 "></label>
        <input ref="photo" type="file" class="d-none" id="image" name="photo" @change="update('image')"  accept="image/*">
        <input ref="audio" type="file"  id="audio" class="d-none" accept="audio/*" @change="update('audio')">
    </div>
</template>

<script>
    export default {
        props: ['chats', 'userid', 'friendid'],
        data() {
            return {
                chat: '',
            }
        },
         
        methods: {  
            sendChat: function(e) {
                if (this.chat != '') {
                    var data = {
                        chat: this.chat,
                        friend_id: this.friendid,
                        type : 'text',
                        user_id: this.userid,
                        created_at: new Date().toLocaleString()
                    }
                    this.chat = ''; 
                    axios.post('/chat/sendChat',data).then((response) => {
                        this.chats.push(data)
                    })
                }
            },
            update: function(type) {
                const data = new FormData();
                if(type == 'image')
                    data.append('chat', this.$refs.photo.files[0]);
                if(type == 'audio')
                    data.append('chat', this.$refs.audio.files[0]);
                data.append('friend_id', this.friendid);
                data.append('user_id', this.userid);
                data.append('type', type);
                data.append('created_at', new Date().toLocaleString());
                axios.post('/chat/sendFile', data)
                    .then(response => this.chats.push(response.data));
            },
        }
    }
</script>
