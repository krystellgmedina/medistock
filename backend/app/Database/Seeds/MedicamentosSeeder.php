<?php
namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MedicamentosSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['id' => '68fc416e2c2203b0fc83392f','nombre'=>'Paracetamol 500mg','categoria'=>'Analgésicos','cantidad'=>250,'fecha_expiracion'=>'2025-08-15','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833930','nombre'=>'Amoxicilina 500mg','categoria'=>'Antibióticos','cantidad'=>150,'fecha_expiracion'=>'2025-06-20','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833931','nombre'=>'Ibuprofeno 400mg','categoria'=>'Antiinflamatorios','cantidad'=>180,'fecha_expiracion'=>'2025-09-10','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833932','nombre'=>'Losartán 50mg','categoria'=>'Antihipertensivos','cantidad'=>120,'fecha_expiracion'=>'2025-07-25','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833933','nombre'=>'Loratadina 10mg','categoria'=>'Antihistamínicos','cantidad'=>200,'fecha_expiracion'=>'2025-10-05','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833934','nombre'=>'Vitamina C 1000mg','categoria'=>'Vitaminas','cantidad'=>300,'fecha_expiracion'=>'2026-01-30','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833935','nombre'=>'Omeprazol 20mg','categoria'=>'Otros','cantidad'=>8,'fecha_expiracion'=>'2024-12-15','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc416e2c2203b0fc833936','nombre'=>'Aspirina 100mg','categoria'=>'Analgésicos','cantidad'=>5,'fecha_expiracion'=>'2024-12-28','created_at'=>'2025-10-25 03:18:06','updated_at'=>'2025-10-25 03:18:06'],
            ['id' => '68fc44942a046e64bd0987a9','nombre'=>'ASDASDAS','categoria'=>'Suplementos','cantidad'=>52,'fecha_expiracion'=>'2025-10-24','created_at'=>'2025-10-25 03:31:32','updated_at'=>'2025-10-25 03:31:32'],
        ];

        $this->db->table('medicamentos')->insertBatch($data);
    }
}
