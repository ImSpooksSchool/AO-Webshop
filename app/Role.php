<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model {
    protected $guarded = [];

    public function getName(): string {
        return $this->name;
    }

    public function getId(): string {
        return $this->id;
    }
}
