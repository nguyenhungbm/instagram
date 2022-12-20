<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $user = User::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        return view('livewire.user-table', [
            'title' => 'Người dùng',
            'user' => $user
        ]);
    }

    public function block_user($id)
    {
        $user = User::find($id);
        if ($user->is_active == 1) {
            $user->is_active = 2;
        } else {
            if ($user->is_active == 2) {
                $user->is_active = 1;
            }
        }
        $user->save();
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
    }
}
