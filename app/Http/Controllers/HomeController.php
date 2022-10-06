<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;
use App\User;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        // $cards = [
        //     [
        //         'title' => 'Data Pendaftaran Pending',
        //         'type' => 'value',
        //         'class' => 'card border-left-warning shadow h-100 py-2',
        //         'icon' => 'fas fa-comments fa-2x text-gray-300',
        //         'value' => School::where('status', '0')->count()
        //     ],
        //     [
        //         'title' => 'Sekolah Terdaftar',
        //         'type' => 'value',
        //         'class' => 'card border-left-primary shadow h-100 py-2',
        //         'icon' => 'fas fa-school fa-2x text-gray-300',
        //         'value' => School::count()
        //     ],

        // ];
        // return response()->json(['cards' => $cards]);
        $cards = [
            [
                'title' => 'Sekolah',
                'type' => 'value',
                'class' => 'card border-left-warning shadow h-100 py-2',
                'styleFont'=> 'text-s font-weight-bold text-warning text-uppercase mb-1',
                'value' => School::where('id','!=','1')->count()
            ],
            [
                'title' => 'All Users',
                'type' => 'value',
                'class' => 'card border-left-primary shadow h-100 py-2',
                'styleFont' => 'text-s font-weight-bold text-primary text-uppercase mb-1',
                'value' => User::where('role','!=',0)->count()
            ],
            [
                'title' => 'User Terverifikasi',
                'type' => 'value',
                'class' => 'card border-left-success shadow h-100 py-2',
                'styleFont' => 'text-s font-weight-bold text-success text-uppercase mb-1',
                'value' => User::where(['status'=>'1','role'=>'1'])->count()
            ],
            [
                'title' => 'User Belum Terverifikasi',
                'type' => 'value',
                'class' => 'card border-left-danger shadow h-100 py-2',
                'styleFont' => 'text-s font-weight-bold text-danger text-uppercase mb-1',
                'value' => User::where(['status'=>'0','role'=>'1'])->count()
            ],
            [
                'title' => 'User Sedang Aktif',
                'type' => 'value',
                'class' => 'card border-left-secondary shadow h-100 py-2',
                'styleFont' => 'text-s font-weight-bold text-success text-uppercase mb-1',
                'value' => User::where([['status_online','=','1'],['role','!=','0']])->count()
            ],
        ];

        return response()
            ->json(['cards' => $cards]);
    }
    public function getChart($model, $column)
    {
        $valueFormat = DB::raw("DATE_FORMAT(" . $column . ", '%d') as value");
        $start = now()->startOfMonth();
        $end = now()->endOfMonth();

        $dates = [];

        $run = $start->copy();

        while ($run->lte($end)) {
            $dates = array_add($dates, $run->copy()->format('d'), 0);
            $run->addDay(1);
        }

        $res = $model->groupBy($column)
            ->select(DB::raw('count(*) as total'), $valueFormat)
            ->pluck('total', 'value');

        $all = $res->toArray() + $dates;

        ksort($all);

        return collect(array_values($all))->map(function ($item) {
            return ['value' => $item];
        });
    }
    public function getUserCountNotVerified(){
        $data = User::where('status','0')->count();
        return response()->json(['data'=>$data]);
    }
}
