<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CriativoRequest;
use App\Models\Anuncio;
use App\Models\Criativo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class CriativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $anuncioId = $request->input('anuncio_id');

        if ($anuncioId) {
            $anuncio = Anuncio::findOrFail($anuncioId);
            $criativos = $anuncio->criativos()->paginate(10);
            return view('admin.criativos.index', compact('criativos', 'anuncio'));
        }

        return redirect()->route('admin.anuncios.index')
            ->with('error', 'É necessário selecionar um anúncio!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $anuncioId = $request->input('anuncio_id');

        // Buscar todos os anúncios para o seletor
        $anuncios = Anuncio::orderBy('titulo')->get();

        // Debug para diagnóstico
        \Illuminate\Support\Facades\Log::debug('CriativoController:create', [
            'anuncio_id' => $anuncioId,
            'request_all' => $request->all()
        ]);

        if (!empty($anuncios)) {
            // Se existir anúncio_id na requisição, busque o anúncio específico
            if ($anuncioId) {
                $anuncio = Anuncio::findOrFail($anuncioId);
                return view('admin.criativos.create', compact('anuncios', 'anuncio', 'anuncioId'));
            }

            // Caso contrário, apenas exiba o formulário com todos os anúncios
            return view('admin.criativos.create', compact('anuncios'));
        }

        // Se não existirem anúncios, redirecione para criar um anúncio primeiro
        return redirect()->route('admin.anuncios.create')
            ->with('error', 'É necessário criar um anúncio antes de adicionar criativos!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CriativoRequest $request)
    {
        $dados = $request->validated();

        // Gerar título automaticamente como "Criativo N"
        if (!isset($dados['titulo']) || empty($dados['titulo'])) {
            // Buscar o anúncio
            $anuncio = Anuncio::findOrFail($dados['anuncio_id']);
            
            // Contar quantos criativos este anúncio já possui
            $contador = $anuncio->criativos()->count();
            
            // Gerar o próximo número (contador + 1)
            $proximoNumero = $contador + 1;
            
            // Definir o título automático
            $dados['titulo'] = "Criativo " . $proximoNumero;
        }

        // Garantir que o campo language seja preenchido com o idioma, caso não esteja definido
        if (empty($dados['language']) && !empty($dados['idioma'])) {
            $dados['language'] = $dados['idioma'];
        }

        // Garantir que value tenha um valor padrão (0) caso não tenha sido informado
        if (!isset($dados['value'])) {
            $dados['value'] = '0';
        }

        // Tratar upload de imagem
        if ($request->hasFile('image')) {
            // Salvar arquivo diretamente na pasta storage/criativos
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            // Adicionar timestamp ao nome do arquivo para evitar cache
            $timestamp = time();
            $uniqueFileName = $timestamp . '_' . $fileName;
            $file->move(storage_path('criativos'), $uniqueFileName);
            $dados['image'] = 'criativos/' . $uniqueFileName;

            // Log de debug para verificar o caminho da imagem
            \Illuminate\Support\Facades\Log::debug('Imagem processada no store do criativo', [
                'caminho_salvo' => $dados['image'],
                'caminho_completo' => storage_path('criativos/') . $uniqueFileName,
                'url_public' => route('storage.direct', ['path' => $dados['image']])
            ]);
        }

        // Criar o criativo
        $criativo = Criativo::create($dados);

        // Verificar se o usuário deseja continuar adicionando criativos
        if ($request->has('continuar_adicionando') && $request->continuar_adicionando) {
            return redirect()->route('admin.criativos.create', ['anuncio_id' => $dados['anuncio_id']])
                ->with('success', 'Criativo criado com sucesso! Você pode adicionar outro criativo agora.');
        }

        // Redirecionar para a edição do anúncio com os criativos
        return redirect()->route('admin.anuncios.edit', $criativo->anuncio_id)
            ->with('success', 'Criativo adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $criativo = Criativo::with('anuncio')->findOrFail($id);
        return view('admin.criativos.show', compact('criativo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $criativo = Criativo::with('anuncio')->findOrFail($id);
        return view('admin.criativos.edit', compact('criativo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CriativoRequest $request, string $id)
    {
        $criativo = Criativo::findOrFail($id);
        $dados = $request->validated();

        // Garantir que o campo language seja preenchido com o idioma, caso não esteja definido
        if (empty($dados['language']) && !empty($dados['idioma'])) {
            $dados['language'] = $dados['idioma'];
        }

        // Se o número de criativos (value) foi alterado, atualiza o status de performance
        if (isset($dados['value']) && $dados['value'] != $criativo->value) {
            // Garantir que o value seja tratado como número
            $dados['value'] = (int)$dados['value'];
            
            // Conta o número de novos criativos nos últimos 7 dias
            $novosCriativos = Criativo::countNovosCriativos($criativo->anuncio_id);

            // Calcula o novo status de performance
            $dados['performance_status'] = (string)$criativo->calculatePerformanceStatus($dados['value'], $novosCriativos);

            // Atualiza a data da última mudança de status
            $dados['last_status_change'] = now();

            // Log da mudança de status
            \Illuminate\Support\Facades\Log::info('Status de performance atualizado', [
                'criativo_id' => $criativo->id,
                'status_anterior' => $criativo->performance_status,
                'novo_status' => $dados['performance_status'],
                'total_criativos' => $dados['value'],
                'novos_criativos' => $novosCriativos
            ]);
        }

        // Se o status foi alterado, atualiza o status de performance
        if (isset($dados['status']) && $dados['status'] != $criativo->status) {
            // Garantir que o status seja corretamente tratado como string
            $dados['status'] = (string)$dados['status'];
            
            // Calcula o novo status de performance com base no novo status
            $tempCriativo = clone $criativo;
            $tempCriativo->status = $dados['status'];
            $dados['performance_status'] = (string)$tempCriativo->calculatePerformanceStatus(
                $dados['value'] ?? $criativo->value,
                Criativo::countNovosCriativos($criativo->anuncio_id)
            );

            // Atualiza a data da última mudança de status
            $dados['last_status_change'] = now();

            // Log da mudança de status
            \Illuminate\Support\Facades\Log::info('Status de criativo alterado', [
                'criativo_id' => $criativo->id,
                'status_anterior' => $criativo->status,
                'novo_status' => $dados['status'],
                'performance_status' => $dados['performance_status']
            ]);
        }

        // Tratar upload de imagem
        if ($request->hasFile('image')) {
            // Remover imagem anterior se existir
            if ($criativo->image) {
                Storage::disk('public')->delete($criativo->image);
            }

            // Salvar arquivo diretamente na pasta storage/criativos
            $file = $request->file('image');
            $fileName = $file->getClientOriginalName();
            // Adicionar timestamp ao nome do arquivo para evitar cache
            $timestamp = time();
            $uniqueFileName = $timestamp . '_' . $fileName;
            $file->move(storage_path('criativos'), $uniqueFileName);
            $dados['image'] = 'criativos/' . $uniqueFileName;

            // Log de debug para verificar o caminho da imagem
            \Illuminate\Support\Facades\Log::debug('Imagem processada no update do criativo', [
                'caminho_salvo' => $dados['image'],
                'caminho_completo' => storage_path('criativos/') . $uniqueFileName,
                'url_public' => route('storage.direct', ['path' => $dados['image']])
            ]);
        }

        // Garantir que os valores sejam do tipo correto antes de atualizar
        if (isset($dados['status'])) {
            $status = $dados['status'];
            $performanceStatus = 'Ativo';
            if ($status == 'inativo') {
                $performanceStatus = 'Inativo';
            }
            
            try {
                // Atualizar o status e performance_status
                $criativo->status = $status;
                $criativo->performance_status = $performanceStatus;
                $criativo->last_status_change = now();
                
                // Atualizar valor se fornecido
                if (isset($dados['value'])) {
                    $criativo->value = (int)$dados['value'];
                }
                
                // Salvar as alterações
                $criativo->save();
                
                // Registrar a atualização em log
                \Illuminate\Support\Facades\Log::info('Criativo atualizado', [
                    'id' => $criativo->id,
                    'status' => $status,
                    'performance_status' => $performanceStatus
                ]);
                
                // Chamar função que atualiza o número de anúncios no anúncio associado
                if ($criativo->anuncio) {
                    $criativo->anuncio->atualizaNumeroAnuncios();
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Erro ao atualizar criativo: ' . $e->getMessage(), [
                    'id' => $criativo->id,
                    'status' => $status,
                    'performance_status' => $performanceStatus,
                    'exception' => $e
                ]);
                
                throw $e;
            }
        } else {
            // Se não envolve alteração de status, proceder com update normal
            $criativo->update($dados);
        }

        // Redirecionar para a edição do anúncio com os criativos
        return redirect()->route('admin.anuncios.edit', $criativo->anuncio_id)
            ->with('success', 'Criativo atualizado com sucesso!');
    }

    /**
     * Removes the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $criativo = Criativo::findOrFail($id);
        $anuncioId = $criativo->anuncio_id;

        // Remover imagem se existir
        if ($criativo->image) {
            $imagemPath = $criativo->getRawOriginal('image');
            $caminhoCompleto = storage_path($imagemPath);
            if (file_exists($caminhoCompleto)) {
                unlink($caminhoCompleto);
                \Illuminate\Support\Facades\Log::debug('Imagem do criativo removida', [
                    'caminho' => $caminhoCompleto
                ]);
            }
        }

        // Excluir o criativo (soft delete)
        $criativo->delete();

        // Redirecionar para a edição do anúncio com os criativos restantes
        return redirect()->route('admin.anuncios.edit', $anuncioId)
            ->with('success', 'Criativo excluído com sucesso!');
    }
}
