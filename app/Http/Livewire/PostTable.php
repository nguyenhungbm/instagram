<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $post = Post::join('users', 'posts.p_user', 'users.id')
            ->select('posts.*', 'users.user', 'users.c_name')
            ->where('p_type', 'profile')->paginate(15);

        return view('livewire.post-table', [
            'post' => $post,
        ]);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
        }
    }
}
