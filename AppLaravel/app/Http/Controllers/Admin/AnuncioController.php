<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnuncioRequest;
use App\Models\Anuncio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AnuncioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Anuncio::query();

        // Filtros
        if ($request->filled('titulo')) {
            $query->where('titulo', 'like', '%' . $request->titulo . '%');
        }

        if ($request->filled('tag_principal')) {
            $query->where('tag_principal', $request->tag_principal);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('nicho')) {
            $query->where('nicho', 'like', '%' . $request->nicho . '%');
        }

        if ($request->filled('pais_codigo')) {
            $query->where('pais_codigo', $request->pais_codigo);
        }

        // Ordenação
        $orderBy = $request->input('order_by', 'created_at');
        $orderDirection = $request->input('order_direction', 'desc');
        $query->orderBy($orderBy, $orderDirection);

        // Paginação
        $anuncios = $query->paginate(10);

        return view('admin.anuncios.index', compact('anuncios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Lista de países para o select
        $paises = $this->getPaisesList();
        return view('admin.anuncios.create', compact('paises'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AnuncioRequest $request)
    {
        // Dados validados pelo AnuncioRequest
        $dados = $request->validated();

        // Log para verificar os dados recebidos
        \Illuminate\Support\Facades\Log::debug('Dados recebidos no store', [
            'tags' => $dados['tags'] ?? null,
            'tipo_tags' => isset($dados['tags']) ? gettype($dados['tags']) : 'não definido'
        ]);

        // Tratar upload de imagem
        if ($request->hasFile('imagem')) {
            // Salvar arquivo diretamente na pasta storage/anuncios
            $file = $request->file('imagem');
            $fileName = $file->getClientOriginalName();
            // Adicionar timestamp ao nome do arquivo para evitar cache
            $timestamp = time();
            $uniqueFileName = $timestamp . '_' . $fileName;
            $file->move(storage_path('anuncios'), $uniqueFileName);
            $dados['imagem'] = 'anuncios/' . $uniqueFileName;

            // Log de debug para verificar o caminho da imagem
            \Illuminate\Support\Facades\Log::debug('Imagem processada no store', [
                'caminho_salvo' => $dados['imagem'],
                'caminho_completo' => storage_path('anuncios/') . $uniqueFileName,
                'url_public' => route('storage.direct', ['path' => $dados['imagem']])
            ]);
        }

        // Criar o anúncio
        $anuncio = Anuncio::create($dados);

        return redirect()
            ->route('admin.anuncios.index')
            ->with('success', 'Anúncio criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anuncio = Anuncio::with('criativos')->findOrFail($id);
        return view('admin.anuncios.show', compact('anuncio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $paises = $this->getPaisesList();
        return view('admin.anuncios.edit', compact('anuncio', 'paises'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AnuncioRequest $request, string $id)
    {
        $anuncio = Anuncio::findOrFail($id);
        $dados = $request->validated();

        // Log para verificar os dados recebidos
        \Illuminate\Support\Facades\Log::debug('Dados recebidos no update', [
            'id' => $id,
            'tags' => $dados['tags'] ?? null,
            'tipo_tags' => isset($dados['tags']) ? gettype($dados['tags']) : 'não definido',
            'imagem_atual' => $anuncio->getRawOriginal('imagem')
        ]);

        // Verificar se está fazendo upload de nova imagem
        if ($request->hasFile('imagem')) {
            // Remover imagem anterior se existir
            $imagemAnteriorPath = $anuncio->getRawOriginal('imagem');
            if ($imagemAnteriorPath) {
                $caminhoCompleto = storage_path($imagemAnteriorPath);
                if (file_exists($caminhoCompleto)) {
                    unlink($caminhoCompleto);
                    \Illuminate\Support\Facades\Log::debug('Imagem anterior removida', [
                        'caminho' => $caminhoCompleto
                    ]);
                }
            }

            // Salvar arquivo diretamente na pasta storage/anuncios
            $file = $request->file('imagem');
            $fileName = $file->getClientOriginalName();
            // Adicionar timestamp ao nome do arquivo para evitar cache
            $timestamp = time();
            $uniqueFileName = $timestamp . '_' . $fileName;
            $file->move(storage_path('anuncios'), $uniqueFileName);
            $dados['imagem'] = 'anuncios/' . $uniqueFileName;

            // Log de debug para verificar o caminho da imagem
            \Illuminate\Support\Facades\Log::debug('Imagem processada no update', [
                'caminho_salvo' => $dados['imagem'],
                'caminho_completo' => storage_path('anuncios/') . $uniqueFileName,
                'url_public' => route('storage.direct', ['path' => $dados['imagem']])
            ]);
        }

        // Atualizar o anúncio
        $anuncio->update($dados);

        // Forçar atualização do cache
        $anuncio = $anuncio->fresh();

        return redirect()
            ->route('admin.anuncios.index')
            ->with('success', 'Anúncio atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Soft delete do anúncio (criativos serão excluídos pela relação onDelete cascade)
        $anuncio->delete();

        return redirect()
            ->route('admin.anuncios.index')
            ->with('success', 'Anúncio excluído com sucesso!');
    }

    /**
     * Remover a imagem de um anúncio via AJAX.
     */
    public function removerImagem(string $id)
    {
        $anuncio = Anuncio::findOrFail($id);

        // Verificar se o anúncio tem imagem
        $imagemPath = $anuncio->getRawOriginal('imagem');
        if (!$imagemPath) {
            return response()->json([
                'success' => false,
                'message' => 'Este anúncio não possui imagem para remover.'
            ], 400);
        }

        // Log para depuração
        \Illuminate\Support\Facades\Log::debug('Removendo imagem', [
            'anuncio_id' => $anuncio->id,
            'imagem_path' => $imagemPath,
            'caminho_completo' => storage_path($imagemPath)
        ]);

        // Remover a imagem do storage
        $caminhoCompleto = storage_path($imagemPath);
        if (file_exists($caminhoCompleto)) {
            unlink($caminhoCompleto);
        }

        // Atualizar o registro no banco de dados
        $anuncio->imagem = null;
        $anuncio->save();

        // Recarregar o modelo após salvar para garantir que os acessores sejam aplicados
        $anuncio->fresh();

        return response()->json([
            'success' => true,
            'message' => 'Imagem removida com sucesso!',
            'anuncio' => $anuncio
        ]);
    }

    /**
     * Obter a lista de países para o select.
     */
    private function getPaisesList(): array
    {
        // Países e seus códigos ISO
        return [
            'BR' => 'Brasil',
            'US' => 'Estados Unidos',
            'CA' => 'Canadá',
            'ES' => 'Espanha',
            'PT' => 'Portugal',
            'MX' => 'México',
            'CO' => 'Colômbia',
            'AR' => 'Argentina',
            'CL' => 'Chile',
            'PE' => 'Peru',
            'VE' => 'Venezuela',
            // Adicione mais países conforme necessário
        ];
    }

    /**
     * Criar anúncios de teste.
     */
    public function criarAnunciosTeste()
    {
        // Verificar se já existem anúncios
        if (Anuncio::count() > 0) {
            return redirect()->route('admin.anuncios.index')
                ->with('info', 'Já existem anúncios no sistema.');
        }

        // Criar alguns anúncios de teste
        $anuncios = [
            [
                'titulo' => 'Campanha de Marketing Digital',
                'tag_principal' => 'ESCALANDO',
                'data_anuncio' => now(),
                'nicho' => 'Marketing Digital',
                'pais_codigo' => 'BR',
                'status' => 'Ativo',
                'novo_anuncio' => true,
                'destaque' => true,
                'tags' => json_encode(['marketing', 'digital', 'campanha']),
                'produto_tipo' => 'Infoproduto',
                'produto_estrutura' => 'VSL',
                'produto_idioma' => 'Português',
                'produto_rede_trafego' => 'Facebook',
                'produto_funil_vendas' => 'Webinar',
            ],
            [
                'titulo' => 'Curso de Programação Python',
                'tag_principal' => 'TESTE',
                'data_anuncio' => now()->subDays(5),
                'nicho' => 'Programação',
                'pais_codigo' => 'BR',
                'status' => 'Ativo',
                'novo_anuncio' => false,
                'destaque' => false,
                'tags' => json_encode(['curso', 'programação', 'python']),
                'produto_tipo' => 'Infoproduto',
                'produto_estrutura' => 'Webinar',
                'produto_idioma' => 'Português',
                'produto_rede_trafego' => 'Google',
                'produto_funil_vendas' => 'Email',
            ],
            [
                'titulo' => 'Treinamento Fitness',
                'tag_principal' => 'PAUSADO',
                'data_anuncio' => now()->subDays(10),
                'nicho' => 'Fitness',
                'pais_codigo' => 'BR',
                'status' => 'Inativo',
                'novo_anuncio' => false,
                'destaque' => false,
                'tags' => json_encode(['fitness', 'saúde', 'treino']),
                'produto_tipo' => 'Infoproduto',
                'produto_estrutura' => 'VSL',
                'produto_idioma' => 'Português',
                'produto_rede_trafego' => 'Instagram',
                'produto_funil_vendas' => 'Direto',
            ],
        ];

        foreach ($anuncios as $anuncioData) {
            Anuncio::create($anuncioData);
        }

        return redirect()->route('admin.anuncios.index')
            ->with('success', '3 anúncios de teste foram criados com sucesso!');
    }
}
