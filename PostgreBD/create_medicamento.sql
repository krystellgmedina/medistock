-- Requiere extensión pgcrypto para gen_random_uuid(); si no la tienes, reemplaza UUID por serial.
CREATE EXTENSION IF NOT EXISTS pgcrypto;

CREATE TABLE IF NOT EXISTS medicamentos (
  id UUID PRIMARY KEY DEFAULT gen_random_uuid(),
  nombre TEXT NOT NULL,
  categoria TEXT NOT NULL,
  cantidad INTEGER NOT NULL CHECK (cantidad >= 0),
  fecha_expiracion DATE NOT NULL,
  created_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now(),
  updated_at TIMESTAMP WITHOUT TIME ZONE DEFAULT now()
);

-- Datos de ejemplo (from Medicamento_export.csv)
INSERT INTO medicamentos (id, nombre, categoria, cantidad, fecha_expiracion, created_at, updated_at) VALUES
('68fc416e2c2203b0fc83392f','Paracetamol 500mg','Analgésicos',250,'2025-08-15','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833930','Amoxicilina 500mg','Antibióticos',150,'2025-06-20','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833931','Ibuprofeno 400mg','Antiinflamatorios',180,'2025-09-10','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833932','Losartán 50mg','Antihipertensivos',120,'2025-07-25','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833933','Loratadina 10mg','Antihistamínicos',200,'2025-10-05','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833934','Vitamina C 1000mg','Vitaminas',300,'2026-01-30','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833935','Omeprazol 20mg','Otros',8,'2024-12-15','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc416e2c2203b0fc833936','Aspirina 100mg','Analgésicos',5,'2024-12-28','2025-10-25T03:18:06.219000','2025-10-25T03:18:06.219000'),
('68fc44942a046e64bd0987a9','ASDASDAS','Suplementos',52,'2025-10-24','2025-10-25T03:31:32.383000','2025-10-25T03:31:32.383000');

-- Índices recomendados para búsqueda/filtrado
CREATE INDEX IF NOT EXISTS idx_medicamentos_nombre ON medicamentos (lower(nombre));
CREATE INDEX IF NOT EXISTS idx_medicamentos_categoria ON medicamentos (categoria);
CREATE INDEX IF NOT EXISTS idx_medicamentos_fecha ON medicamentos (fecha_expiracion);
