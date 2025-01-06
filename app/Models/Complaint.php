<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Atribut yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'complainer',
        'contact_number',
        'email',
        'system',
        'details',
        'response',
        'image',
        'status',
        'created_by',
        'edited_by',
    ];    

    /**
     * Hubungan ke model User (pengguna yang membuat aduan).
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Hubungan ke model User (pengguna yang mengedit aduan terakhir).
     */
    public function editor()
    {
        return $this->belongsTo(User::class, 'edited_by');
    }
}
