 <template>
    <div>
    <div class="bottom-right" id="hihi">
        <div  v-for="(chat,index) in chats.chat" :key="index" >
            <div class="my-messages" v-if="chat.user_id == userid">
                <div class="time">{{ chat.created_at | formatDate }}</div>  
                    <div class="me-messages"> 
                      <img :src="chat.chat" v-if="chat.chat.substr(0,4)=='http'" class="float-right"/>
                        <p v-if="chat.chat.substr(0,4)!='http'"> {{ chat.chat }}</p>
                    </div>
            </div>
            <div class="friend-messages clr" v-else>
                <div class="time">{{ chat.created_at | formatDate }}</div>
                
                <a :href="'/'+chats.friend.user">
                <img :src="'/uploads/user/'+chats.friend.avatar" class="friend-img rounded-circle" v-if="chats.friend.avatar.substr(0,4)!='http'">
                <img :src="chats.friend.avatar" class="friend-img rounded-circle" v-if="chats.friend.avatar.substr(0,4)=='http'">
                </a>
                    <div class="friend-chat"  v-if="chat.chat.substr(0,4)=='http'"> 
                         <img :src="chat.chat" />
                    </div>
                     <div class="friend-chat"  v-else> 
                        {{ chat.chat }}
                    </div>
            </div>
        </div>
        <div v-if="chats.chat.length == 0"  class="no-message">
            Không có tin nhắn
        </div> 
        <!-- <img src="/img/typing.gif" style="height:100px"> -->
    </div>
        <chat-composer v-bind:userid="userid" v-bind:chats="chats.chat" v-bind:friendid="friendid"></chat-composer>
    </div>
</template>

<script>
    export default {
        props: ['chats', 'userid', 'friendid']
    }
</script>
