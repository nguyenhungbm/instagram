 <template>
 <div>
    <div class="bottom-right position-relative" id="hihi">
        <div  v-for="(group_chat,index) in chat_group.group_chats" :key="index" >
            <div class="my-messages position-relative" v-if="group_chat.user_id == userid">
                <div class="time">{{ group_chat.created_at | formatDate }}</div>  
                    <div class="me-messages"> 
                        <p> {{ group_chat.message }}</p>
                    </div>
                </div> 
            <div class="friend-messages clr position-relative" v-else>
                <div class="time">{{ group_chat.created_at | formatDate }}</div>
                <a :href="'/'+group_chat.user">
                    <img :src="'/uploads/user/'+group_chat.avatar" class="friend-img rounded-circle" v-if="group_chat.avatar.substr(0,4)!='http'">
                    <img :src="group_chat.avatar" class="friend-img rounded-circle" v-if="group_chat.avatar.substr(0,4)=='http'">
                </a> 
                <div class="friend-chat"> 
                    {{group_chat.message }}
                </div>
            </div>
        </div>
        <!-- <img src="/img/typing.gif" style="height:100px"> -->
        <div v-if="chat_group.group_chats.length == 0"  class="no-message">
        Không có tin nhắn
    </div> 
    </div>
    
    <div class="form-chat position-absolute" >
        <img src="/img/happy.png" class="img-1 w-30">
        <textarea class="input" id="myTextarea" placeholder="Nhắn tin..." autofocus  v-on:keyup.enter="sendChat" v-model="chat"></textarea>
        <button  v-on:click="sendChat">Gửi</button>
        <img src="/img/picture.png" class="img-2  ">
        <img src="/img/heart.png" class="img-3 ">
    </div>
    
      </div>
</template>

<script>
    export default {
        props: ['chat_group', 'userid'],
     data() {
            return {
                chat: ''
            }
        },
        methods: {  
            sendChat: function(e) {
                if (this.chat != '') {
                    var data = {
                        message: this.chat,
                        group_id: this.chat_group.room,
                        user_id: this.userid,
                        created_at:new Date().toLocaleString()
                    }
                    this.chat = ''; 
                    axios.post('/group_chat/sendChat',data).then((response) => {
                        this.chat_group.group_chats.push(data);
                    })
                }
            },
        }
    }
</script>
