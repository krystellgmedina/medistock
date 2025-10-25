<?php
namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Create_medicamentos extends Migration
{
    public function up()
    {
        // Asegura extensión para gen_random_uuid()
        $this->db->query('CREATE EXTENSION IF NOT EXISTS pgcrypto;');

        // Crear tabla con UUID default gen_random_uuid()
        $sql = "
        CREATE TABLE IF NOT EXISTS medicamentos (
          id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
          nombre TEXT NOT NULL,
          categoria TEXT NOT NULL,
          cantidad INTEGER NOT NULL CHECK (cantidad >= 0),
          fecha_expiracion DATE NOT NULL,
          created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now(),
          updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now()
        );";
        $this->db->query($sql);

        // Índices
        $this->db->query("CREATE INDEX IF NOT EXISTS idx_medicamentos_nombre ON medicamentos (lower(nombre));");
        $this->db->query("CREATE INDEX IF NOT EXISTS idx_medicamentos_categoria ON medicamentos (categoria);");
        $this->db->query("CREATE INDEX IF NOT EXISTS idx_medicamentos_fecha ON medicamentos (fecha_expiracion);");
    }

    public function down()
    {
        $this->forge->dropTable('medicamentos', true);
        // Nota: no eliminamos la extensión pgcrypto para no afectar otras tablas
    }
}
