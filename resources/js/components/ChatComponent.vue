<template>
    <div class="card">
       <div class="bottom-right position-relative" id="hihi">
            <div v-for="message in messages" v-bind:key="message.id">
            <div class="my-messages position-relative" v-if="message.author === authUser.email">
                <div class="time">{{ message.created_at | formatDate }}</div>  
                    <div class="me-messages"> 
                        <img class="img-mess float-right"  :id="'img'+message.body" @error="hidden('img'+message.body)" :src="message.body" v-if="message.type.includes('image')">
                        <p v-else> {{  message.body }}</p>
                        <audio controls class="float-right" :id="'audio'+message.body" v-if="message.type == 'audio'">
                        <source @error="hidden('audio'+message.body)" :src="message.body" type="audio/mp3">
                        </audio>
                    </div>
                </div> 
            <div class="friend-messages clr position-relative" v-else>
                <div class="time">{{ message.created_at | formatDate }}</div>
                <a :href="'/'+otherUser.user">
                    <img :src="'/uploads/user/'+otherUser.avatar" class="friend-img rounded-circle" v-if="otherUser.avatar.substr(0,4)!='http'">
                    <img :src="otherUser.avatar" class="friend-img rounded-circle" v-if="otherUser.avatar.substr(0,4)=='http'">
                </a> 
                <div class="friend-chat">  
                     <img class="img-mess float-right"  :id="'img'+message.body" @error="hidden('img'+message.body)" :src="message.body" v-if="message.type.includes('image')">
                        <p v-else> {{  message.body }}</p>
                    <audio controls class="float-right" :id="'audio'+message.body" v-if="message.type == 'audio'">
                        <source @error="hidden('audio'+message.body)" :src="message.body" type="audio/mp3">
                    </audio>
                </div>
            </div>
        </div>
        <div v-if="messages.length == 0"  class="no-message">
        Không có tin nhắn
    </div> 
    </div>
        <div class="form-chat position-absolute" >
            <img src="/img/happy.png" class="img-1 w-30">
            <textarea class="input" id="myTextarea" placeholder="Nhắn tin..." autofocus v-on:keyup.enter="sendMessage" v-model="newMessage"></textarea>
            <button v-on:click="sendMessage">Gửi</button>
            <label for="img"><img src="/img/picture.png" class="img-2"></label>
            <label for="audio"><img src="/img/voice.jpg" class="img-3 "></label>
              <input type="file"  id="img" class="d-none" accept="image/*" @change="sendMediaMessage">
              <input type="file"  id="audio" class="d-none" accept="audio/*" @change="sendMediaMessage">
        </div>
    </div>
</template>

<script>
export default {
    name: "ChatComponent",
    props: {
        authUser: {
            type: Object,
            required: true
        },
        otherUser: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            messages: [],
            newMessage: "",
            channel: "",
        };
    },
    async created() { 
        const token = await this.fetchToken();
        await this.initializeClient(token,this.otherUser.room);
        await this.fetchMessages();
    },
    methods: {
        hidden(id){
            document.getElementById(id).classList.add("d-none");
        },
        async fetchToken() {
            const { data } = await axios.post("/api/chat/access_token", {
                email: this.authUser.email
            });
            return data.token;
        }, 
        async initializeClient(token,room) {
            const client = await Twilio.Chat.Client.create(token);
            client.on("tokenAboutToExpire", async () => {
                const token = await this.fetchToken();
                client.updateToken(token);
            });
            this.channel = await client.getChannelByUniqueName(room);
            this.channel.on("messageAdded", message => {
                this.pushToArray(message)
            });
        },
        async fetchMessages() {
            // this.messages = (await this.channel.getMessages()).items;
            const { data } = await axios.get("/twilio/list/chat/"+this.otherUser.room);
             this.messages  = data;
        },
        async sendMessage() {
            this.channel.sendMessage(this.newMessage);
            this.newMessage = "";
        },
        async sendMediaMessage({ target }) {
            const formData = new FormData();
            formData.append('file', target.files[0]);
            this.channel.sendMessage(formData);
            target.value = "";
        },
        async pushToArray (message) {
            if (message.type === 'media') {
                const mediaUrl = await message.media.getContentUrl()
                this.messages.push({
                    type: message.type,
                    author: message.author,
                    body: mediaUrl,
                    mediaUrl
                })
            } else {
                this.messages.push({
                    type: message.type,
                    author: message.author,
                    body: message.body,
                })
            }
        }
    }
};
</script>   