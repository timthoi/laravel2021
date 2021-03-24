<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable {
    use HasFactory, Notifiable, HasApiTokens;
    
    protected $primaryKey = 'id';
    protected $tableName = 'users';
    protected $aliasTableName = 'u';
    
    protected $guarded = [
        'id'
    ];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'password',
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];
    
    
    /**
     * Get detail user
     * @param  array  $selectRaw
     * @param  array  $whereRaw
     *
     * @return array
     */
    public function getUserDetail(array $selectRaw = [],array $whereRaw = []) : array {
        $query = DB::table($this->getTable());
        
        foreach ($selectRaw as $itm) {
            $query->selectRaw($itm['strRaw'], $itm['params']);
        }
        
        foreach ($whereRaw as $itm) {
            $query->whereRaw($itm['strRaw'], $itm['params']);
        }
        
        $dataDetail = $query->first();
        
        // Convert collection object to array
        $dataDetail = collect($dataDetail)->toArray();
     
        return $dataDetail;
    }
    
    /**
     * Get list users
     * @param  array  $selectRaw
     * @param  array  $whereRaw
     *
     * @return array
     */
    public function getListUsers(array $selectRaw = [],array $whereRaw = []) : array {
        $query = DB::table($this->getTable());
        
        foreach ($selectRaw as $itm) {
            $query->selectRaw($itm['strRaw'], $itm['params']);
        }
        
        foreach ($whereRaw as $itm) {
            $query->whereRaw($itm['strRaw'], $itm['params']);
        }
        
        $dataDetail = $query->get();
        
        // Convert collection object to array
        $dataDetail = collect($dataDetail)->toArray();
        
        return $dataDetail;
    }
}