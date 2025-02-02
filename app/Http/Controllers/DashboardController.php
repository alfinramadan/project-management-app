<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\Finance;
use App\Models\Project;
use App\Models\Developers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
 public function index()
 {


    

    $taskfinish = 0;
    $totaltasks = 0;
    
// pengkondisian jika ada project di table project
if(Project::count() != 0){
    //pencarian project yang tidak selesai
    $searchunfinishedproject = Project::where('status', '=' , 0)->get(['id']);
    // pengkondisian jika hasil pencarian project yang tidak selesai itu tidak 0 atau kosong 
if (Project::where('status', '=' , 0)->count() != 0){
    // looping pencarian semua tasks dari project yang belum selesai
    foreach($searchunfinishedproject as $a){
        $id_p = $a['id'];
        // pengkondisisan pencarian jika taks yag dimiliki project
        if(Tasks::where('project_id', '=', $id_p)->count() != 0){
        // dibawah yaitu logic untuk menghitung task 
        $countedrowfinished = Tasks::where('project_id', '=', $id_p)->where('task_status', '=' , 1)->count();
        $countedtotaltasks = Tasks::where('id', '=', $id_p)->count(); // mencari total task berdasarkan id tertentu

        //penambahan jumlah ke variable master dari hasil looping
        $taskfinish += $countedrowfinished;
        $totaltasks += $countedtotaltasks;
        }
    
    
    //var_dump( $taskfinish);
    //var_dump( $totaltasks);
    // untuk menghindari devision by zero error
    if($taskfinish != 0 && $totaltasks != 0){
    // diabwah adalah logic rumus mencari presentase
    $substasks = $taskfinish / $totaltasks * 100;
    } else {
        $substasks = 0;
    }
} // I know this is stupid and fucking retarded but i dont have choice bcus i have to chase deadline
 } else {
    $substasks = 0;
 }
} else {
    $substasks = 0;
 }



    return view('Dashboard.Dashboard',[
        "title" => "Dashboard",
        "project" => Project::all(),
        "totalprojects" => Project::count(),
        "developers" => Developers::count(),
        "finances" => Finance::all(),
        "tasks" => $substasks
        
         

    ]);
 }
}
