<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\MsApplication;
use Datatables;

class ApplicationController extends Controller
{
    public function anyData()
    {
        $data = MsApplication::all();

        return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = "";
                    if (auth()->user()->can('update user')) {
                        $btn .= 
                        '<a href="javascript:void(0)" onclick="get_datas(\''.$row->id.'\')" data-toggle="tooltip" data-placement="top" title="Edit User" class="edit btn waves-effect waves-light btn-info">
                            <i class="fa fa-edit"></i>
                        </a> ';
                    }
                    if (auth()->user()->can('delete user')) {                    
                        $btn .= 
                        '<a href="javascript:void(0)" onclick="remove(\''.$row->id.'\')" data-toggle="tooltip" data-placement="top" title="Delete User" class="delete btn waves-effect waves-light btn-danger">
                            <i class="fa fa-trash"></i>
                        </a> ';
                    }

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
    }
}
