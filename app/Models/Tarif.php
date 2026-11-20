<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Tarif extends Model {
    protected $table = 'tb_tarif';
    protected $primaryKey = 'id_tarif';
    protected $fillable = ['jenis_kendaraan', 'tarif_tetap'];
    public function transaksi() { return $this->hasMany(Transaksi::class, 'id_tarif', 'id_tarif'); }
    public function getRouteKeyName(): string { return 'id_tarif'; }
}
