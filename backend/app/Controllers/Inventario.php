<?php
namespace App\Controllers;

use App\Models\MedicamentoModel;
use CodeIgniter\RESTful\ResourceController;

class Inventario extends ResourceController
{
    public function index()
    {
        // ...existing code...
        return view('inventario');
    }

    public function list()
    {
        $model = new MedicamentoModel();
        $q = $this->request->getGet('q') ?? null;
        $categoria = $this->request->getGet('categoria') ?? null;
        $expiration = $this->request->getGet('expiration') ?? null;

        $builder = $model->select('*');

        if ($q) {
            $builder->like('lower(nombre)', strtolower($q));
        }
        if ($categoria && $categoria !== 'all') {
            $builder->where('categoria', $categoria);
        }
        if ($expiration && $expiration !== 'all') {
            $today = date('Y-m-d');
            if ($expiration === 'expired') {
                $builder->where('fecha_expiracion <', $today);
            } elseif ($expiration === 'expiring_soon') {
                $builder->where('fecha_expiracion >=', $today)->where('fecha_expiracion <=', date('Y-m-d', strtotime('+30 days')));
            } elseif ($expiration === 'valid') {
                $builder->where('fecha_expiracion >', date('Y-m-d', strtotime('+30 days')));
            }
        }

        $data = $builder->orderBy('created_at', 'DESC')->findAll();
        return $this->respond($data);
    }

    public function create()
    {
        $model = new MedicamentoModel();
        $data = $this->request->getPost();

        // Basic server-side validation
        if (empty($data['nombre']) || empty($data['categoria']) || !isset($data['cantidad']) || empty($data['fecha_expiracion'])) {
            return $this->failValidationErrors('Faltan campos obligatorios');
        }
        $data['cantidad'] = (int)$data['cantidad'];
        if ($data['cantidad'] < 0) {
            return $this->failValidationErrors('Cantidad debe ser >= 0');
        }

        $id = $model->insert($data);
        return $this->respondCreated(['id' => $id]);
    }

    public function update($id = null)
    {
        $model = new MedicamentoModel();
        $data = $this->request->getPost();
        if (!$id) return $this->failNotFound('ID requerido');

        // Minimal validation
        if (isset($data['cantidad'])) {
            $data['cantidad'] = (int)$data['cantidad'];
            if ($data['cantidad'] < 0) return $this->failValidationErrors('Cantidad inválida');
        }

        $model->update($id, $data);
        return $this->respond(['success' => true]);
    }

    public function delete($id = null)
    {
        $model = new MedicamentoModel();
        if (!$id) return $this->failNotFound('ID requerido');
        $model->delete($id);
        return $this->respondDeleted(['success' => true]);
    }

    public function show($id = null)
    {
        $model = new MedicamentoModel();
        if (!$id) {
            return $this->failNotFound('ID requerido');
        }
        $item = $model->find($id);
        if (!$item) {
            return $this->failNotFound('Medicamento no encontrado');
        }
        return $this->respond($item);
    }
}