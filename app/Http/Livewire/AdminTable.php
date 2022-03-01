<?php
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Admin;
use DB;
class AdminTable extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perPage = 10;
    public $search = '';
    public $orderBy = 'id';
    public $orderAsc = true;
    public function render()
    {
        $role_count=DB::table('role_user')->where('user_id',\Auth::guard('admins')->user()->id)->count();
        $admin=Admin::search($this->search) 
                ->orderBy($this->orderBy, $this->orderAsc ? 'asc' : 'desc')
                ->paginate($this->perPage);
        $data = [
            'admin'  => $admin,
            'role_count' => $role_count 
        ];
        return view('livewire.admin-table', $data);
    }   
}
