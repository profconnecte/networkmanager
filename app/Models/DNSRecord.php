<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DNSRecord extends Model
{
    protected $table = 'dns_records';
    protected $fillable = ['name', 'response', 'rrtype', 'ttl'];
}
