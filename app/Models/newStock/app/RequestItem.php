<?php
namespace App;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class RequestItem extends Model

{
        public $table = 'request';
        protected $fillable = [
            'requested_by',
            'item_id',
            'number_items',
            'status',
            'created_at',
            'updated_at',
        ];
        protected function serializeDate(DateTimeInterface $date)
        {
            return $date->format('Y-m-d H:i:s');
    
        }
    
        public function asset()
        {
            return $this->belongsTo(Asset::class, 'asset_id');
    
        }
    
    }

