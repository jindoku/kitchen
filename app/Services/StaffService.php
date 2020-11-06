<?php

namespace App\Services;


use App\Bill;
use App\Repositories\StaffRepository;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class StaffService
{
    private $staffRepository;

    public function __construct(StaffRepository $staffRepository)
    {
        $this->staffRepository = $staffRepository;
    }

    public function getStaffs($searchParams = [])
    {
        $query = $this->staffRepository->query();
        $limit = Arr::get($searchParams, 'raw', 10);
        $keyword = Arr::get($searchParams, 'keyword', '');
        $column = Arr::get($searchParams, 'column', 'created_at');
        $order = Arr::get($searchParams, 'order', 'desc');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('fullname', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->paginate($limit);
    }

    //service create data
    public function storeStaff($data)
    {
        $staff = $this->staffRepository->save($data);
        $this->storeUser($staff, $data['password']);
    }

    public function updateStaff($data, $id)
    {
        $this->staffRepository->save($data, $id);
    }

    public function destroyStaff($id)
    {
        $countBillByStaff = Bill::where('staff_id', $id)->count();
        if($countBillByStaff > 0)
            return 'bill';

        $staff = $this->staffRepository->get($id);
        $staff->delete();
        $staff->user->delete();

        return 'success';
    }

    public function storeUser($staff, $password)
    {
        User::create([
            'name' => $staff->code,
            'password' => bcrypt($password),
            'email' => $staff->email,
            'staff_id' => $staff->id
        ]);
    }
}
