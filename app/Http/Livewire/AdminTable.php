<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Auth;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class AdminTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $role_count = DB::table('role_user')->where('user_id', Auth::guard('admins')->user()->id)->count();
        $admin = Admin::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        $data = [
            'admin' => $admin,
            'role_count' => $role_count
        ];
        return view('livewire.admin-table', $data);
    }
}
