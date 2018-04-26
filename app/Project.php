<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $appends = array(
        'total',
        'balance',
        'userCount',
        'productCount',
        'productItemCount',
        'serviceCount',
        'productSum',
        'serviceSum'
    );

    public function members(){
        return $this->belongsToMany(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function getTotalAttribute(){
        return $this->productSum + $this->serviceSum;
    }

    public function getBalanceAttribute(){
        return $this->total - $this->paid;
    }

    public function getUserCountAttribute(){
        return $this->members->count();
    }

    public function getServiceCountAttribute(){
        return $this->services->count();
    }

    public function getProductCountAttribute(){
        return $this->products->count();
    }

    public function getProductItemCountAttribute(){
        return $this->products->sum('quantity');
    }

    public function getServiceSumAttribute(){
        return $this->services->sum('amount');
    }

    public function getProductSumAttribute(){
        return $this->products->sum(function ($p){
            return $p->quantity * $p->unit_price;
        });
    }
}
