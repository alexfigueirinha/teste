<?php

namespace App\Service;

use App\Models\Tarefa;

class TarefaService
{
    public function create(array $dados)
    {
        $user = Tarefa::create([
            'titulo' => $dados['titulo'],
            'descricao' => $dados['descricao'],
            'status' => 'Em Aberto'
        ]);

        return $user;
    }

    public function delete($id)
    {
        $tarefa = Tarefa::find($id);

        if ($tarefa == null) {
            return [
                'status' => false,
                'message' => 'Tarefa nao encontrada'
            ];
        }

        $tarefa->delete();

        return [
            'status' => true,
            'message' => 'Tarefa excluida com sucesso'
        ];
    }

    public function findById($id)
    {
        $tarefa = Tarefa::find($id);

        if($tarefa == null){
            return [
                'status' => false,
                'message' => 'Tarefa não encontrada'
            ]; 
        }

        return [ 
            'status' => true, 
            'message' => 'Pesquisa realizada com sucesso', 
            'data' => $tarefa
        ];
    }

    public function getAll()
    {
        $tarefas = Tarefa::all();

        return [
            'status' => true,
            'message' => 'Pesquisa efetuada com sucesso',
            'data' => $tarefas
        ];
    }

    public function alterarStatus($id, array $dados)
    {

        $tarefa = Tarefa::find($id);

        if ($tarefa == null) {
            return [
                'status' => false,
                'message' => 'tarefa nao encontrada'
            ];
        }

        if (!isset($dados['status'])) {
            return [
                'status' => false,
                'message' => 'o campo status é obrigatório'
            ];
        }
        
        $tarefa->status = $dados['status'];

        if($dados['status'] == 'Iniciada'){
            $tarefa->data_inicio = now();
        }

        if($dados['status'] == 'Finalizada' || $dados['status'] == 'Cancelada'){
            $tarefa->data_fim = now();
        }

        $tarefa->update();

        return [
            'status' => true,
            'message' => 'status atualizado com sucesso'
        ];
    }


    public function update(array $dados)
    {
        $tarefa = Tarefa::find($dados['id']);

        if ($tarefa == null) {
            return [
                'status' => false,
                'message' => 'tarefa nao encontrada'
            ];
        }

        if (isset($dados['titulo'])) {
            $tarefa->titulo = $dados['titulo'];
        }

        if (isset($dados['descricao'])) {
            $tarefa->descricao = $dados['descricao'];
        }

        if (isset($dados['status'])) {
            $tarefa->status = $dados['status'];
        }

        if (isset($dados['data_inicio'])) {
            $tarefa->data_inicio = $dados['data_inicio'];
        }

        if (isset($dados['data_fim'])) {
            $tarefa->data_fim = $dados['data_fim'];
        }

        $tarefa->save();

        return [
            'status' => true,
            'message' => 'Atualizado com sucesso'
        ];
    }
}
