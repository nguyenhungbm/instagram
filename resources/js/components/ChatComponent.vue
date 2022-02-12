<template>
    <div class="card">
       <div class="bottom-right position-relative" id="hihi">
            <div v-for="message in messages" v-bind:key="message.id">
            <div class="my-messages position-relative" v-if="message.author === authUser.email">
                <div class="time">{{ message.created_at | formatDate }}</div>  
                    <div class="me-messages"> 
                        <p> {{  message.body }}</p>
                    </div>
                </div> 
            <div class="friend-messages clr position-relative" v-else>
                <div class="time">{{ message.created_at | formatDate }}</div>
                <a :href="'/'+otherUser.user">
                    <img :src="'/uploads/user/'+otherUser.avatar" class="friend-img rounded-circle" v-if="otherUser.avatar.substr(0,4)!='http'">
                    <img :src="otherUser.avatar" class="friend-img rounded-circle" v-if="otherUser.avatar.substr(0,4)=='http'">
                </a> 
                <span class="os ">{{otherUser.c_name}}</span>
                <div class="friend-chat">  
                    {{ message.body }}
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
            <img src="/img/picture.png" class="img-2  ">
            <img src="/img/heart.png" class="img-3 ">
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
        },
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
        async fetchToken() {
            const { data } = await axios.post("/api/chat/access_token", {
                email: this.authUser.email
            });
            return data.token;
        },
        async fetchRoom() {
            const { data } = await axios.post("/api/chat/room", {
                user : this.authUser.id,
                other: this.otherUser.id
            });
            return data;
        },
        async initializeClient(token,room) {
            const client = await Twilio.Chat.Client.create(token);
            client.on("tokenAboutToExpire", async () => {
                const token = await this.fetchToken();
                client.updateToken(token);
            });
            this.channel = await client.getChannelByUniqueName(room);
            this.channel.on("messageAdded", message => {
                console.log("messageAdded +"+message);
                this.messages.push(message);
            });
        },
        async fetchMessages() {
            this.messages = (await this.channel.getMessages()).items;
        },
        sendMessage() {
            this.channel.sendMessage(this.newMessage);
            this.newMessage = "";
        }
    }
};
</script>
