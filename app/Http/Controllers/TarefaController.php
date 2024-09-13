<?php

namespace App\Http\Controllers;

use App\Service\TarefaService;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    protected $tarefaService;

    public function __construct(TarefaService $tarefaService)
    {
        $this->tarefaService =  $tarefaService;
    }

    public function index()
    {
        $result = $this->tarefaService->getAll();

        return response()->json($result);
    }

    public function findById($id)
    {
        $result = $this->tarefaService->findById($id);

        return response()->json($result);
    }

    public function store(Request $request)
    {

        $user = $this->tarefaService->create($request->all());

        return response()->json($user);
    }

    public function delete($id)
    {
        $result = $this->tarefaService->delete($id);

        return response()->json($result);
    }

    public function update(Request $request)
    {
        $result = $this->tarefaService->update($request->all());
        return response()->json($result);
    }

    public function updateStatus($id, Request $request)
    {
        $result = $this->tarefaService->alterarStatus($id, $request->all());

        return response()->json($result);
    }
}
