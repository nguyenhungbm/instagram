/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('chat', require('./components/Chat.vue').default);
Vue.component('chat_group', require('./components/ChatGroup.vue').default);
Vue.component('pusher-video-call', require('./components/PusherVideoCall.vue').default);
Vue.component('video-call', require('./components/VideoCall.vue').default);
Vue.component('chat-component', require('./components/ChatComponent.vue').default)
Vue.component('conversation-component', require('./components/ConversationComponent.vue').default)

Vue.component('chat-composer', require('./components/ChatComposer.vue').default);
Vue.component('notification', require('./components/Notification.vue').default);
Vue.component('onlineuser', require('./components/OnlineUser.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import moment from 'moment';
const app = new Vue({
    el: '#app',
    data: {
        notifications:'',
        notification_readed:'',
        chats: '',
        chat_group:'',
        groups: '',
        room:'',
        onlineUsers: ''     
    }, 
    created() {
        const userId = $('meta[name="userId"]').attr('content');
        const friendId = $('meta[name="friendId"]').attr('content');
        const roomId = $('meta[name="roomId"]').attr('content');
        //notification
        axios.post('/notification/get').then(response =>{
            this.notifications =response.data.notification;
            this.notification_readed =response.data.notification_readed;
             
        });
        Echo.private('App.Models.User.' + userId).notification((notification)=>{
            this.notifications.push(notification);
        })
        //chat
        if (friendId != undefined) {
            axios.post('/chat/getChat/' + friendId).then((response) => {
                this.chats = response.data;
            });
 
            Echo.private('Chat.' + friendId + '.' + userId)
                .listen('BroadcastChat', (e) => {
                    this.chats.chat.push(e.chat);
                });
        } 
          

        //chat.group 
                if(roomId != undefined){
            axios.post('/group_chat/getGroupChat/'+roomId).then((response) => {
                this.chat_group = response.data;
            });
            Echo.private('Groups.' + roomId) 
                    .listen('NewMessage', (e) => {
                        this.chat_group.group_chats.push(e.conversation);
                    });
    } 
        //online
        if (userId != 'null') {
            Echo.join('Online')
                .here((users) => {
                    this.onlineUsers = users;
                })
                .joining((user) => {
                    this.onlineUsers.push(user);
                })
                .leaving((user) => {
                    this.onlineUsers = this.onlineUsers.filter((u) => {u != user});
                });
        }
    }
});
Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(value).fromNow()
    }
});