<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\Chat;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\Conversation;
use Illuminate\Support\Str;
use App\Events\NewMessage;
use App\Models\User;
use App\Events\GroupCreated;
class DirectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //chat private
    public function index(){ 
       
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',\Auth::id())
                ->orwhere('friend_id',\Auth::id());
        })
                ->get(); 
        $group=GroupUser::where('user_id',\Auth::id())->join('groups','groups.id','group_user.group_id')->get();
        $viewData=[ 
            'chat' =>$chat,
            'group' =>$group,
            'title'=>'Message'
        ];
        return view('direct',$viewData);
    }
    public function show($id){ 
      $chat =Chat:: where('repeats',0)->where(function($user){
            $user ->where('user_id',\Auth::id())
                ->orwhere('friend_id',\Auth::id());
        })
                ->get();    
        $friend =User::FindorFail($id);
        $group=GroupUser::where('user_id',\Auth::id())->join('groups','groups.id','group_user.group_id')->get();

        $viewData=[
            'chat'      => $chat,   
            'friend'    => $friend,
            'group'     =>$group,
            'title'     => 'Chat'
        ];
        return view('direct.chat',$viewData);
    }
    
    public function getChat($id) {
        $chats = Chat::where(function ($query) use ($id) {
            $query->where('user_id', '=', \Auth::user()->id)->where('friend_id', '=', $id);
        })->orWhere(function ($query) use ($id) {
            $query->where('user_id', '=', $id)->where('friend_id', '=', \Auth::user()->id);
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
        if(Chat::where(['user_id'=> $request->user_id, 'friend_id' => $request->friend_id])->count()) $repeats=1;
        if(Chat::where(['user_id' => $request->friend_id,'friend_id'=> $request->user_id ])->count()) $repeats=2;
        Chat::create([
            'user_id'   => $request->user_id,
            'friend_id' => $request->friend_id,
            'chat'      => $request->chat,
            'repeats'   =>$repeats
        ]); 
        
        return [];
    }
    public function searchmess(Request $request){ 
        if($request->value==''){
            $chat =Chat::where('user_id',\Auth::id())->groupBy('friend_id')->get();
            $output='';
            if(!$chat->isEmpty())
                $output.= view('direct.searchmess',compact('chat'))->render();
            else{
                $output= '';
            }
         return $output;
        }
        $val = User::where('id','!=',\Auth::id())
                    ->where('c_name','like','%'.$request->value.'%')
                    ->orwhere('user','like','%'.$request->value.'%')->limit(5)->get();
        $output='';
        if(!$val->isEmpty())
            $output.= view('direct.searchmess',compact('val'))->render();
        else{
            $output= '<p class="pq os">'.__("translate.No result found.").'</p>';
        }
        return $output;
    }
    public function create_chat_group(Request $request){
        if(!str_contains($request->user,',')) 
            return redirect()->to('/direct/'.$request->user);
        else{
            $random_number =rand(0000000000,9999999999); 
            $arr=explode(',',$request->user);
            $group_name='';
            foreach($arr as $item){
                $group_name.=','.User::where('id',$item)->value('user');
            }
            $group = Group::create(['name' => mb_substr($group_name,1,20).'...',
                                    'room' => $random_number
                                    ]);
            foreach($arr as $list){
                if($list !=','){
                $group_user= GroupUser::create([
                        'group_id' => $group->id,
                        'user_id'  => $list
                    ]);
                }
            }
        }
    $viewData=[
        'title' =>'Group Chat'
    ];
        return redirect()->to('/direct/t/'.$group->room);
    }
    public function video(){
        return view('direct.videocall');
    }
    public function index_chat_group($rooms){ 
        $room_id=Group::where('room',$rooms)->value('id');
        if(!GroupUser::where('group_id',$room_id)->where('user_id',\Auth::id())->count()){
            return redirect()->to('direct');
        }
        $chat =Chat::where('repeats',0)->where(function($user){
            $user->where('user_id',\Auth::id())
                ->orwhere('friend_id',\Auth::id());
        })
                ->get();  
                //lấy thông tin user trong group
        $group=GroupUser::where('user_id',\Auth::id())->join('groups','groups.id','group_user.group_id')->get();
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
    $data=[
        'group_chats'   => $group_chats,
        'room'     => $room
    ];
        return $data;
    }
    public function sendGroupChat(Request $request) { 
        $users=User::find($request->user_id);
        $conversation=Conversation::create([
            'user_id'  => $request->user_id,
            'group_id' => $request->group_id,
            'message'  => $request->message,
            'user'     => $users->user,
            'avatar'   => $users->avatar,
            'c_name'   => $users->c_name,
        ]);
        broadcast(new NewMessage($conversation))->toOthers();

        return [];
    }
}
