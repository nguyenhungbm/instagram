<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\VideoChat;
use App\Models\Conversation;
use Illuminate\Support\Str;
use App\Events\NewMessage;
use App\Models\User;
use App\Events\GroupCreated;
use Auth;
use Storage;
class DirectController extends Controller
{ 
    //https://pusher.com/tutorials/photo-feed-laravel/#configuration 
    //https://dev.to/mupati/adding-video-chat-to-your-laravel-app-5ak7
    //index chat 
    public function index(){ 
        $chat =Chat::where('repeats',0)->where(function($user){
                $user->where('user_id',Auth::id())
                     ->orwhere('friend_id',Auth::id());
        })->get(); 
        $group=GroupUser::where('user_id',Auth::id())->join('groups', 'groups.id', 'group_user.group_id')->get();
        $viewData=[ 
            'chat' =>$chat,
            'group' =>$group,
            'title'=>'Message'
        ];
        return view('direct', $viewData);
    }

    //show detail chat
    public function show($id){  
      $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',Auth::id())
                 ->orwhere('friend_id',Auth::id());
        })->get();    
        $friend = User::FindorFail($id);
        $group = GroupUser::where('user_id',Auth::id())->join('groups', 'groups.id', 'group_user.group_id')->get();
        $viewData = [
            'chat'      => $chat,   
            'friend'    => $friend,
            'group'     => $group,
            'title'     => 'Chat'
        ];
        return view('direct.chat', $viewData);
    }
    
    //API get list chat
    public function getChat($id) {
        $chats = Chat::where(function ($query) use ($id) {
            $query->where('user_id', '=', Auth::id())->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', '=', $id)->where('friend_id', '=', Auth::id());
        })->get();
        $friend=User::find($id);
        $data = [
            'chat'      =>$chats,
            'friend'    =>$friend
        ];
        return $data;
    }

    //API send chat
    public function sendChat(Request $request) {  
        $repeats =0;
        if(Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->count())
            $repeats    = 1;
        if(Chat::where(['user_id' => $request->friend_id, 'friend_id'=> $request->user_id ])->count()) 
            $repeats    = 2;
        Chat::create([
            'user_id'   => $request->user_id,
            'friend_id' => $request->friend_id,
            'chat'      => $request->chat,
            'type'      => $request->type,
            'repeats'   => $repeats
        ]); 
        return 200;
    }

    //Upload File chat
    public function uploadFile(Request $request){ 
        if ($request->hasFile('chat')) 
           $file = upload_image('chat', 'chat/' . $request->type);
        $repeats =0;
        if(Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->count())
            $repeats    = 1;
        if(Chat::where(['user_id' => $request->friend_id, 'friend_id'=> $request->user_id ])->count()) 
            $repeats    = 2; 
        $chat = Chat::create([
            'user_id'   => Auth::id(),
            'friend_id' => $request->friend_id,
            'chat'      => pare_url_file($file['name'], 'chat/' . $request->type),
            'type'      => $request->type,
            'repeats'   => $repeats
        ]);
        return $chat ;
    }
    
    //Search user in chat list
    public function searchmess(Request $request){ 
        if($request->value==''){
            $chat =Chat::where('user_id',Auth::id())->groupBy('friend_id')->get();
            foreach($chat as $list){ 
                $list->isChecked = 0;
                if(in_array($list->friend_id, $request->user)){
                    $list->isChecked = 1;
                }
            }
            $output='';
            if(!$chat->isEmpty())
                $output.= view('direct.searchmess',compact('chat'))->render();
            else{
                $output= '';
            }
         return $output;
        }
        $val = User::where('id', '!=',Auth::id())
                    ->where('c_name', 'like', '%'.$request->value.'%')
                    ->orwhere('user', 'like', '%'.$request->value.'%')->limit(5)->get();
        // foreach($val as $list){
        //     $list->isChecked = 0;
        //     if(in_array($list->id, $request->user)){
        //         $list->isChecked = 1;
        //     }
        // }
        $output='';
        if(!$val->isEmpty())
            $output.= view('direct.searchmess',compact('val'))->render();
        else{
            $output= '<p class="pq os">'.__("translate.No result found.").'</p>';
        }
        return $output;
    }

    //Create group chat
    public function create_chat_group(Request $request){
        if(count($request->user) == 1) 
            return response()->json([
                'group' => url('/direct/'.$request->user[0]['id']),
            ]);
        else{
            $random_number =rand(0000000000,9999999999); 
            $group_name ='d'. Auth::user()->c_name.', ';
            foreach ($request->user as $list) 
                $group_name .= $list['name'].', ';
            $group = Group::create([    'name' => mb_substr($group_name,1,20).'...',
                                        'room' => $random_number
                                    ]);
            $group_user= GroupUser::create([
                'group_id' => $group->id,
                'user_id'  => Auth::id()
            ]);
            foreach ($request->user as $list) {
                $group_user= GroupUser::create([
                    'group_id' => $group->id,
                    'user_id'  => $list['id']
                ]);
            }
        }
        $viewData=[
            'title' =>'Group Chat'
        ];
        return response()->json([
            'group' => url('/direct/t/'.$group->room),
        ]);
    }
    
    //View chat group
    public function index_chat_group($rooms){ 
        $room_id=Group::where('room', $rooms)->value('id');
        if(!GroupUser::where('group_id', $room_id)->where('user_id',Auth::id())->count())
            return redirect()->to('direct');
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',Auth::id())
                ->orwhere('friend_id',Auth::id());
        })->get();  
        //lấy thông tin user trong group
        $group=GroupUser::where('user_id',Auth::id())->join('groups', 'groups.id', 'group_user.group_id')->get();
        //lấy id group
        $group_room=Group::where('room', $rooms)->first();
        //lấy thông tin đoạn chat
        $conversation =Conversation::where('group_id', $room_id)->get();
        $viewData=[ 
            'chat'              => $chat, 
            'title'             => 'Instagram',
            'group'             => $group,    
            'group_room'        => $group_room,    
            'conversation'      => $conversation, 
            'room'              => $room_id ,  
            'group'             => $group , 
        ];
        return view('direct.group_chat', $viewData);
    } 

    //API get list chat group
    public function getGroupChat($room) {
        // $group_chats = Conversation::where([
        //     'group_id'=>$room
        // ])->join('users', 'conversations.user_id', 'users.id')
        // ->get();
        $group_chats = Conversation::where([
            'group_id'=>$room
        ]) 
        ->get();
        foreach($group_chats as $list){
            $list->c_name = User::find($list->user_id)->c_name;
            $list->user = User::find($list->user_id)->user;
        }
        $data=[
            'group_chats'   => $group_chats,
            'room'     => $room
        ];
        return $data;
    }

    //API send chat in group
    public function sendGroupChat(Request $request) { 
        $conversation = Conversation::create([
            'user_id'  => $request->user_id,
            'group_id' => $request->group_id,
            'message'  => $request->message,  
            'avatar'   => Auth::user()->avatar,  
        ]);
        broadcast(new NewMessage($conversation))->toOthers();

        return [];
    }

    public function video(Request $request){
        $users = User::where('id','<','3')->get();
        foreach($users as $list){
            $list->name = $list->c_name;
        }
        $viewData = [
            'users' => $users
        ];
        return view('direct.video', $viewData);
    }
    //call user 
    public function callUser(Request $request){
        $data['userToCall'] = $request->user_to_call;
        $data['signalData'] = $request->signal_data;
        $data['from'] = Auth::id();
        $data['type'] = 'incomingCall';

        broadcast(new StartVideoChat($data))->toOthers();
    }

    //accept call
    public function acceptCall(Request $request){
        $data['signal'] = $request->signal;
        $data['to'] = $request->to;
        $data['type'] = 'callAccepted';
        broadcast(new StartVideoChat($data))->toOthers();
    }
}
