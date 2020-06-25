<?php
namespace App\Models;
use DB;
class DashboardModel
{
    protected $connection;

    /**
     * UserModel constructor.
     */
    function __construct()
    {
        $this->connection =  DB::connection();
    }


    public function getUserInfo($date="")
    {

        $query = $this->connection->table('api_call_history as ach')
            ->select(['u.name',
                $this->connection->raw("count('u.id') as user_count")
            ]);
        $query->join('users as u','u.id','=','ach.user_id');
        if($date!="")
            $query->whereDate('ach.created_at','=',$date);
        $query->groupBy('ach.user_id');
        return $query->get();
    }

}
