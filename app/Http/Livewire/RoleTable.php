<?php

namespace App\Http\Livewire;

use App\Models\Role;
use Auth;
use DB;
use Livewire\Component;
use Livewire\WithPagination;

class RoleTable extends Component
{
    use WithPagination;

    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $role = Role::search($this->search)
            ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);
        $role_count = DB::table('role_user')->where('user_id', Auth::guard('admins')->user()->id)->count();

        $viewData = [
            'role_count' => $role_count,
            'role' => $role,
        ];
        return view('livewire.role-table', $viewData);
    }
}
