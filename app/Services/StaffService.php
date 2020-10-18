<?php

namespace App\Services;


use App\Repositories\StaffRepository;
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
        $column = Arr::get($searchParams, 'column', '');
        $order = Arr::get($searchParams, 'order', '');
        if (!empty($keyword)) {
            $query->where(function ($q) use ($keyword) {
                $q->where('code', 'LIKE', '%' . $keyword . '%');
                $q->orWhere('fullname', 'LIKE', '%' . $keyword . '%');
            });
        }

        if ($order)
            $query->orderBy($column, $order);

        return $query->isNotDelete()->paginate($limit);
    }

    //service create data
    public function storeStaff($data)
    {
        $this->staffRepository->save($data);
    }

    public function updateStaff($data, $id)
    {
        $this->staffRepository->save($data, $id);
    }

    public function destroyStaff($id)
    {
        $staff = $this->staffRepository->get($id);
        $staff->update([
           'deleted_by' => Auth::id(),
           'deleted_at' => Carbon::now()
        ]);
    }
}
