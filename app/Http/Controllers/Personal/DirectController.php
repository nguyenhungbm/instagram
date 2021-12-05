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
class DirectController extends Controller
{ 
    //chat private
    public function index(){ 
       
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',Auth::id())
                ->orwhere('friend_id',Auth::id());
        })
                ->get(); 
        $group=GroupUser::where('user_id',Auth::id())->join('groups','groups.id','group_user.group_id')->get();
        $viewData=[ 
            'chat' =>$chat,
            'group' =>$group,
            'title'=>'Message'
        ];
        return view('direct',$viewData);
    }
    public function show($id){  
      $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',Auth::id())
                ->orwhere('friend_id',Auth::id());
        })
                ->get();    
        $friend =User::FindorFail($id);
        $group=GroupUser::where('user_id',Auth::id())->join('groups','groups.id','group_user.group_id')->get();
        $videocall =Chat::where(['user_id' => Auth::id() , 'friend_id' => $id])
                        ->orwhere(['user_id' => $id, 'friend_id' => Auth::id()])
                        ->select('videocall')
                        ->first()
                        ; 
        if(!isset($videocall['videocall'])) 
            $videocall['videocall'] = rand(000000,999999);
        $viewData=[
            'chat'      => $chat,   
            'friend'    => $friend,
            'group'     => $group,
            'videocall'     => $videocall,
            'title'     => 'Chat'
        ];
        return view('direct.chat',$viewData);
    }
    
    public function getChat($id) {
        $chats = Chat::where(function ($query) use ($id) {
            $query->where('user_id', '=', Auth::id())->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', '=', $id)->where('friend_id', '=', Auth::id());
        })->get();
        $friend=User::find($id);
    $data=[
        'chat'      =>$chats,
        'friend'    =>$friend
    ];
        return $data;
    }

    public function sendChat(Request $request) {  
        $repeats =0;
        $room    = rand(000000,999999);
        if(Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->count())
        {
            $repeats    = 1;
            $room       = Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->select('videocall')->first();
        }
        if(Chat::where(['user_id' => $request->friend_id,'friend_id'=> $request->user_id ])->count()) 
        {
            $repeats    = 2;
            $room       = Chat::where(['user_id'=> $request->friend_id, 'friend_id' => $request->user_id])->select('videocall')->first();
        }
        Chat::create([
            'user_id'   => $request->user_id,
            'friend_id' => $request->friend_id,
            'chat'      => $request->chat,
            'videocall' => $room,
            'repeats'   => $repeats
        ]); 
        
        return [];
    }
    public function searchmess(Request $request){ 
        if($request->value==''){
            $chat =Chat::where('user_id',Auth::id())->groupBy('friend_id')->get();
            foreach($chat as $list){
                $list->isChecked = 0;
                if(in_array($list->friend_id,$request->user)){
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
        $val = User::where('id','!=',Auth::id())
                    ->where('c_name','like','%'.$request->value.'%')
                    ->orwhere('user','like','%'.$request->value.'%')->limit(5)->get();
        foreach($val as $list){
            $list->isChecked = 0;
            if(in_array($list->id,$request->user)){
                $list->isChecked = 1;
            }
        }
        $output='';
        if(!$val->isEmpty())
            $output.= view('direct.searchmess',compact('val'))->render();
        else{
            $output= '<p class="pq os">'.__("translate.No result found.").'</p>';
        }
        return $output;
    }
    public function create_chat_group(Request $request){
        if(count($request->user) == 1) 
            return response()->json([
                'group' => url('/direct/'.$request->user[0]['id']),
            ]);
        else{
            $random_number =rand(0000000000,9999999999); 
         
            $group_name ='d'. Auth::user()->c_name.',';
            foreach ($request->user as $list) {
                $group_name .= $list['name'].',';
            }
 
            $group = Group::create(['name' => mb_substr($group_name,1,20).'...',
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
        return redirect()->to();
    }
    
    public function index_chat_group($rooms){ 
        $room_id=Group::where('room',$rooms)->value('id');
        if(!GroupUser::where('group_id',$room_id)->where('user_id',Auth::id())->count()){
            return redirect()->to('direct');
        }
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',Auth::id())
                ->orwhere('friend_id',Auth::id());
        })
                ->get();  
                //lấy thông tin user trong group
        $group=GroupUser::where('user_id',Auth::id())->join('groups','groups.id','group_user.group_id')->get();
        //lấy id group
        $group_room=Group::where('room',$rooms)->first();
        //lấy thông tin đoạn chat
        $conversation =Conversation::where('group_id',$room_id)->get();
        $viewData=[ 
            'chat'              => $chat, 
            'title'             => 'Instagram',
            'group'             => $group,    
            'group_room'        => $group_room,    
            'conversation'      => $conversation, 
            'room'              => $room_id ,  
            'group'             => $group , 
        ];
        return view('direct.group_chat',$viewData);
    } 
    public function getGroupChat($room) {
        // $group_chats = Conversation::where([
        //     'group_id'=>$room
        // ])->join('users','conversations.user_id','users.id')
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
}
