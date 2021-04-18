   <template>
   <li class="d-inline-block position-relative noti">
      <a href="javascript:;" class="position-relative">
      <img class="mr-20 rounded-circle w-30 heart" src="/img/heart.png">
      <span class="count-action">{{notifications.length }}</span>
      </a>
      <!-- unseen -->
      <ul class="notification  d-none set-noti-width ">
         <li class="position-relative un-seen"   v-for="(notification,index) in notifications" :key="index">
            <a href="#" v-on:click="MarkAsRead(notification)">
               <div class="noti-img">
               <img :src="'/uploads/user/'+notification.data.user.avatar" class="friend-img rounded-circle" v-if="notification.data.user.avatar.substr(0,4)!='http'">
               <img :src="notification.data.user.avatar" class="friend-img rounded-circle" v-if="notification.data.user.avatar.substr(0,4)=='http'">
              
               </div>
               <div class="noti-content clr" > 
                     <p>{{notification.data.user.c_name}}</p>
                     <span v-if="notification.data.type=='comment'" class="cons">đã bình luận về bài viết của bạn</span>
                     <span v-if="notification.data.type=='like'" class="cons">đã thích về bài viết của bạn</span>
                     <span class="time">{{ notification.created_at | formatDate }}</span>  
                  <!-- <button>Theo doi</button>  -->
               </div>   
            </a>
         </li> 
      <!-- seen --> 
   
          <li class="position-relative"  v-for="(noti,index) in notification_readed" :key="index">
            <a href="#" v-on:click="MarkAsRead(noti)">
               <div class="noti-img">
               <img :src="'/uploads/user/'+noti.data.user.avatar" class="friend-img rounded-circle" v-if="noti.data.user.avatar.substr(0,4)!='http'">
               <img :src="noti.data.user.avatar" class="friend-img rounded-circle" v-if="noti.data.user.avatar.substr(0,4)=='http'">
              
               </div>
               <div class="noti-content clr" > 
                     <p>{{noti.data.user.c_name}}</p>
                     <span v-if="noti.data.type=='comment'" class="cons">đã bình luận về bài viết của bạn</span>
                     <span v-if="noti.data.type=='like'" class="cons">đã thích về bài viết của bạn</span>
                     <span class="time">{{ noti.created_at | formatDate }}</span>  
                  <!-- <button>Theo doi</button>  -->
               </div>   
            </a>
         </li> 
          <li v-if="notifications.length ==0 && notification_readed.length==0">
             <div class="no-action">  Bạn không có hoạt động mới nào </div>
         </li>
      </ul>
   </li>
</template>
<script>
   export default {
      props:['notifications','notification_readed'],
      methods: {
         MarkAsRead:function(notification) {
            var data ={
               id:notification.id
            };
            
            axios.post('/notification/read',data).then(res =>{
               window.location.href ="/p/"+notification.data.post.p_slug;

            })
         }
      },
   }
</script>
